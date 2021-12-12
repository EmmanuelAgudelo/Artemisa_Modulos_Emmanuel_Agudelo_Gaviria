@extends('layouts.app')

@section('content')

<div class="card bg-light">
    <div class="card-header">
        <strong>Editar cliente</strong>
    </div>
    <div class="card-body">

        <form action="/cliente/modificar" method="post">
            @csrf

            <input type="hidden" name="id" value="{{$cliente->id}}">
            <div class="row d-flex justify-content-center">
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{$cliente->nombre}}">
                        @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Apellidos</label>
                        <input type="text" class="form-control @error('apellidos') is-invalid @enderror" name="apellidos" value="{{$cliente->apellidos}}">
                        @error('apellidos')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Documento</label>
                        <input type="number" class="form-control @error('documento') is-invalid @enderror" name="documento" readonly value="{{$cliente->documento}}">
                        @error('documento')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Telefono</label>
                        <input type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{$cliente->telefono}}"> 
                        @error('telefono')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$cliente->email}}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success d-block m-auto">Modificar</button>
        </form>
    </div>
</div>
@endsection