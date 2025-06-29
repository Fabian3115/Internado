@extends('layouts.master')

@section('content')
    {{-- Reutilizamos los estilos --}}
        <link rel="stylesheet" href="{{ asset('css/de-todito/attendance.css') }}">


    {{-- Alerta SweetAlert en caso de éxito --}}
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
                <h1>✏️ Editar Asistencia</h1>
                <p>Actualiza la información de asistencia del aprendiz</p>
            </div>

            {{-- Acciones --}}
            <div class="form-actions">
                <a href="{{ route('admin.asistencia.index') }}" class="btn btn-primary">← Volver al listado</a>
            </div>

            {{-- Formulario --}}
            <form action="{{ route('admin.asistencia.update', $asistencia->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Aprendiz (solo lectura) --}}
                <div class="form-group">
                    <label for="apprentice_id">👨‍🎓 Aprendiz</label>
                    <select id="apprentice_id" disabled>
                        @foreach ($aprendices as $aprendiz)
                            <option value="{{ $aprendiz->id }}"
                                {{ $asistencia->apprentice_id == $aprendiz->id ? 'selected' : '' }}>
                                {{ $aprendiz->person->name ?? 'Sin nombre' }}
                            </option>
                        @endforeach
                    </select>
                    {{-- Campo oculto para enviar el apprentice_id --}}
                    <input type="hidden" name="apprentice_id" value="{{ $asistencia->apprentice_id }}">
                </div>

                {{-- Fecha --}}
                <div class="form-group">
                    <label for="attendance_date">📅 Fecha</label>
                    <input type="date" name="attendance_date" id="attendance_date"
                           value="{{ $asistencia->attendance_date }}" required>
                </div>

                {{-- Estado --}}
                <div class="form-group">
                    <label for="attendance_status">📌 Estado</label>
                    <select name="attendance_status" id="attendance_status" required>
                        <option value="" disabled>Seleccione el estado</option>
                        <option value="Presente"   {{ $asistencia->attendance_status == 'Presente'   ? 'selected' : '' }}>Presente</option>
                        <option value="Ausente"    {{ $asistencia->attendance_status == 'Ausente'    ? 'selected' : '' }}>Ausente</option>
                        <option value="Justificado"{{ $asistencia->attendance_status == 'Justificado'? 'selected' : '' }}>Justificado</option>
                    </select>
                </div>

                {{-- Justificación --}}
                <div class="form-group">
                    <label for="justification">📝 Justificación</label>
                    <textarea name="justification" id="justification" rows="3"
                              placeholder="Modifique la justificación si aplica">{{ $asistencia->justification }}</textarea>
                </div>

                {{-- Botón de actualización --}}
                <button type="submit" class="submit-btn">Actualizar Asistencia</button>
            </form>
        </div>
    </div>
@endsection
