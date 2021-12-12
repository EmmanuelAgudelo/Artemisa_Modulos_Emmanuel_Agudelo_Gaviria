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
        <strong class="text-dark">Facturas</strong>
        <a href="/factura/crear" class="btn btn-primary d-inline  float-end w-5">Crear Factura</a>
    </div>
    <div class="card-body">
        <table id="tbl_factura" class="table text-center">
            <thead>
                <tr>
                    <th>Id Factura</th>
                    <th>Documento cliente</th>
                    <th>Fecha factura</th>
                    <th>Total</th>
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
<script src="/js/modal.js"></script>
<script>
    $('#tbl_factura').DataTable({
        processing: true,
        serverSide: true,
        language: spanish,
        ajax: '/factura/listar',
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'documento',
                name: 'documento'
            },
            {
                data: 'fecha',
                name: 'fecha'
            },

            {
                data: 'total',
                name: 'total'
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

<script>

</script>
@endsection