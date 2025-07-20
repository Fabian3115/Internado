@extends('layouts.master')

@section('content')
<style>
    :root {
        --verde-sena: #39A900;
        --gris-fondo: #f4f6f8;
        --blanco: #ffffff;
        --sombra: 0 4px 10px rgba(0, 0, 0, 0.1);
        --radio: 12px;
    }

    body {
        background-color: var(--gris-fondo);
    }

    .container-lista {
        max-width: 1000px;
        margin: 50px auto;
        background: var(--blanco);
        border-radius: var(--radio);
        box-shadow: var(--sombra);
        padding: 20px;
        font-family: 'Segoe UI', sans-serif;
    }

    .titulo-lista {
        text-align: center;
        color: var(--verde-sena);
        font-weight: bold;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
    }

    th, td {
        padding: 12px 15px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        font-size: 14px;
    }

    th {
        background-color: var(--verde-sena);
        color: var(--blanco);
        text-transform: uppercase;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    .acciones {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .btn {
        padding: 6px 12px;
        border-radius: var(--radio);
        font-size: 14px;
        font-weight: bold;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-editar {
        background-color: var(--verde-sena);
        color: var(--blanco);
    }

    .btn-editar:hover {
        background-color: #2e7d32;
    }

    .btn-eliminar {
        background-color: #e53935;
        color: var(--blanco);
    }

    .btn-eliminar:hover {
        background-color: #c62828;
    }
</style>

<div class="container-lista">
    <h2 class="titulo-lista">Mis Solicitudes de Salida</h2>

    @if($salidas->isEmpty())
        <p style="text-align:center; color:#666;">No tienes solicitudes registradas.</p>
    @else
    <table>
        <thead>
            <tr>
                <th>Motivo</th>
                <th>Salida</th>
                <th>Regreso</th>
                <th>Destino</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salidas as $salida)
            <tr>
                <td>{{ $salida->reason }}</td>
                <td>{{ \Carbon\Carbon::parse($salida->departure_date)->format('d/m/Y H:i') }}</td>
                <td>{{ $salida->return_date ? \Carbon\Carbon::parse($salida->return_date)->format('d/m/Y H:i') : '-' }}</td>
                <td>{{ $salida->destination ?? '-' }}</td>
                <td>
                    @if($salida->status == 'pendiente')
                        <span style="color: orange;">Pendiente</span>
                    @elseif($salida->status == 'aprobada')
                        <span style="color: green;">Aprobada</span>
                    @else
                        <span style="color: red;">Rechazada</span>
                    @endif
                </td>
                <td class="acciones">
                    <a href="{{ route('salidas.edit', $salida->id) }}" class="btn btn-editar">Editar</a>
                    <form action="{{ route('salidas.destroy', $salida->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-eliminar" onclick="return confirm('¿Seguro que deseas eliminar esta solicitud?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
