<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function listado()
    {
        // Aquí puedes implementar la lógica para listar los programas de formación
        $programs = Program::latest()->paginate(10);; // Suponiendo que tienes un modelo Program
        return view('admin.Programas.index', compact('programs'));
    }

    public function create()
    {
        // Aquí puedes implementar la lógica para mostrar el formulario de creación de programas
        return view('admin.Programas.create');
    }

    public function store(Request $request)
    {
        // Aquí puedes implementar la lógica para almacenar un nuevo programa
        $request->validate([
            'program_name'    => 'required|string|max:255',
            'technical_sheet' => 'required|numeric|min:1',   // ← ahora es entero positivo
            'level'           => 'required|in:Técnico,Tecnólogo',
            'initials'        => 'required|string|max:10',
            'mode'            => 'required|in:Presencial,Virtual',
        ]);


        Program::create($request->all());

        return redirect()->route('admin.programa.index')->with('success', 'Programa creado correctamente.');
    }

    public function edit($id)
    {
        // Aquí puedes implementar la lógica para mostrar el formulario de edición de un programa
        $program = Program::findOrFail($id);
        return view('admin.Programas.edit', compact('program'));
    }

    public function update(Request $request, $id)
    {
        // Aquí puedes implementar la lógica para actualizar un programa existente
        $request->validate([
            'program_name'    => 'required|string|max:255',
            'technical_sheet' => 'required|numeric|min:1',   // ← ahora es entero positivo
            'level'           => 'required|in:Técnico,Tecnólogo',
            'initials'        => 'required|string|max:10',
            'mode'            => 'required|in:Presencial,Virtual',
        ]);


        $program = Program::findOrFail($id);
        $program->update($request->all());

        return redirect()->route('admin.programa.index')->with('success', 'Programa actualizado correctamente.');
    }

    public function destroy($id)
    {
        // Aquí puedes implementar la lógica para eliminar un programa
        $program = Program::findOrFail($id);
        $program->delete();

        return redirect()->route('admin.programa.index')->with('success', 'Programa eliminado correctamente.');
    }
}
