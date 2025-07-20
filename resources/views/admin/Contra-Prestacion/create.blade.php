@extends('layouts.master')

@section('content')
    {{-- Reutilizamos los estilos --}}
    <link rel="stylesheet" href="{{ asset('css/de-todito/attendance.css') }}">

    {{-- SweetAlert para mensaje de éxito --}}
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Registro Exitoso',
                text: @json(session('success')),
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#2c5f2d'
            });
        @endif
    </script>

    <div class="background-image">
        <div class="form-wrapper">
            {{-- Encabezado --}}
            <div class="form-header">
                <h1>⏰ Registrar Horas de Servicio</h1>
                <p>Ingresa la información de la actividad realizada</p>
            </div>

            {{-- Botón para volver al listado --}}
            <div class="form-actions">
                <a href="{{ route('admin.contra_prestacion.index') }}" class="btn btn-primary">← Volver al listado</a>
            </div>

            {{-- Errores de validación --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br>
            @endif

            {{-- Formulario --}}
            <form action="{{ route('admin.contra_prestacion.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                {{-- Aprendiz --}}
                <div class="form-group">
                    <label for="apprentice_id">👨‍🎓 Aprendiz</label>
                    <select name="apprentice_id" id="apprentice_id" required>
                        <option value="" selected disabled>Seleccione un aprendiz</option>
                        @foreach ($aprendices as $aprendiz)
                            <option value="{{ $aprendiz->id }}"
                                {{ old('apprentice_id') == $aprendiz->id ? 'selected' : '' }}>
                                {{ $aprendiz->person->full_name ?? 'Sin nombre' }} --
                                {{ $aprendiz->program->technical_sheet ?? 'Sin Ficha' }} --
                                {{ $aprendiz->program->initials ?? 'Sin Sigla' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Horas registradas --}}
                <div class="form-group">
                    <label for="hours">⏳ Horas Registradas</label>
                    <input type="number" step="0.1" min="0" name="hours" id="hours"
                        value="{{ old('hours') }}" required>
                </div>

                {{-- Fecha de la actividad --}}
                <div class="form-group">
                    <label for="activity_date">📅 Fecha de la Actividad</label>
                    <input type="date" name="activity_date" id="activity_date"
                        value="{{ old('activity_date', now()->toDateString()) }}" required>
                </div>

                {{-- Campos ocultos --}}
                <input type="hidden" name="total_hours" value="0">
                <input type="hidden" name="recorded_by" value="{{ Auth::id() }}">

                {{-- Botón Guardar --}}
                <button type="submit" class="submit-btn">
                    <i class="fas fa-save me-1"></i> Guardar
                </button>
            </form>
        </div>
    </div>
@endsection
