@extends('layouts.master')

@section('content')
<style>
    :root {
        --verde-sena: #39A900;
        --verde-oscuro: #2E7D32;
        --gris-fondo: #f4f6f8;
        --blanco: #ffffff;
        --sombra: 0 6px 12px rgba(0, 0, 0, 0.15);
        --radio: 12px;
    }

    body {
        background-color: var(--gris-fondo);
    }

    .container-permiso {
        max-width: 650px;
        margin: 50px auto;
        background: linear-gradient(135deg, var(--verde-sena), #6bcf3f);
        border-radius: var(--radio);
        padding: 25px;
        box-shadow: var(--sombra);
        color: var(--blanco);
        font-family: 'Segoe UI', sans-serif;
    }

    .container-permiso h2 {
        text-align: center;
        margin-bottom: 20px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .form-group label {
        font-weight: 600;
        margin-bottom: 6px;
        display: block;
    }

    .form-control {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: var(--radio);
        margin-bottom: 15px;
        font-size: 15px;
        color: #333;
    }

    .form-control:focus {
        outline: none;
        box-shadow: 0 0 8px rgba(206, 7, 7, 0.8);
    }

    textarea.form-control {
        resize: none;
        height: 100px;
    }

    .btn-enviar {
        display: block;
        width: 100%;
        padding: 14px;
        border: none;
        border-radius: var(--radio);
        background-color: var(--blanco);
        color: var(--verde-sena);
        font-weight: 700;
        font-size: 16px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-enviar:hover {
        background-color: #10cdb7;
        transform: scale(1.03);
        color:rgb(2, 1, 1) ;
    }

    /* Animación de entrada */
    .container-permiso {
        animation: fadeInUp 0.8s ease;
    }

    @keyframes fadeInUp {
        0% { opacity: 0; transform: translateY(40px); }
        100% { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="container-permiso">
    <h2>Solicitud de Salida del Internado</h2>
    <form action="{{route('aprendiz.request.store')}}" method="POST">
        @csrf

        <!-- Campo oculto con el ID del aprendiz -->
        <input type="hidden" name="apprentice_id" value="{{ Auth::id() }}">

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
