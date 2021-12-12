@extends('layouts.app')

@section('content')

<div class="card bg-light">
    <div class="card-header">
        <strong>Crear productos</strong>
    </div>
    <div class="card-body">

        <form action="/producto/guardar" method="post">
            @csrf
            <div class="row d-flex justify-content-center">
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Nombre producto</label>
                        <input type="text" class="form-control @error('nombre_producto') is-invalid @enderror" name="nombre_producto">
                        @error('nombre_producto')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Precio</label>
                        <input type="number" class="form-control @error('precio_base') is-invalid @enderror" name="precio_base">
                        @error('precio_base')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    input
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Cantidad</label>
                        <input type="number" class="form-control @error('cantidad') is-invalid @enderror" name="cantidad">
                        @error('cantidad')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success d-block m-auto">Guardar</button>
        </form>
    </div>
</div>
@endsection