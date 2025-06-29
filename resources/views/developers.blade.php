@extends('layouts.masterusers')

@section('contenido')
    {{-- Incluir SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Registro Exitoso',
                text: "{{ session('success') }}",
                confirmButtonText: 'Entendido'
            });
        </script>
    @endif

    {{-- Contenedor principal --}}
    <div class="container mt-5">
        <h1 class="mb-4">Desarrolladores del Sistema</h1>
        <div class="row justify-content-center">

            <h2>Equipo de Desarrollo</h2>
            <p>Conoce a los desarrolladores que hicieron posible este sistema.</p>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('images/developer1.jpg') }}" class="card-img-top" alt="Desarrollador 1">
                    <div class="card-body">
                        <h5 class="card-title">Desarrollador 1</h5>
                        <p class="card-text">Descripción breve del desarrollador 1, su rol en el proyecto y sus
                            contribuciones.</p>
                        <a href="" class="btn btn-primary">Perfil de GitHub</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('images/developer2.jpg') }}" class="card-img-top" alt="Desarrollador 2">
                    <div class="card-body">
                        <h5 class="card-title">Desarrollador 2</h5>
                        <p class="card-text">Descripción breve del desarrollador 2, su rol en el proyecto y sus
                            contribuciones.</p>
                        <a href="" class="btn btn-primary">Perfil de GitHub</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h1 class="mb-4">Contribuciones al Proyecto</h1>
        <p>Este proyecto fue desarrollado por un equipo de profesionales apasionados por la tecnología y el desarrollo de
            software. Cada miembro del equipo aportó sus habilidades y experiencia para crear un sistema robusto y
            eficiente.</p>
        <p>Para más información sobre el proyecto, puedes visitar nuestro repositorio en GitHub o contactar a los
            desarrolladores directamente.</p>
    </div>
@endsection
