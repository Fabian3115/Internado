@extends('layouts.master')

@section('content')
    {{-- Reutilizamos los estilos --}}
    <link rel="stylesheet" href="{{ asset('css/de-todito/attendance.css') }}">

    {{-- Alerta SweetAlert si el registro fue exitoso --}}
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
                <h1>🎁 Registrar Beneficio</h1>
                <p>Define el porcentaje y las horas totales asociadas</p>
            </div>

            {{-- Acciones --}}
            <div class="form-actions">
                <a href="{{ route('admin.beneficio.index') }}" class="btn btn-primary">← Volver al listado</a>
            </div>

            {{-- Formulario --}}
            <form action="{{ route('admin.beneficio.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                {{-- Porcentaje --}}
                <div class="form-group">
                    <label for="percentage">📊 Porcentaje (%)</label>
                    <input type="number" step="0.01" name="percentage" id="percentage" required>
                </div>

                {{-- Horas totales --}}
                <div class="form-group">
                    <label for="total_hours">⏳ Horas Totales</label>
                    <input type="number" name="total_hours" id="total_hours" required>
                </div>

                {{-- Botón de Guardar --}}
                <button type="submit" class="submit-btn">Guardar Beneficio</button>
            </form>
        </div>
    </div>
@endsection
