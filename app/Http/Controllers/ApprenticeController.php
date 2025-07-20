<?php

namespace App\Http\Controllers;

use App\Models\Apprentice;
use App\Models\Benefit;
use App\Models\Person;
use App\Models\Program;
use Illuminate\Http\Request;

class ApprenticeController extends Controller
{
    public function listado()
    {
        // Aquí puedes implementar la lógica para mostrar el listado de asistencias
        $apprentices = Apprentice::with(['person', 'program'])
            ->latest() // ordenar por la fecha más reciente
            ->paginate(15); // paginación Bootstrap
        return view('admin.Aprendiz.index', compact('apprentices'));
    }
    public function create()
    {
        // Aquí puedes implementar la lógica para mostrar el formulario de creación de asistencias
        // Puedes pasar los datos necesarios al formulario, como beneficios, personas, programas, etc.
        // Por ejemplo, si tienes modelos para beneficios, personas y programas, puedes pasarlos así
       $people = Person::whereHas('user', fn ($q) => $q->where('role', 'aprendiz'))
                    ->orderBy('name')   // opcional: para que salgan ordenadas
                    ->get();
        $programs = Program::all();
        return view('admin.Aprendiz.create', compact('people','programs'));
    }
    public function store(Request $request)
    {
        // Aquí puedes implementar la lógica para almacenar un nuevo aprendiz
        $request->validate([
            'person_id' => 'required|exists:people,id',
            'program_id' => 'required|exists:programs,id',
            'state' => 'required|in:Activo,Inactivo','Graduado,Retirado',
            'Tutor_name' => 'required|string|max:255',
            'Tutor_last_name' => 'required|string|max:255',
            'Tutor_number_phone' => 'required|string|max:15',
        ]);
        // Aquí deberías crear el aprendiz en la base de datos
        Apprentice::create($request->all());
        return redirect()->route('admin.aprendices.index')->with('success', 'Aprendiz creado correctamente.');
    }
    public function edit($id)
    {
        // Aquí puedes implementar la lógica para mostrar el formulario de edición de un aprendiz
        $apprentice = Apprentice::findOrFail($id);
        $people = Person::all();
        $programs = Program::all();
        return view('admin.Aprendiz.edit', compact('apprentice', 'people', 'programs'));
    }
    public function update(Request $request, $id)
    {
        // Aquí puedes implementar la lógica para actualizar un aprendiz existente
        $request->validate([
            'person_id' => 'required|exists:people,id',
            'program_id' => 'required|exists:programs,id',
            'state' => 'required|in:active,inactive',
            'Tutor_name' => 'required|string|max:255',
            'Tutor_last_name' => 'required|string|max:255',
            'Tutor_number_phone' => 'required|string|max:15',
        ]);

        // Aquí deberías actualizar el aprendiz en la base de datos
        $apprentice = Apprentice::findOrFail($id);
        $apprentice->update($request->all());
        return redirect()->route('admin.aprendices.index')->with('success', 'Aprendiz actualizado correctamente.');
    }
    public function destroy($id)
    {
        // Aquí puedes implementar la lógica para eliminar un aprendiz
        $apprentice = Apprentice::findOrFail($id);
        $apprentice->delete();
        return redirect()->route('admin.aprendices.index')->with('success', 'Aprendiz eliminado correctamente.');
    }

}
