@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('css/aprendiz/create.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Bien!',
            text: @json(session('success')),
            confirmButtonColor: '#00A859'
        });
    </script>
@endif

<section class="ficha-aprendiz">
    <div class="tarjeta-aprendiz animated fadeIn">
        <div class="encabezado-form">
            <img src="{{ asset('images/logo_sena.png') }}" alt="Logo SENA">
            <h2>📄 Registro de Aprendiz</h2>
            <p>Ingresa los datos requeridos para registrar un nuevo aprendiz en el sistema.</p>
        </div>

        @if ($errors->any())
            <div class="alerta-error animated slideInDown">
                <ul>
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.aprendices.store') }}" method="POST" class="formulario-aprendiz">
            @csrf

            <div class="grupo-campo">
                <label>👤 Persona</label>
                <select name="person_id" required>
                    <option disabled selected>Seleccione una persona</option>
                    @foreach ($people as $person)
                        <option value="{{ $person->id }}" {{ old('person_id') == $person->id ? 'selected' : '' }}>
                            {{ $person->name }} {{ $person->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grupo-campo">
                <label>📚 Programa</label>
                <select name="program_id" required>
                    <option disabled selected>Seleccione un programa</option>
                    @foreach ($programs as $program)
                        <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                            {{ $program->program_name }} -- {{$program->technical_sheet}} -- {{ $program->initials }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grupo-campo">
                <label>📌 Estado</label>
                <select name="state" required>
                    <option disabled selected>Seleccione estado</option>
                    <option value="Activo" {{ old('state') == 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ old('state') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    <option value="Graduado" {{ old('state') == 'Graduado' ? 'selected' : '' }}>Graduado</option>
                    <option value="Retirado" {{ old('state') == 'Retirado' ? 'selected' : '' }}>Retirado</option>
                </select>
            </div>

            <div class="grupo-multiple">
                <div class="grupo-campo">
                    <label>📖 Nombre Tutor</label>
                    <input type="text" name="Tutor_name" value="{{ old('Tutor_name') }}" required>
                </div>
                <div class="grupo-campo">
                    <label>📖 Apellido Tutor</label>
                    <input type="text" name="Tutor_last_name" value="{{ old('Tutor_last_name') }}" required>
                </div>
                <div class="grupo-campo">
                    <label>📞 Teléfono Tutor</label>
                    <input type="tel" name="Tutor_number_phone" value="{{ old('Tutor_number_phone') }}" required>
                </div>
            </div>

            <div class="acciones-formulario">
                <button type="submit" class="boton-guardar">
                    <i class="fas fa-user-plus"></i> Guardar
                </button>
                <a href="{{ route('aprendiz.dashboard') }}" class="boton-cancelar">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</section>
@endsection
