@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('css/de-todito/attendance.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Asistencia registrada',
            text: @json(session('success')),
            confirmButtonColor: '#00A859'
        });
    </script>
@endif

<section class="asistencia-section">
    <div class="asistencia-card animated fadeIn">
        <div class="asistencia-header">
            <h2>📋 Registro de Asistencia</h2>
            <p>Llena el siguiente formulario para guardar la asistencia de un aprendiz.</p>
        </div>

        <div class="volver-link">
            <a href="{{ route('admin.asistencia.index') }}"><i class="fas fa-arrow-left"></i> Volver al listado</a>
        </div>

        <form action="{{ route('admin.asistencia.store') }}" method="POST" class="asistencia-form">
            @csrf

            <div class="form-group">
                <label for="apprentice_id">👨‍🎓 Aprendiz</label>
                <select name="apprentice_id" required>
                    <option disabled selected>Seleccione un aprendiz</option>
                    @foreach ($aprendices as $aprendiz)
                        <option value="{{ $aprendiz->id }}">
                            {{ $aprendiz->person->full_name ?? 'Sin nombre' }} -
                            {{ $aprendiz->program->technical_sheet ?? 'Sin ficha' }} -
                            {{ $aprendiz->program->initials ?? 'Sin sigla' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="attendance_date">📅 Fecha</label>
                <input type="date" name="attendance_date" required>
            </div>

            <div class="form-group">
                <label for="attendance_status">📌 Estado</label>
                <select name="attendance_status" required>
                    <option disabled selected>Seleccione el estado</option>
                    <option value="Presente">Presente</option>
                    <option value="Ausente">Ausente</option>
                    <option value="Justificado">Justificado</option>
                </select>
            </div>

            <div class="form-group">
                <label for="justification">📝 Justificación</label>
                <textarea name="justification" rows="3" placeholder="Ingrese una justificación si aplica..."></textarea>
            </div>

            <button type="submit" class="btn-registrar">
                <i class="fas fa-save"></i> Guardar Asistencia
            </button>
        </form>
    </div>
</section>
@endsection
