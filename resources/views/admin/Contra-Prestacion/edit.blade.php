@extends('layouts.master')

@section('content')
    {{-- Estilos personalizados --}}
    <link rel="stylesheet" href="{{ asset('css/de-todito/attendance.css') }}">

    {{-- SweetAlert para éxito --}}
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '¡Actualización Exitosa!',
                text: @json(session('success')),
                confirmButtonText: 'Perfecto',
                confirmButtonColor: '#2c5f2d'
            });
        @endif
    </script>

    <div class="background-image">
        <div class="form-wrapper">
            {{-- Encabezado --}}
            <div class="form-header">
                <h1>✏️ Editar Registro de Horas</h1>
                <p>Modifica los datos del registro seleccionado</p>
            </div>

            {{-- Botón para volver --}}
            <div class="form-actions">
                <a href="{{ route('admin.contra_prestacion.index') }}" class="btn btn-primary">
                    ← Volver al listado
                </a>
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

            {{-- Formulario de Edición --}}
            <form action="{{ route('admin.contra_prestacion.update', $hora->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                {{-- Aprendiz --}}
                <div class="form-group">
                    <label for="apprentice_id">👨‍🎓 Aprendiz</label>
                    <select name="apprentice_id" id="apprentice_id" required>
                        @foreach ($aprendices as $aprendiz)
                            <option value="{{ $aprendiz->id }}"
                                {{ $hora->apprentice_id == $aprendiz->id ? 'selected' : '' }}>
                                {{ $aprendiz->person->full_name ?? 'Sin nombre' }} --
                                {{ $aprendiz->program->technical_sheet ?? 'Sin Ficha' }} --
                                {{ $aprendiz->program->initials ?? 'Sin Sigla' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Horas --}}
                <div class="form-group">
                    <label for="hours">⏳ Horas Registradas</label>
                    <input type="number" step="0.1" min="1" name="hours" id="hours"
                        value="{{ old('hours', $hora->hours) }}" required>
                </div>

                {{-- Fecha de actividad --}}
                <div class="form-group">
                    <label for="activity_date">📅 Fecha de la Actividad</label>
                    <input type="date" name="activity_date" id="activity_date"
                        value="{{ old('activity_date', $hora->activity_date) }}" required>
                </div>

                {{-- Descripción --}}
                <div class="form-group">
                    <label for="activity_description">📝 Descripción de la Actividad</label>
                    <textarea name="activity_description" id="activity_description" rows="4" required>{{ old('activity_description', $hora->activity_description) }}</textarea>
                </div>

                {{-- Botón Actualizar --}}
                <button type="submit" class="submit-btn">
                    <i class="fas fa-save me-1"></i> Actualizar Registro
                </button>
            </form>
        </div>
    </div>
@endsection
