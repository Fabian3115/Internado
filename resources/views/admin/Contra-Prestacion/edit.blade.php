@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Editar Registro de Horas</h1>
            <a href="{{ route('admin.contra_prestacion.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Volver
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.contra_prestacion.update', $hora->id) }}" method="POST" class="card p-4 shadow">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="apprentice_id" class="form-label">Aprendiz</label>
                <select name="apprentice_id" id="apprentice_id" class="form-select" required>
                    @foreach ($aprendices as $aprendiz)
                        <option value="{{ $aprendiz->id }}" {{ $hora->apprentice_id == $aprendiz->id ? 'selected' : '' }}>
                            {{ $aprendiz->person->full_name ?? $aprendiz->person->name . ' ' . $aprendiz->person->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="hours" class="form-label">Horas</label>
                <input type="number" name="hours" id="hours" class="form-control" value="{{ old('hours', $hora->hours) }}" required min="1" step="1">
            </div>

            <div class="mb-3">
                <label for="activity_date" class="form-label">Fecha de Actividad</label>
                <input type="date" name="activity_date" id="activity_date" class="form-control" value="{{ old('activity_date', $hora->activity_date) }}" required>
            </div>

            <div class="mb-3">
                <label for="activity_description" class="form-label">Descripción de la Actividad</label>
                <textarea name="activity_description" id="activity_description" class="form-control" rows="4">{{ old('activity_description', $hora->activity_description) }}</textarea>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Actualizar
                </button>
            </div>
        </form>
    </div>
@endsection
