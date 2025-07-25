@extends('layouts.master')

{{-- Estilos personalizados --}}
<link rel="stylesheet" href="{{ asset('css/aprendiz/permisos/edit.css') }}">

@section('content')
<div class="container-permiso">
    <h2>Editar Solicitud de Salida</h2>
    <p>Por favor, completa el formulario para editar tu solicitud de salida.</p>
    <form action="{{route('aprendiz.request.update', $salida->id)}}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campo oculto con el ID del aprendiz -->
        <input type="hidden" name="apprentice_id" value="{{ $salida->apprentice_id }}">

        <!-- Motivo -->
        <div class="form-group">
            <label for="motivo">Motivo de la salida:</label>
            <textarea id="motivo" name="reason" class="form-control" required>{{ old('reason', $salida->reason) }}</textarea>
        </div>

        <!-- Fecha y hora de salida -->
        <div class="form-group">
            <label for="fecha_salida">Fecha y hora de salida:</label>
            <input type="datetime-local" id="fecha_salida" name="departure_date" class="form-control"
                value="{{ old('departure_date', \Carbon\Carbon::parse($salida->departure_date)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <!-- Fecha y hora de regreso -->
        <div class="form-group">
            <label for="fecha_regreso">Fecha y hora de regreso (opcional):</label>
            <input type="datetime-local" id="fecha_regreso" name="return_date" class="form-control"
                value="{{ old('return_date', $salida->return_date ? \Carbon\Carbon::parse($salida->return_date)->format('Y-m-d\TH:i') : '') }}">
        </div>

        <!-- Destino -->
        <div class="form-group">
            <label for="destino">Destino (opcional):</label>
            <input type="text" id="destino" name="destination" class="form-control"
                value="{{ old('destination', $salida->destination) }}">
        </div>

        <!-- Observaciones -->
        <div class="form-group">
            <label for="observaciones">Observaciones (opcional):</label>
            <textarea id="observaciones" name="observations" class="form-control">{{ old('observations', $salida->observations) }}</textarea>
        </div>

        <!-- Botón -->
        <button type="submit" class="btn-actualizar">Actualizar Solicitud</button>
    </form>
</div>
@endsection
