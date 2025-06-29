<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listado()
    {
        // Aquí puedes implementar la lógica para listar los beneficios
        $benefits = Benefit::latest()->paginate(10);; // Suponiendo que tienes un
        return view('admin.beneficio.index', compact('benefits'));
    }

    // Otros métodos como create, store, edit, update, destroy pueden ser implementados aquí
    public function create()
    {
        // Aquí puedes implementar la lógica para mostrar el formulario de creación de beneficios
        return view('admin.beneficio.create');
    }
    public function store(Request $request)
    {
        // Aquí puedes implementar la lógica para almacenar un nuevo beneficio
        $request->validate([
            'percentage' => 'required|numeric|min:0',
            'total_hours' => 'required|numeric|min:0',
        ]);
        Benefit::create($request->all());

        return redirect()->route('admin.beneficio.index')->with('success', 'Beneficio creado correctamente.');
    }
    public function edit($id)
    {
        // Aquí puedes implementar la lógica para mostrar el formulario de edición de un beneficio
        $benefit = Benefit::findOrFail($id);
        return view('admin.beneficio.edit', compact('benefit'));
    }
    public function update(Request $request, $id)
    {
        // Aquí puedes implementar la lógica para actualizar un beneficio existente
        $request->validate([
            'percentage' => 'required|numeric|min:0',
            'total_hours' => 'nullable|numeric|min:0',
        ]);
        $benefit = Benefit::findOrFail($id);
        $benefit->update($request->all());
        return redirect()->route('admin.beneficio.index')->with('success', 'Beneficio actualizado correctamente.');
    }
    public function destroy($id)
    {
        // Aquí puedes implementar la lógica para eliminar un beneficio
        $benefit = Benefit::findOrFail($id);
        $benefit->delete();
        return redirect()->route('admin.beneficio.index')->with('success', 'Beneficio eliminado correctamente.');
    }

}
