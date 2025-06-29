<?php

namespace App\Http\Controllers;

use App\Models\Apprentice;
use App\Models\CounterPrestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CounterPrestationController extends Controller
{
    public function listado()
    {
        //Listado de horas de Contra-Prestación para el administrador
        $horas = CounterPrestation::with('apprentice.person')
            ->latest()
            ->paginate(10);
        return view('admin.Contra-Prestacion.index', compact('horas'));
    }

    public function aprendiz_index()
    {
        //Listado de horas de Contra-Prestación para el aprendiz
        // Obtenemos el ID de la persona autenticada
        $personId = Auth::user()->person_id;

        $horas = CounterPrestation::with('apprentice.person')
            ->whereHas('apprentice', fn($q) => $q->where('person_id', $personId))
            ->latest()
            ->paginate(10);

        return view('admin.Contra-Prestacion.index', compact('horas'));
    }
    public function create()
    {
        // Cargar los aprendices para el formulario
        $aprendices = Apprentice::with('person')
                    ->where('state', 'Activo')// Filtrar solo aprendices activos
                    ->orderBy('id', 'asc')    // Ordenar por ID ascendente
                    ->get();
        return view('admin.Contra-Prestacion.create', compact('aprendices'));
    }
    public function store(Request $request)
    {
         // 1️⃣ Validación
        $request->validate([
            'apprentice_id'        => 'required|exists:apprentices,id',
            'hours'                => 'required|numeric|min:1',
            'activity_date'        => 'required|date',
            'activity_description' => 'nullable|string|max:255',
        ]);

        // 2️⃣ Operación atómica por seguridad
        DB::transaction(function () use ($request) {

            // 2.1 Obtenemos el total acumulado más reciente del aprendiz (0 si nunca ha cargado horas)
            $lastRecord = CounterPrestation::where('apprentice_id', $request->apprentice_id)
                            ->latest('id')           // más eficiente que latest() sin columna
                            ->first();

            $previousTotal = $lastRecord ? $lastRecord->total_hours : 0;

            // 2.2 Calculamos el nuevo total
            $newTotal = $previousTotal + $request->hours;

            // 2.3 Creamos el registro
            CounterPrestation::create([
                'apprentice_id'        => $request->apprentice_id,
                'hours'                => $request->hours,
                'activity_date'        => $request->activity_date,
                'activity_description' => $request->activity_description,
                'total_hours'          => $newTotal,
                'recorded_by'          => Auth::id(),   // o el id de quien registra
            ]);
        });

        // 3️⃣ Redirección con mensaje
        return redirect()->route('admin.contra_prestacion.index')->with('success', 'Horas registradas y acumuladas correctamente.');
    }

}
