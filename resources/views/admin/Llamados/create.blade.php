@extends('layouts.master')

@section('content')
    {{-- Reutilizamos los estilos --}}
    <link rel="stylesheet" href="{{ asset('css/de-todito/attendance.css') }}">

    {{-- SweetAlert para registro exitoso --}}
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
                <h1>🚨 Registrar Incidente</h1>
                <p>Ingresa los detalles del incidente o llamado de atención</p>
            </div>

            {{-- Botón volver al listado --}}
            <div class="form-actions">
                <a href="{{ route('admin.atencion.index') }}" class="btn btn-primary">← Volver al listado</a>
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
            <form action="{{ route('admin.atencion.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                {{-- Aprendiz --}}
                <div class="form-group">
                    <label for="apprentice_id">👨‍🎓 Aprendiz</label>
                    <select name="apprentice_id" id="apprentice_id" required>
                        <option value="" disabled selected>Seleccione un aprendiz</option>
                        @foreach ($aprendices as $aprendiz)
                            <option value="{{ $aprendiz->id }}" {{ old('apprentice_id') == $aprendiz->id ? 'selected' : '' }}>
                                {{ $aprendiz->person->name ?? 'Sin nombre' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Fecha --}}
                <div class="form-group">
                    <label for="date">📅 Fecha del Incidente</label>
                    <input type="date" name="date" id="date"
                           value="{{ old('date', now()->toDateString()) }}" required>
                </div>

                {{-- Tipo de incidente --}}
                <div class="form-group">
                    <label for="incident">⚠️ Tipo de Incidente</label>
                    <input type="text" name="incident" id="incident"
                           value="{{ old('incident') }}" required>
                </div>

                {{-- Descripción --}}
                <div class="form-group">
                    <label for="description">📝 Descripción</label>
                    <textarea name="description" id="description" rows="3" required>{{ old('description') }}</textarea>
                </div>

                {{-- Observaciones --}}
                <div class="form-group">
                    <label for="observations">🔍 Observaciones</label>
                    <textarea name="observations" id="observations" rows="3">{{ old('observations') }}</textarea>
                </div>

                {{-- Campos ocultos --}}
                <input type="hidden" name="recorded_by" value="{{ Auth::id() }}">

                {{-- Botón Guardar --}}
                <button type="submit" class="submit-btn">
                    <i class="fas fa-save me-1"></i> Guardar
                </button>
            </form>
        </div>
    </div>
@endsection
