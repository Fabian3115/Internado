@extends('layouts.master')

@section('content')
    {{-- Reutilizamos los estilos --}}
    <link rel="stylesheet" href="{{ asset('css/de-todito/attendance.css') }}">

    {{-- SweetAlert para confirmación de actualización --}}
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Actualización exitosa',
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
                <h1>✏️ Editar Programa de Formación</h1>
                <p>Modifica los datos del programa</p>
            </div>

            {{-- Botón volver al listado --}}
            <div class="form-actions">
                <a href="{{ route('admin.programa.index') }}" class="btn btn-primary">← Volver al listado</a>
            </div>

            {{-- Formulario --}}
            <form action="{{ route('admin.programa.update', $program->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                {{-- Nombre del programa --}}
                <div class="form-group">
                    <label for="program_name">📚 Nombre del Programa</label>
                    <input type="text" id="program_name" name="program_name"
                           class="@error('program_name') is-invalid @enderror"
                           value="{{ old('program_name', $program->program_name) }}" required>
                    @error('program_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                {{-- Ficha técnica --}}
                <div class="form-group">
                    <label for="technical_sheet">📄 Ficha Técnica</label>
                    <input type="number" id="technical_sheet" name="technical_sheet"
                           class="@error('technical_sheet') is-invalid @enderror"
                           value="{{ old('technical_sheet', $program->technical_sheet) }}" min="1" required>
                    @error('technical_sheet') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                {{-- Nivel --}}
                <div class="form-group">
                    <label for="level">🏷️ Nivel</label>
                    <select id="level" name="level" class="@error('level') is-invalid @enderror" required>
                        <option value="" disabled>Seleccione un nivel</option>
                        <option value="Técnico"   {{ old('level', $program->level) == 'Técnico'   ? 'selected' : '' }}>Técnico</option>
                        <option value="Tecnólogo" {{ old('level', $program->level) == 'Tecnólogo' ? 'selected' : '' }}>Tecnólogo</option>
                    </select>
                    @error('level') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                {{-- Sigla --}}
                <div class="form-group">
                    <label for="initials">🔤 Sigla</label>
                    <input type="text" id="initials" name="initials"
                           class="@error('initials') is-invalid @enderror"
                           value="{{ old('initials', $program->initials) }}" maxlength="10" required>
                    @error('initials') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                {{-- Modalidad --}}
                <div class="form-group">
                    <label for="mode">🖥️ Modalidad</label>
                    <select id="mode" name="mode" class="@error('mode') is-invalid @enderror" required>
                        <option value="" disabled>Seleccione una modalidad</option>
                        <option value="Presencial" {{ old('mode', $program->mode) == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                        <option value="Virtual"    {{ old('mode', $program->mode) == 'Virtual'    ? 'selected' : '' }}>Virtual</option>
                    </select>
                    @error('mode') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                {{-- Botón Actualizar --}}
                <button type="submit" class="submit-btn">
                    <i class="fas fa-save me-1"></i> Actualizar
                </button>
            </form>
        </div>
    </div>
@endsection
