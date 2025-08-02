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
            <h2>🚨 Registrar Llamado de Atención</h2>
            <p>Ingresa los detalles del incidente o llamado de atención del aprendiz.</p>
        </div>

        <div class="volver-link">
            <a href="{{ route('admin.atencion.index') }}">
                <i class="fas fa-arrow-left"></i> Volver al listado
            </a>
        </div>

        @if ($errors->any())
            <div class="alerta-error animated slideInDown">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.atencion.store') }}" method="POST" class="asistencia-form">
            @csrf

            <div class="form-group">
                <label for="apprentice_id">👨‍🎓 Aprendiz</label>
                <select name="apprentice_id" required>
                    <option disabled selected>Seleccione un aprendiz</option>
                    @foreach ($aprendices as $aprendiz)
                        <option value="{{ $aprendiz->id }}" {{ old('apprentice_id') == $aprendiz->id ? 'selected' : '' }}>
                            {{ $aprendiz->person->full_name ?? 'Sin nombre' }} -
                            {{ $aprendiz->program->technical_sheet ?? 'Sin ficha' }} -
                            {{ $aprendiz->program->initials ?? 'Sin sigla' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="date">📅 Fecha del Incidente</label>
                <input type="date" name="date" value="{{ old('date', now()->toDateString()) }}" required>
            </div>

            <div class="form-group">
                <label for="incident">⚠️ Tipo de Llamado de Atención </label>
                <input type="text" name="incident" value="{{ old('incident') }}" required>
            </div>

            <div class="form-group">
                <label for="description">📝 Descripción</label>
                <textarea name="description" rows="3" required>{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="observations">🔍 Observaciones</label>
                <textarea name="observations" rows="3">{{ old('observations') }}</textarea>
            </div>

            <input type="hidden" name="recorded_by" value="{{ Auth::id() }}">

            <button type="submit" class="btn-registrar">
                <i class="fas fa-save"></i> Guardar
            </button>
        </form>
    </div>
</section>
@endsection
