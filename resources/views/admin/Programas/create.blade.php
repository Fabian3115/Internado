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
            <h2>🎓 Crear Programa de Formación</h2>
            <p>Ingresa los detalles del nuevo programa para agregarlo al sistema.</p>
        </div>

        <div class="volver-link">
            <a href="{{ route('admin.programa.index') }}">
                <i class="fas fa-arrow-left"></i> Volver al listado
            </a>
        </div>

        <form action="{{ route('admin.programa.store') }}" method="POST" class="asistencia-form">
            @csrf

            <div class="form-group">
                <label for="program_name">📚 Nombre del Programa</label>
                <input type="text" name="program_name" value="{{ old('program_name') }}" required>
            </div>

            <div class="form-group">
                <label for="technical_sheet">📄 Ficha Técnica</label>
                <input type="number" name="technical_sheet" value="{{ old('technical_sheet') }}" required>
            </div>

            <div class="form-group">
                <label for="level">🏷️ Nivel</label>
                <select name="level" required>
                    <option value="" disabled selected>Seleccione un nivel</option>
                    <option value="Técnico"   {{ old('level') == 'Técnico' ? 'selected' : '' }}>Técnico</option>
                    <option value="Tecnólogo" {{ old('level') == 'Tecnólogo' ? 'selected' : '' }}>Tecnólogo</option>
                </select>
            </div>

            <div class="form-group">
                <label for="initials">🔤 Sigla</label>
                <input type="text" name="initials" value="{{ old('initials') }}" required>
            </div>

            <!--- MODALIDAD--->
            <div class="form-group">
                <input type="hidden" name="mode" value="Presencial">
            </div>

            <button type="submit" class="btn-registrar">
                <i class="fas fa-save"></i> Guardar
            </button>
        </form>
    </div>
</section>
@endsection
