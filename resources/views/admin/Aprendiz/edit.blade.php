@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('css/aprendiz/estilo_animado.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Actualización exitosa',
            text: @json(session('success')),
            confirmButtonColor: '#00A859'
        });
    </script>
@endif

<section class="ficha-aprendiz">
    <div class="tarjeta-aprendiz animated fadeIn">
        <div class="encabezado-form">
            <img src="{{ asset('images/logo_sena.png') }}" alt="Logo SENA">
            <h2>✏️ Editar Aprendiz</h2>
            <p>Modifica los datos necesarios del aprendiz y mantén actualizada su información.</p>
        </div>

        @if ($errors->any())
            <div class="alerta-error animated slideInDown">
                <ul>
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.aprendices.update', $apprentice->id) }}" method="POST" class="formulario-aprendiz">
            @csrf
            @method('PUT')

            <div class="grupo-campo">
                <label>👤 Persona</label>
                <select name="person_id" required>
                    @foreach ($people as $person)
                        <option value="{{ $person->id }}" {{ old('person_id', $apprentice->person_id) == $person->id ? 'selected' : '' }}>
                            {{ $person->name }} {{ $person->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grupo-campo">
                <label>📚 Programa</label>
                <select name="program_id" required>
                    @foreach ($programs as $program)
                        <option value="{{ $program->id }}" {{ old('program_id', $apprentice->program_id) == $program->id ? 'selected' : '' }}>
                            {{ $program->program_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grupo-campo">
                <label>📌 Estado</label>
                <select name="state" required>
                    <option value="Activo"   {{ old('state', $apprentice->state) == 'Activo'   ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ old('state', $apprentice->state) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    <option value="Graduado" {{ old('state', $apprentice->state) == 'Graduado' ? 'selected' : '' }}>Graduado</option>
                    <option value="Retirado" {{ old('state', $apprentice->state) == 'Retirado' ? 'selected' : '' }}>Retirado</option>
                </select>
            </div>

            <div class="grupo-multiple">
                <div class="grupo-campo">
                    <label>📖 Nombre Tutor</label>
                    <input type="text" name="Tutor_name" value="{{ old('Tutor_name', $apprentice->Tutor_name) }}" required>
                </div>
                <div class="grupo-campo">
                    <label>📖 Apellido Tutor</label>
                    <input type="text" name="Tutor_last_name" value="{{ old('Tutor_last_name', $apprentice->Tutor_last_name) }}" required>
                </div>
                <div class="grupo-campo">
                    <label>📞 Teléfono Tutor</label>
                    <input type="tel" name="Tutor_number_phone" value="{{ old('Tutor_number_phone', $apprentice->Tutor_number_phone) }}" required>
                </div>
            </div>

            <div class="acciones-formulario">
                <button type="submit" class="boton-guardar">
                    <i class="fas fa-save"></i> Actualizar
                </button>
                <a href="{{ route('aprendiz.dashboard') }}" class="boton-cancelar">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</section>
@endsection
