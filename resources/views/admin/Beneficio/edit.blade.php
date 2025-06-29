@extends('layouts.master')

@section('content')
    {{-- Reutilizamos los estilos --}}
    <link rel="stylesheet" href="{{ asset('css/de-todito/attendance.css') }}">

    {{-- SweetAlert para mensaje de éxito --}}
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
                <h1>✏️ Editar Beneficio</h1>
                <p>Modifica los datos del beneficio registrado</p>
            </div>

            {{-- Acciones --}}
            <div class="form-actions">
                <a href="{{ route('admin.beneficio.index') }}" class="btn btn-primary">← Volver al listado</a>
            </div>

            {{-- Errores de validación --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin-bottom: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br>
            @endif

            {{-- Formulario --}}
            <form action="{{ route('admin.beneficio.update', $benefit->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                {{-- Porcentaje --}}
                <div class="form-group">
                    <label for="percentage">📊 Porcentaje (%)</label>
                    <input type="number" step="0.01" min="0" name="percentage" id="percentage"
                        value="{{ old('percentage', $benefit->percentage) }}" required>
                </div>

                {{-- Horas Totales --}}
                <div class="form-group">
                    <label for="total_hours">⏳ Horas Totales</label>
                    <input type="number" min="0" name="total_hours" id="total_hours"
                        value="{{ old('total_hours', $benefit->total_hours) }}" required>
                </div>

                {{-- Botón Guardar --}}
                <button type="submit" class="submit-btn">
                    <i class="fas fa-save me-1"></i> Guardar cambios
                </button>
            </form>
        </div>
    </div>
@endsection
