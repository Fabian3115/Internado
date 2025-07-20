<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function request_index()
    {

        // Solo muestra las solicitudes del aprendiz autenticado
        $salidas = ModelsRequest::where('apprentice_id', Auth::id())->get();
        return view('aprendiz.Permisos.index', compact('salidas'));
    }

    public function request_index_admin()
    {
        // Obtenemos todas las salidas con la relación del aprendiz
        $salidas = ModelsRequest::with('apprentice')->get();
        return view('admin.Permisos.index', compact('salidas'));
    }

    public function request_create()
    {
        return view('aprendiz.Permisos.create');
    }

    public function request_store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'reason'          => 'required|string|max:500',
            'destination'     => 'nullable|string|max:255',
            'observations'    => 'nullable|string|max:1000',
            'status'          => 'required|in:pendiente,aprobada,rechazada',
        ]);

        $data = $request->all();
        $data['departure_date'] = \Carbon\Carbon::parse($request->departure_date);
        $data['return_date'] = $request->return_date ? \Carbon\Carbon::parse($request->return_date) : null;

        ModelsRequest::create($data);

        return redirect()->route('aprendiz.request.index')->with('success', 'Solicitud registrada exitosamente.');
    }


    public function request_edit($id)
    {
        $salida = ModelsRequest::findOrFail($id);
        return view('aprendiz.Permisos.edit', compact('salida'));
    }

    public function request_update(Request $request, $id)
    {
        $salida = ModelsRequest::findOrFail($id);

        // Opcional: comprobar que el usuario es dueño de la salida
        if (Auth::id() !== $salida->apprentice_id && Auth::user()->role !== 'aprendiz') {
            abort(403, 'No tienes permiso para editar esta solicitud.');
        }

        $request->validate([
            'reason'          => 'required|string|max:500',
            'departure_date'  => 'required|date|after:now',
            'return_date'     => 'nullable|date|after:departure_date',
            'destination'     => 'nullable|string|max:255',
            'observations'    => 'nullable|string|max:1000',
            'status'          => 'required|in:pendiente,aprobada,rechazada',
        ]);

        $salida->update($request->all());

        return redirect()->route('aprendiz.request.index')->with('success', 'Solicitud actualizada correctamente.');
    }

    public function request_reject(Request $request, $id)
    {
        $request->validate([
            'comment' => 'nullable|string|max:500'
        ]);

        $salida = ModelsRequest::findOrFail($id);

        // Actualizar campos
        $salida->update([
            'status' => 'rechazada',
            'user_id' => Auth::id(), // usuario que realiza la acción
            'comment' => $request->comment // comentario opcional
        ]);

        return redirect()->route('admin.aprendices.request.index_admin')->with('error', '✅ La salida fue rechazada con éxito.');
    }

    public function request_accept($id)
    {
        $salida = ModelsRequest::findOrFail($id);

        // Actualizar campos
        $salida->update([
            'status' => 'aprobado',
            'user_id' => Auth::id(), // usuario que realiza la acción
        ]);

        return redirect()->route('admin.aprendices.request.index_admin')->with('error', '✅ La salida fue aprobada con éxito.');
    }
}
