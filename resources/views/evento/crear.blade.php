@extends('layouts.app')

@section('content')

<div class="card bg-light">
    <div class="card-header">
        <strong>Crear evento</strong>
    </div>
    <div class="card-body">

        <form action="/evento/guardar" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row d-flex justify-content-center">
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre">
                        @error('nombre')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Descripción</label>
                        <textarea class="form-control @error('descripcion') is-invalid @enderror" name="descripcion"></textarea>
                        @error('descripcion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Valor decoración</label>
                        <input type="number" class="form-control @error('valor_decoracion') is-invalid @enderror" name="valor_decoracion">
                        @error('valor_decoracion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Valor entrada</label>
                        <input type="number" class="form-control @error('valor_entrada') is-invalid @enderror" name="valor_entrada">
                        @error('valor_entrada')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Inicio del evento</label>
                        <input type="date" class="form-control @error('inicio') is-invalid @enderror" name="inicio">
                        @error('inicio')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Fin del evento</label>
                        <input type="date" class="form-control @error('fin') is-invalid @enderror" name="fin">
                        @error('fin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Adjuntar imagen de evento</label>
                        <input type="file" class="@error('imagen') is-invalid @enderror" name="imagen">
                        @error('imagen')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
    </div>
    <button type="submit" class="btn btn-success d-block m-auto mb-1">Guardar</button>
    </form>
</div>
@endsection