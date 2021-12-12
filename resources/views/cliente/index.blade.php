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
        <strong class="text-dark">Clientes</strong>
        <a href="/cliente/crear" class="btn btn-primary d-inline  float-end w-5">Crear cliente</a>
    </div>
    <div class="card-body">
        <table id="tbl_clientes" class="table text-center">
            <thead>
                <tr>
                    <th>Id Cliente</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Documento</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Estado</th>
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
    $('#tbl_clientes').DataTable({
        processing: true,
        serverSide: true,
        language: spanish,
        ajax: '/cliente/listar',
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'nombre',
                name: 'nombre'
            },
            {
                data: 'apellidos',
                name: 'apellidos'
            },
            {
                data: 'documento',
                name: 'documento'
            },
            {
                data: 'telefono',
                name: 'telefono'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'estado',
                name: 'estado',
                orderable: false,
                searchable: false
            },
            {
                data: 'acciones',
                name: 'acciones',
                orderable: false,
                searchable: false
            }
        ]
    });
</script>
@endsection