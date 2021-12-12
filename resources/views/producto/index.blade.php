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
        <strong class="text-dark">Productos</strong>
        <a href="/producto/crear" class="btn btn-primary d-inline  float-end w-5">Crear Producto</a>
    </div>
    <div class="card-body">
        <table id="tbl_productos" class="table text-center">
            <thead>
                <tr>
                    <th>Id Producto</th>
                    <th>Nombre</th>
                    <th>Precio base</th>
                    <th>Cantidad</th>
                    <th>Fecha creación</th>
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
    $('#tbl_productos').DataTable({
        processing: true,
        serverSide: true,
        language: spanish,
        ajax: '/producto/listar',
        columns: [{
                data: 'id_producto',
                name: 'id_producto'
            },
            {
                data: 'nombre_producto',
                name: 'nombre_producto'
            },
            {
                data: 'precio_base',
                name: 'precio_base'
            },
            {
                data: 'cantidad',
                name: 'cantidad'
            },
            {
                data: 'created_at',
                name: 'created_at'
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