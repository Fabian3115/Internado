@extends('layouts.master')

@section('content')
    {{-- Estilos exclusivos del módulo Aprendiz --}}
    <link rel="stylesheet" href="{{ asset('css/aprendiz/create.css') }}">

    {{-- SweetAlert para actualización exitosa --}}
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Actualización exitosa',
                text: @json(session('success')),
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#00A859'
            });
        @endif
    </script>

    <section class="apprentice-section">
        <div class="card-wrapper shadow-lg">
            {{-- ===== Aside ilustración ===== --}}
            <aside class="card-aside d-none d-md-flex">
                <div class="aside-content text-light text-center px-4">
                    <h2 class="fw-bold mb-3">🔄 Editar Aprendiz</h2>
                    <p class="small opacity-75">
                        Actualiza la información básica, beneficios y programa formativo
                        de tus aprendices de manera sencilla.
                    </p>
                    <img src="{{ asset('images/logo_sena.png') }}" alt="Logo SENA" class="sena-logo mt-auto">
                </div>
            </aside>

            {{-- ===== Formulario ===== --}}
            <div class="card-form p-4 p-md-5">
                <h1 class="h4 fw-bold text-center mb-4">Editar Aprendiz</h1>

                {{-- Errores de validación --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.aprendices.update', $apprentice->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    {{-- Persona --}}
                    <div class="form-group mb-3">
                        <label for="person_id">👤 Persona</label>
                        <select name="person_id" id="person_id" required>
                            @foreach ($people as $person)
                                <option value="{{ $person->id }}"
                                    {{ old('person_id', $apprentice->person_id) == $person->id ? 'selected' : '' }}>
                                    {{ $person->name }} {{ $person->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Programa --}}
                    <div class="form-group mb-3">
                        <label for="program_id">📚 Programa</label>
                        <select name="program_id" id="program_id" required>
                            @foreach ($programs as $program)
                                <option value="{{ $program->id }}"
                                    {{ old('program_id', $apprentice->program_id) == $program->id ? 'selected' : '' }}>
                                    {{ $program->program_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Estado --}}
                    <div class="form-group mb-3">
                        <label for="state">📌 Estado</label>
                        <select name="state" id="state" required>
                            <option value="Activo"   {{ old('state', $apprentice->state) == 'Activo'   ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ old('state', $apprentice->state) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            <option value="Graduado" {{ old('state', $apprentice->state) == 'Graduado' ? 'selected' : '' }}>Graduado</option>
                            <option value="Retirado" {{ old('state', $apprentice->state) == 'Retirado' ? 'selected' : '' }}>Retirado</option>
                        </select>
                    </div>

                    {{-- Datos del Tutor --}}
                    <div class="row gx-2">
                        <div class="col-md-4 mb-3 form-group">
                            <label for="Tutor_name">📖 Nombre Tutor</label>
                            <input type="text" id="Tutor_name" name="Tutor_name"
                                   value="{{ old('Tutor_name', $apprentice->Tutor_name) }}" required>
                        </div>
                        <div class="col-md-4 mb-3 form-group">
                            <label for="Tutor_last_name">📖 Apellido Tutor</label>
                            <input type="text" id="Tutor_last_name" name="Tutor_last_name"
                                   value="{{ old('Tutor_last_name', $apprentice->Tutor_last_name) }}" required>
                        </div>
                        <div class="col-md-4 mb-3 form-group">
                            <label for="Tutor_number_phone">📞 Teléfono Tutor</label>
                            <input type="tel" id="Tutor_number_phone" name="Tutor_number_phone"
                                   value="{{ old('Tutor_number_phone', $apprentice->Tutor_number_phone) }}" required>
                        </div>
                    </div>

                    {{-- Botones --}}
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save me-1"></i> Actualizar
                        </button>
                        <a href="{{ route('aprendiz.dashboard') }}" class="btn-cancel">
                            <i class="fas fa-times me-1"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
