@extends('layouts.master')

    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">


@section('content')
    <div class="register-page py-4">
        <div class="container">
            <div class="card register-card shadow">
                <div class="card-header bg-success text-white text-center">
                    <h4 class="mb-0">👤 Registro de Adminstrador</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- ======= DATOS PERSONALES ======= --}}
                        <h5 class="section-title text-success">
                            <i class="fas fa-id-badge me-2"></i>Información personal
                        </h5>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user me-1"></i>Nombre(s)
                                </label>
                                <input id="name" type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    required autofocus>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="last_name" class="form-label">
                                    <i class="fas fa-user me-1"></i>Apellidos
                                </label>
                                <input id="last_name" type="text" name="last_name"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="type_document" class="form-label">
                                    <i class="fas fa-id-card me-1"></i>Tipo de documento
                                </label>
                                <select id="type_document" name="type_document"
                                    class="form-select @error('type_document') is-invalid @enderror" required>
                                    <option value="" disabled {{ old('type_document') ? '' : 'selected' }}>--
                                        Seleccione --</option>
                                    <option value="CC" {{ old('type_document') === 'CC' ? 'selected' : '' }}>Cédula de
                                        Ciudadanía</option>
                                    <option value="TI" {{ old('type_document') === 'TI' ? 'selected' : '' }}>Tarjeta de
                                        Identidad</option>
                                    <option value="CE" {{ old('type_document') === 'CE' ? 'selected' : '' }}>Cédula de
                                        Extranjería</option>
                                    <option value="PP" {{ old('type_document') === 'PP' ? 'selected' : '' }}>Pasaporte
                                    </option>
                                    <option value="RC" {{ old('type_document') === 'RC' ? 'selected' : '' }}>Registro
                                        Civil</option>
                                </select>
                                @error('type_document')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="number_document" class="form-label">
                                    <i class="fas fa-id-card me-1"></i>Número de documento
                                </label>
                                <input id="number_document" type="number" name="number_document"
                                    class="form-control @error('number_document') is-invalid @enderror"
                                    value="{{ old('number_document') }}" required>
                                @error('number_document')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="number_phone" class="form-label">
                                    <i class="fas fa-phone me-1"></i>Teléfono
                                </label>
                                <input id="number_phone" type="number" name="number_phone"
                                    class="form-control @error('number_phone') is-invalid @enderror"
                                    value="{{ old('number_phone') }}" required>
                                @error('number_phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="gender" class="form-label">
                                    <i class="fas fa-venus-mars me-1"></i>Género
                                </label>
                                <select id="gender" name="gender"
                                    class="form-select @error('gender') is-invalid @enderror" required>
                                    <option value="" disabled {{ old('gender') ? '' : 'selected' }}>-- Seleccione --
                                    </option>
                                    <option value="M" {{ old('gender') === 'M' ? 'selected' : '' }}>Masculino</option>
                                    <option value="F" {{ old('gender') === 'F' ? 'selected' : '' }}>Femenino</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- ======= CREDENCIALES ======= --}}
                        <h5 class="section-title text-primary">
                            <i class="fas fa-key me-2"></i>Credenciales de acceso
                        </h5>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="nickname" class="form-label">
                                    <i class="fas fa-user-tag me-1"></i>Nombre de usuario
                                </label>
                                <input id="nickname" type="text" name="nickname"
                                    class="form-control @error('nickname') is-invalid @enderror"
                                    value="{{ old('nickname') }}" required>
                                @error('nickname')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope me-1"></i>Correo electrónico
                                </label>
                                <input id="email" type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-1"></i>Contraseña
                                </label>
                                <input id="password" type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" required>
                                @error('password')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password-confirm" class="form-label">
                                    <i class="fas fa-lock me-1"></i>Confirmar contraseña
                                </label>
                                <input id="password-confirm" type="password" name="password_confirmation"
                                    class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="role" class="form-label">
                                    <i class="fas fa-user-shield me-1"></i>Rol
                                </label>
                                <select id="role" name="role"
                                    class="form-select @error('role') is-invalid @enderror" required>
                                    <option value="" disabled {{ old('role') ? '' : 'selected' }}>-- Seleccione --
                                    </option>
                                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrador
                                    </option>
                                </select>
                                @error('role')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- ======= FOTO DE PERFIL ======= --}}
                            <h5 class="section-title text-info">
                                <i class="fas fa-image me-2"></i>Foto de Perfil
                            </h5>

                            <div class="mb-4 text-center">
                                <!-- Vista previa -->
                                <img id="preview-image" src="{{ asset('images/profile_photos/Mamacita.jpg') }}"
                                    alt="Vista previa" class="img-thumbnail mb-3"
                                    style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">

                                <!-- Input de imagen -->
                                <input type="file" id="profile_photo" name="profile_photo"
                                    class="form-control @error('profile_photo') is-invalid @enderror" accept="image/*"
                                    onchange="previewImage(event)">
                                @error('profile_photo')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success px-5">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--- Scripts--->
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('preview-image');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
