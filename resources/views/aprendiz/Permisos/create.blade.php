@extends('layouts.master')

{{-- Estilos personalizados --}}
<link rel="stylesheet" href="{{ asset('css/aprendiz/create.css') }}">

@section('content')

<div class="container-permiso">
    <h2>Solicitud de Salida del Internado</h2>
    <form action="{{route('aprendiz.request.store')}}" method="POST">
        @csrf

        <!-- Campo oculto con el ID del aprendiz -->
        <input type="hidden" name="apprentice_id" value="{{ Auth::user()->apprentice->id ?? '' }}">

        <!-- Motivo -->
        <div class="form-group">
            <label for="reason">Motivo de la salida:</label>
            <textarea id="reason" name="reason" class="form-control" placeholder="Escribe el motivo de tu salida..." required></textarea>
        </div>

        <!-- Fecha y hora de salida -->
        <div class="form-group">
            <label for="departure_date">Fecha y hora de salida:</label>
            <input type="datetime-local" id="departure_date" name="departure_date" class="form-control" required>
        </div>

        <!-- Fecha y hora de regreso -->
        <div class="form-group">
            <label for="return_date">Fecha y hora de regreso (opcional):</label>
            <input type="datetime-local" id="return_date" name="return_date" class="form-control">
        </div>

        <!-- Destino -->
        <div class="form-group">
            <label for="destination">Destino (opcional):</label>
            <input type="text" id="destination" name="destination" class="form-control" placeholder="¿A dónde vas?">
        </div>

        <!-- Observaciones -->
        <div class="form-group">
            <label for="observations">Observaciones (opcional):</label>
            <textarea id="observations" name="observations" class="form-control" placeholder="Escribe observaciones adicionales..."></textarea>
        </div>

        <!-- Estado inicial -->
        <input type="hidden" name="status" value="pendiente">

        <!-- Botón -->
        <button type="submit" class="btn-enviar">Enviar Solicitud</button>
    </form>
</div>
@endsection
