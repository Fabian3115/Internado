<?php

namespace App\Http\Controllers;

use App\Models\Apprentice;
use App\Models\Attention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttentationController extends Controller
{
    public function listado()
    {
        $llamados = Attention::with('apprentice.person') // Ajusta si usas otro nombre de modelo
            ->latest()
            ->paginate(10);
        return view('admin.Llamados.index',compact('llamados'));
    }

    public function aprendiz_index()
    {
        $personId = Auth::user()->person_id;

        $llamados = Attention::with('apprentice.person') // Ajusta si usas otro nombre de modelo
            ->whereHas('apprentice', fn($q) => $q->where('person_id', $personId))
            ->latest()
            ->paginate(10);

        return view('aprendiz.Llamados.index', compact('llamados'));
    }
    public function create()
    {
        // Aquí puedes pasar datos necesarios para el formulario de creación
         $aprendices = Apprentice::with('person')->get();
        return view('admin.Llamados.create', compact('aprendices'));
    }
    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'apprentice_id' => 'required|exists:apprentices,id',
            'date' => 'required|date',
            'incident'=> 'required|string|max:250',
            'description'=> 'required|string|max:250',
            'observations'=> 'nullable|string|max:250',
        ]);

        // Crear el llamado de atención
        Attention::create($request->all());

        return redirect()->route('admin.atencion.index')->with('success', 'Llamado de atención registrado correctamente.');
    }
    public function edit($id)
    {
        $llamado = Attention::findOrFail($id);
        $aprendices = Apprentice::with('person')->get();
        return view('admin.Llamados.edit', compact('llamado', 'aprendices'));
    }
    public function update(Request $request, $id)
    {
        // Validación
        $request->validate([
            'apprentice_id' => 'required|exists:apprentices,id',
            'date' => 'required|date',
            'incident'=> 'required|text|max:250',
            'description'=> 'required|text|max:250',
            'observations'=> 'nullable|text|max:250',
        ]);

        // Actualizar el llamado de atención
        $llamado = Attention::findOrFail($id);
        $llamado->update($request->all());

        return redirect()->route('admin.atencion.index')->with('success', 'Llamado de atención actualizado correctamente.');
    }
    public function destroy($id)
    {
        $llamado = Attention::findOrFail($id);
        $llamado->delete();
        return redirect()->route('admin.atencion.index')->with('success', 'Llamado de atención eliminado correctamente.');
    }

}
