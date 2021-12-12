@extends('layouts.app')

@section('content')

<div class="card bg-light">
    @if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">

        {{ Session::get('error') }}


        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">

        {{ Session::get('success') }}


        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="card-header">
        <strong class="text-dark">Eventos</strong>
        <a href="/evento/crear" class="btn btn-primary d-inline  float-end w-5 ">Crear evento</a>
        <a href="/evento/antiguo" class="btn btn-danger d-inline  float-end w-5 me-5">Ver eventos antiguos</a>
    </div>
    <div class="card-body">
        <table id="tbl_eventos" class="table text-center">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Imagen</th>
                    <th>Descripción</th>
                    <th>V. Entrada</th>
                    <th>V. Decoración</th>
                    <th>Estado</th>
                    <th>inicio</th>
                    <th>fin</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
@endsection
@section("scripts")
<script>
    $('#tbl_eventos').DataTable({
        processing: true,
        serverSide: true,
        language: spanish,
        ajax: '/evento/listar',
        columns: [{
                data: 'nombre',
                name: 'nombre'
            },
            {
                data: 'imagen',
                name: 'imagen',
                orderable: false,
                searchable: false
            },
            {
                data: 'descripcion',
                name: 'descripcion',
                width: '15px'
            },
            {
                data: 'valor_entrada',
                name: 'valor_entrada'
            },
            {
                data: 'valor_decoracion',
                name: 'valor_decoracion'
            },
            {
                data: 'estado',
                name: 'estado',
                orderable: false,
                searchable: false
            },
            {
                data: 'inicio',
                name: 'inicio'
            },
            {
                data: 'fin',
                name: 'fin',

            },
            {
                data: 'acciones',
                name: 'acciones',
                orderable: false,
                searchable: false,
                width: '200px'
            }
        ]
    });
</script>
@endsection