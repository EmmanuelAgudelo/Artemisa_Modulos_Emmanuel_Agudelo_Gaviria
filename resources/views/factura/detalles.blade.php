@extends('layouts.app')

@section('content')
<div class="text-center">
    @if(count($detalles) > 0 && count($clientes) > 0)

    <h2 class="text-center mb-5">Detalles de factura</h2>

    <div class="mb-5">

    </div>
    <div class="row w-50" style="margin: 30px auto;">
        <div class="col">
            <h4>Cliente</h4>
            @foreach($clientes as $value)
            <input type="text" class="form-control text-center @error('nombre_cliente') is-invalid @enderror" name="nombre_cliente" readonly value="{{$value->nombre}} {{$value->apellidos}}" id="nombre_cliente">
            @endforeach
        </div>
        <div class="col">
            <h4>Documento</h4>
            @foreach($clientes as $value)
            <input type="text" class="form-control text-center @error('nombre_cliente') is-invalid @enderror" name="nombre_cliente" readonly value="{{$value->documento}}" id="nombre_cliente">
            @endforeach
        </div>
    </div>

    <table class="table text-center w-50 m-auto">
        <h4 class="mb-4 mt-3">---------------------------------Productos---------------------------------</h4>
        <thead>
            <tr>
                <th>Nombre producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Sub total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detalles as $value)
            <tr>
                <td>{{$value->nombre_producto}}</td>
                <td>{{$value->cantidad_t}}</td>
                <td>{{$value->precio_base}}</td>
                <td>{{$value->precio_base * $value->cantidad_t}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-5">
        <h4 class="me-5">Total:</h4>
        @foreach($clientes as $value)
        <input type="text" class="form-control text-center @error('nombre_cliente') is-invalid @enderror" name="nombre_cliente" readonly value="{{$value->total}}" id="nombre_cliente" style="width: 15%;">
        @endforeach
    </div>
    <a href="/factura" class="btn btn-success mt-5">Volver</a>
    @endif
</div>

@endsection