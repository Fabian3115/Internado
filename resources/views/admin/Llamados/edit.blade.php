@extends('layouts.master')

@section('content')
    {{-- Reutilizamos los estilos --}}
    <link rel="stylesheet" href="{{ asset('css/de-todito/attendance.css') }}">

    {{-- SweetAlert mensaje de éxito --}}
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Registro Actualizado',
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
                <h1>✏️ Editar Incidente</h1>
                <p>Modifica la información del incidente registrado</p>
            </div>

            {{-- Botón volver al listado --}}
            <div class="form-actions">
                <a href="{{ route('incidents.index') }}" class="btn btn-primary">← Volver al listado</a>
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
            <form action="{{ route('incidents.update', $incident->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                {{-- Aprendiz --}}
                <div class="form-group">
                    <label for="apprentice_id">👨‍🎓 Aprendiz</label>
                    <select name="apprentice_id" id="apprentice_id" required>
                        @foreach ($aprendices as $aprendiz)
                            <option value="{{ $aprendiz->id }}"
                                {{ old('apprentice_id', $incident->apprentice_id) == $aprendiz->id ? 'selected' : '' }}>
                                {{ $aprendiz->person->full_name ?? 'Sin nombre' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Fecha --}}
                <div class="form-group">
                    <label for="date">📅 Fecha del Incidente</label>
                    <input type="date" name="date" id="date"
                           value="{{ old('date', $incident->date->format('Y-m-d')) }}" required>
                </div>

                {{-- Tipo de incidente --}}
                <div class="form-group">
                    <label for="incident">⚠️ Tipo de Incidente</label>
                    <input type="text" name="incident" id="incident"
                           value="{{ old('incident', $incident->incident) }}" required>
                </div>

                {{-- Descripción --}}
                <div class="form-group">
                    <label for="description">📝 Descripción</label>
                    <textarea name="description" id="description" rows="3" required>{{ old('description', $incident->description) }}</textarea>
                </div>

                {{-- Observaciones --}}
                <div class="form-group">
                    <label for="observations">🔍 Observaciones</label>
                    <textarea name="observations" id="observations" rows="3">{{ old('observations', $incident->observations) }}</textarea>
                </div>

                {{-- recorded_by (oculto) --}}
                <input type="hidden" name="recorded_by" value="{{ $incident->recorded_by }}">

                {{-- Botón Actualizar --}}
                <button type="submit" class="submit-btn">
                    <i class="fas fa-save me-1"></i> Actualizar
                </button>
            </form>
        </div>
    </div>
@endsection
