@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col">
        <h3 class="text-center">Facturas</h3>
    </div>
</div>

<form action="/factura/guardar" method="post">
    @csrf
    <div class="row">
        <div class="col-6">

            <div class="card">
                <div class="card-head">
                    <h4 class="text-center mb-3">Info Factura</h4>
                </div>
                <div class="row card-body d-flex justify-content-center">
                    <div class="form-group col-6">
                        <label for="">Cliente</label>
                        <select name="cliente" class="form-control" onchange="colocar_nombre()" id="cliente">
                            <option value="">Seleccione</option>

                            @foreach($clientes as $value)
                            @if($value->estado == 1)
                            <option nombre="{{$value->nombre}} {{$value->apellidos}}" value="{{$value->id}}">{{$value->documento}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="">Nombre del cliente</label>
                        <input type="text" class="form-control @error('nombre_cliente') is-invalid @enderror" name="nombre_cliente" readonly value="" id="nombre_cliente">
                        @error('nombre_cliente')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <label for="">Precio total</label>
                        <input type="number" class="form-control @error('precio_total') is-invalid @enderror" name="precio_total" readonly value="0" id="precio_total">
                        @error('precio_total')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-4 d-block" style="margin: 5% auto; ">
                    <button type="submit" class="btn btn-success">Guardar factura</button>
                </div>
            </div>
        </div>
        <div class="col-6">

            <div class="card">
                <div class="card-head">
                    <h4 class="text-center mb-3">2. Info producto</h4>
                </div>
                <div class="row card-body d-flex justify-content-center">

                    <div class="form-group col-6">
                        <label>Producto</label>
                        <select name="producto" id="producto" class="form-control" onchange="colocar_precio()">
                            <option value="">Seleccione</option>
                            @foreach($productos as $value)
                            @if($value->estado == 1)
                            <option precio="{{$value->precio_base}}" value="{{$value->id_producto}}">{{$value->nombre_producto}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-2">
                        <label>Cantidad</label>
                        <input type="number" class="form-control  @error('cantidad') is-invalid @enderror" name="cantidad" id="cantidad">
                        @error('cantidad')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-3">
                        <label>Precio</label>
                        <input type="number" class="form-control @error('precio') is-invalid @enderror" name="precio" readonly value="0" id="precio">
                        @error('precio')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-success float-right" onclick="agregar_producto()">Agregar</button>
                    </div>
                </div>

                <table id="tbl_productos" class="table text-center">
                    <thead>
                        <tr>
                            <th>Nombre producto</th>
                            <th>precio</th>
                            <th>cantidad</th>
                            <th>Sub total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tbl_productos">

                    </tbody>
                </table>

            </div>
        </div>

    </div>
</form>

@endsection

@section("scripts")
<script>
    function colocar_precio() {
        let precio = $("#producto option:selected").attr("precio");

        $("#precio").val(precio);
    }

    function colocar_nombre() {
        let nombre = $("#cliente option:selected").attr("nombre");

        $("#nombre_cliente").val(nombre);
    }


    function agregar_producto() {
        let producto_id = $("#producto option:selected").val();
        let producto_text = $("#producto option:selected").text();
        let cantidad = $("#cantidad").val();
        let precio = $("#precio").val();

        if (precio > 0 && cantidad > 0) {


            $("#tbl_productos").append(`
            <tr id="tr-${producto_id}">
            <td>
                <input type="hidden" name="producto_id[]" value="${producto_id}">
                <input type="hidden" name="cantidades[]" value="${cantidad}">
                <input type="hidden" name="precios[]" value="${precio}">
                ${producto_text}
            </td>
            <td>${precio}</td>
            <td>${cantidad}</td>
            <td>${parseInt(cantidad) * parseInt(precio)}</td>
            <td>
            <button type="button" class="btn btn-danger bg-danger" style="width: 35px; height: 35px; display: flex;margin: auto;" onclick="eliminar_producto(${producto_id}, ${parseInt(cantidad) * parseInt(precio)})"><i class="fas fa-ban"></i></button>
            </td>
            </tr>
            `);
            let precio_total = $("#precio_total").val() || 0;
            $("#precio_total").val(parseInt(precio_total) + parseInt(cantidad) * parseInt(precio));

        } else {

        }

    }


    function eliminar_producto(id, subtotal) {
        $("#tr-" + id).remove();
        let precio_total = $("#precio_total").val() || 0;
        $("#precio_total").val(parseInt(precio_total) - subtotal);
    }
</script>

@endsection