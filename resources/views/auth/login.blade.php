@extends('layouts.masterusers')

@section('title', 'Internado SENA – Iniciar Sesión')

<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@section('contenido')
    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <h2>🔐 Iniciar Sesión</h2>
                <p>Bienvenido al sistema del Internado SENA</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf

                {{-- Correo --}}
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope me-1"></i>Correo electrónico</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="@error('email') is-invalid @enderror">
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Contraseña --}}
                <div class="form-group">

                    <label for="password"><i class="fas fa-lock me-1"></i>Contraseña</label>
                    <input id="password" type="password" name="password" required
                        class="@error('password') is-invalid @enderror">
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Recordarme --}}
                <div class="form-remember">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Recuérdame</label>
                </div>

                {{-- Botón --}}
                <div class="form-footer">
                    <button type="submit" class="btn-login w-100 mt-3">
                        <i class="fas fa-sign-in-alt me-1"></i>Ingresar
                    </button>
                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                    <p>¿No tienes Cuenta? <a class="register" href="{{route('register')}}">Registrate aquÍ</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection
