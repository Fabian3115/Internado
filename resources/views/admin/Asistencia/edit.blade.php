@extends('layouts.master')

@section('content')
    {{-- CSS del formulario --}}
    <link rel="stylesheet" href="{{ asset('css/de-todito/attendance.css') }}">

    {{-- Alerta SweetAlert si hubo éxito --}}
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Actualizado',
                text: @json(session('success')),
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#00A859'
            });
        @endif
    </script>

    {{-- ===== Contenido principal ===== --}}
    <div class="background-image">
        <div class="form-wrapper">
            <div class="form-header">
                <h1>✏️ Editar Asistencia</h1>
                <p>Modifica la información de la asistencia del aprendiz</p>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.asistencia.index') }}" class="btn btn-primary">← Volver al listado</a>
            </div>

            {{-- Formulario de edición --}}
            <form action="{{ route('admin.asistencia.update', $asistencia->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Aprendiz --}}
                <div class="form-group">
                    <label for="apprentice_id">👨‍🎓 Aprendiz</label>
                    <select name="apprentice_id" id="apprentice_id" required>
                        <option value="" disabled>Seleccione un aprendiz</option>
                        @foreach ($aprendices as $aprendiz)
                            <option value="{{ $aprendiz->id }}"
                                {{ $asistencia->apprentice_id == $aprendiz->id ? 'selected' : '' }}>
                                {{ $aprendiz->person->full_name ?? 'Sin nombre' }} --
                                {{ $aprendiz->program->technical_sheet ?? 'Sin Ficha' }} --
                                {{ $aprendiz->program->initials ?? 'Sin Sigla' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Fecha de asistencia --}}
                <div class="form-group">
                    <label for="attendance_date">📅 Fecha</label>
                    <input type="date" name="attendance_date" id="attendance_date"
                        value="{{ $asistencia->attendance_date }}" required>
                </div>

                {{-- Estado de asistencia --}}
                <div class="form-group">
                    <label for="attendance_status">📌 Estado</label>
                    <select name="attendance_status" id="attendance_status" required>
                        <option value="Presente" {{ $asistencia->attendance_status == 'Presente' ? 'selected' : '' }}>Presente</option>
                        <option value="Ausente" {{ $asistencia->attendance_status == 'Ausente' ? 'selected' : '' }}>Ausente</option>
                        <option value="Justificado" {{ $asistencia->attendance_status == 'Justificado' ? 'selected' : '' }}>Justificado</option>
                    </select>
                </div>

                {{-- Justificación --}}
                <div class="form-group">
                    <label for="justification">📝 Justificación</label>
                    <textarea name="justification" id="justification" rows="3"
                        placeholder="Ingrese una justificación si aplica">{{ $asistencia->justification }}</textarea>
                </div>

                {{-- Botón de envío --}}
                <button type="submit" class="submit-btn">Actualizar Asistencia</button>
            </form>
        </div>
    </div>
@endsection
