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
        $horas = CounterPrestation::with('apprentice.person')
            ->latest()
            ->paginate(10);

        return view('admin.Contra-Prestacion.index', compact('horas'));
    }

    public function historial(Request $request)
    {
        $search = $request->input('search');

        $registros = CounterPrestation::with('apprentice.person')
            ->where('total_hours', '>=', 40)
            ->when($search, function ($query) use ($search) {
                $query->whereHas('apprentice.person', function ($q) use ($search) {
                    $q->where(DB::raw("CONCAT(name, ' ', last_name)"), 'like', "%{$search}%");
                });
            })
            ->orderBy('activity_date', 'desc')
            ->paginate(10);

        return view('admin.Contra-Prestacion.historial', compact('registros'));
    }

    public function aprendiz_index()
    {
        $personId = Auth::user()->person_id;

        $horas = CounterPrestation::with('apprentice.person')
            ->whereHas('apprentice', fn($q) => $q->where('person_id', $personId))
            ->latest()
            ->paginate(10);

        return view('admin.Contra-Prestacion.index', compact('horas'));
    }

    public function create()
    {
        $aprendices = Apprentice::with('person')
            ->where('state', 'Activo')
            ->orderBy('id', 'asc')
            ->get();
        return view('admin.Contra-Prestacion.create', compact('aprendices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'apprentice_id'        => 'required|exists:apprentices,id',
            'hours'                => 'required|numeric|min:1',
            'activity_date'        => 'required|date',
        ]);

        DB::transaction(function () use ($request) {
            $registro = CounterPrestation::where('apprentice_id', $request->apprentice_id)
                ->where('estado', 'activo')
                ->first();

            if ($registro) {
                $registro->hours += $request->hours;
                $registro->total_hours += $request->hours;
                $registro->activity_date = $request->activity_date;
                $registro->recorded_by = Auth::id();

                if ($registro->total_hours >= 40) {
                    $registro->estado = 'finalizado';
                }

                $registro->save();
            } else {
                CounterPrestation::create([
                    'apprentice_id'        => $request->apprentice_id,
                    'hours'                => $request->hours,
                    'total_hours'          => $request->hours,
                    'activity_date'        => $request->activity_date,
                    'recorded_by'          => Auth::id(),
                    'estado'               => 'activo',
                ]);
            }
        });

        return redirect()->route('admin.contra_prestacion.index')
            ->with('success', 'Horas registradas correctamente.');
    }

    public function edit($id)
    {
        $hora = CounterPrestation::with('apprentice.person')->findOrFail($id);
        $aprendices = Apprentice::with('person')
            ->where('state', 'Activo')
            ->orderBy('id', 'asc')
            ->get();
        return view('admin.Contra-Prestacion.edit', compact('hora', 'aprendices'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'apprentice_id'        => 'required|exists:apprentices,id',
            'hours'                => 'required|numeric|min:1',
            'activity_date'        => 'required|date',
        ]);

        DB::transaction(function () use ($request, $id) {
            $registro = CounterPrestation::findOrFail($id);

            $oldHours = $registro->hours;
            $registro->apprentice_id = $request->apprentice_id;
            $registro->hours = $request->hours;
            $registro->total_hours = $registro->total_hours - $oldHours + $request->hours;
            $registro->activity_date = $request->activity_date;
            $registro->recorded_by = Auth::id();

            if ($registro->total_hours >= 40) {
                $registro->estado = 'finalizado';
            } else {
                $registro->estado = 'activo';
            }

            $registro->save();
        });

        return redirect()->route('admin.contra_prestacion.index')
            ->with('success', 'Registro actualizado correctamente.');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $registro = CounterPrestation::findOrFail($id);
            $registro->delete();
        });

        return redirect()->route('admin.contra_prestacion.index')
            ->with('success', 'Registro eliminado correctamente.');
    }
}
