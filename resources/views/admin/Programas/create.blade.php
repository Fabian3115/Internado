@extends('layouts.master')

@section('content')
    {{-- Reutilizamos los estilos --}}
    <link rel="stylesheet" href="{{ asset('css/de-todito/attendance.css') }}">

    {{-- SweetAlert de éxito --}}
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
                <h1>🎓 Crear Programa de Formación</h1>
                <p>Ingresa los detalles del nuevo programa</p>
            </div>

            {{-- Botón volver al listado --}}
            <div class="form-actions">
                <a href="{{ route('admin.programa.index') }}" class="btn btn-primary">← Volver al listado</a>
            </div>

            {{-- Formulario --}}
            <form action="{{ route('admin.programa.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                {{-- Nombre del programa --}}
                <div class="form-group">
                    <label for="program_name">📚 Nombre del Programa</label>
                    <input type="text" name="program_name" id="program_name"
                           value="{{ old('program_name') }}" required>
                </div>

                {{-- Ficha técnica --}}
                <div class="form-group">
                    <label for="technical_sheet">📄 Ficha Técnica</label>
                    <input type="number" name="technical_sheet" id="technical_sheet"
                           value="{{ old('technical_sheet') }}" required>
                </div>

                {{-- Nivel --}}
                <div class="form-group">
                    <label for="level">🏷️ Nivel</label>
                    <select name="level" id="level" required>
                        <option value="" disabled selected>Seleccione un nivel</option>
                        <option value="Técnico"   {{ old('level') == 'Técnico'   ? 'selected' : '' }}>Técnico</option>
                        <option value="Tecnólogo" {{ old('level') == 'Tecnólogo' ? 'selected' : '' }}>Tecnólogo</option>
                    </select>
                </div>

                {{-- Sigla --}}
                <div class="form-group">
                    <label for="initials">🔤 Sigla</label>
                    <input type="text" name="initials" id="initials"
                           value="{{ old('initials') }}" required>
                </div>

                {{-- Modalidad --}}
                <div class="form-group">
                    <label for="mode">🖥️ Modalidad</label>
                    <select name="mode" id="mode" required>
                        <option value="" disabled selected>Seleccione una modalidad</option>
                        <option value="Presencial" {{ old('mode') == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                        <option value="Virtual"    {{ old('mode') == 'Virtual'    ? 'selected' : '' }}>Virtual</option>
                    </select>
                </div>

                {{-- Botón Guardar --}}
                <button type="submit" class="submit-btn">
                    <i class="fas fa-save me-1"></i> Guardar
                </button>
            </form>
        </div>
    </div>
@endsection
