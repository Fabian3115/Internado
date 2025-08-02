@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('css/de-todito/attendance.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Registro Exitoso',
            text: @json(session('success')),
            confirmButtonColor: '#2c5f2d'
        });
    </script>
@endif

<section class="asistencia-section">
    <div class="asistencia-card animated fadeIn">
        <div class="asistencia-header">
            <h2>⏰ Registrar Horas de Servicio</h2>
            <p>Ingresa los datos de la actividad realizada por el aprendiz.</p>
        </div>

        <div class="volver-link">
            <a href="{{ route('admin.contra_prestacion.index') }}">
                <i class="fas fa-arrow-left"></i> Volver al listado
            </a>
        </div>

        @if ($errors->any())
            <div class="alerta-error animated slideInDown">
                <ul>
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.contra_prestacion.store') }}" method="POST" class="asistencia-form">
            @csrf

            {{-- Aprendiz --}}
            <div class="form-group">
                <label for="apprentice_id">👨‍🎓 Aprendiz</label>
                <select name="apprentice_id" required>
                    <option value="" disabled selected>Seleccione un aprendiz</option>
                    @foreach ($aprendices as $aprendiz)
                        <option value="{{ $aprendiz->id }}" {{ old('apprentice_id') == $aprendiz->id ? 'selected' : '' }}>
                            {{ $aprendiz->person->full_name ?? 'Sin nombre' }} -
                            {{ $aprendiz->program->technical_sheet ?? 'Sin ficha' }} -
                            {{ $aprendiz->program->initials ?? 'Sin sigla' }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Horas --}}
            <div class="form-group">
                <label for="hours">⏳ Horas Registradas</label>
                <input type="number" name="hours" step="0.1" min="0" value="{{ old('hours') }}" required>
            </div>

            {{-- Fecha --}}
            <div class="form-group">
                <label for="activity_date">📅 Fecha de Actividad</label>
                <input type="date" name="activity_date" value="{{ old('activity_date', now()->toDateString()) }}" required>
            </div>

            {{-- Ocultos --}}
            <input type="hidden" name="total_hours" value="0">
            <input type="hidden" name="recorded_by" value="{{ Auth::id() }}">

            <button type="submit" class="btn-registrar">
                <i class="fas fa-save"></i> Guardar Horas
            </button>
        </form>
    </div>
</section>
@endsection
