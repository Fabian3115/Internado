@extends('layouts.master')

{{-- Estilos personalizados --}}
<link rel="stylesheet" href="{{ asset('css/aprendiz/create.css') }}">

@section('content')

<div class="ficha-aprendiz">
    <div class="tarjeta-aprendiz">

        <div class="encabezado-form">
            <img src="{{ asset('images/logo_sena.png') }}" alt="Logo SENA">
            <h2>Solicitud de Salida del Internado</h2>
            <p>Completa el formulario para solicitar una salida temporal del internado.</p>
        </div>

        <form action="{{ route('aprendiz.request.store') }}" method="POST" class="formulario-aprendiz">
            @csrf

            <!-- Campo oculto con el ID del aprendiz -->
            <input type="hidden" name="apprentice_id" value="{{ Auth::user()->apprentice->id ?? '' }}">

            <!-- Motivo -->
            <div class="grupo-campo">
                <label for="reason">Motivo de la salida:</label>
                <textarea id="reason" name="reason" class="form-control" rows="3" placeholder="Escribe el motivo..." required></textarea>
            </div>

            <!-- Fecha y hora de salida -->
            <div class="grupo-campo">
                <label for="departure_date">Fecha y hora de salida:</label>
                <input type="datetime-local" id="departure_date" name="departure_date" class="form-control" required>
            </div>

            <!-- Fecha y hora de regreso -->
            <div class="grupo-campo">
                <label for="return_date">Fecha y hora de regreso (opcional):</label>
                <input type="datetime-local" id="return_date" name="return_date" class="form-control">
            </div>

            <!-- Destino -->
            <div class="grupo-campo">
                <label for="destination">Destino (opcional):</label>
                <input type="text" id="destination" name="destination" class="form-control" placeholder="¿A dónde vas?">
            </div>

            <!-- Observaciones -->
            <div class="grupo-campo">
                <label for="observations">Observaciones (opcional):</label>
                <textarea id="observations" name="observations" class="form-control" rows="2" placeholder="Escribe observaciones adicionales..."></textarea>
            </div>

            <!-- Estado inicial -->
            <input type="hidden" name="status" value="pendiente">

            <!-- Botón -->
            <div class="acciones-formulario">
                <button type="submit" class="boton-guardar">📤 Enviar Solicitud</button>
                <a href="{{ route('aprendiz.request.index') }}" class="boton-cancelar">↩️ Cancelar</a>
            </div>
        </form>

    </div>
</div>

@endsection
