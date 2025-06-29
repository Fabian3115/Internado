<?php

namespace App\Http\Controllers;

use App\Models\Apprentice;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function listado()
    {
        $asistencias = Attendance::with('apprentice.person')
            ->latest() // ordenar por la fecha más reciente
            ->paginate(15); // paginación Bootstrap
        return view('admin.asistencia.index', compact('asistencias'));
    }

    public function aprendiz_index()
    {
        // el usuario logueado está asociado a un registro Person
        $personId = Auth::user()->person_id;

        $asistencias = Attendance::with('apprentice.person')
            ->whereHas('apprentice', fn($q) => $q->where('person_id', $personId))
            ->latest()          // más recientes primero
            ->paginate(15);     // 15 por página

        return view('aprendiz.asistencia.index', compact('asistencias'));
    }

    public function create()
    {
        $aprendices = Apprentice::with('person')->where('state', 'Activo')->get();
        return view('admin.asistencia.create', compact('aprendices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'apprentice_id' => 'required|exists:apprentices,id',
            'attendance_date' => 'required|date',
            'attendance_status' => 'required|in:Presente,Ausente,Justificado',
            'justification' => 'nullable|string|max:255',
        ]);

        Attendance::create($request->all());

        return redirect()->route('admin.asistencia.index')->with('success', 'Asistencia registrada correctamente.');
    }
    public function edit($id)
    {
        $asistencia = Attendance::findOrFail($id);
        $aprendices = Apprentice::all();
        return view('admin.asistencia.edit', compact('asistencia', 'aprendices'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'apprentice_id'     => 'required|exists:apprentices,id',
            'attendance_date'   => 'required|date',
            'attendance_status' => 'required|in:Presente,Ausente,Justificado',
            'justification'     => 'nullable|string|max:255',
        ]);

        $asistencia = Attendance::findOrFail($id);

        // Solo los campos que realmente quieres actualizar
        $asistencia->update([
            'apprentice_id'     => $request->apprentice_id,
            'attendance_date'   => $request->attendance_date,
            'attendance_status' => $request->attendance_status,
            'justification'     => $request->justification,
        ]);

        return redirect()->route('admin.asistencia.index')->with('success', 'Asistencia actualizada correctamente.');
    }
    public function destroy($id)
    {
        $asistencia = Attendance::findOrFail($id);
        $asistencia->delete();
        return redirect()->route('admin.asistencia.index')->with('success', 'Asistencia eliminada correctamente.');
    }
}
