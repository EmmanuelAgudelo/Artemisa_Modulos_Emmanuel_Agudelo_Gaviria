@extends('layouts.app')

@section('content')

<div class="card bg-light">
    <div class="card-header">
        <strong>Editar evento</strong>
    </div>
    <div class="card-body">

        <form action="/evento/modificar" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$evento->id}}">
            <div class="row d-flex justify-content-center">
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{$evento->nombre}}">
                        @error('nombre')
                        <span class=" invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Descripción</label>
                        <textarea class="form-control @error('descripcion') is-invalid @enderror" name="descripcion">{{$evento->descripcion}}</textarea>
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
                        <input type="number" class="form-control @error('valor_decoracion') is-invalid @enderror" name="valor_decoracion" value="{{$evento->valor_decoracion}}">
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
                        <input type="number" class="form-control @error('valor_entrada') is-invalid @enderror" name="valor_entrada" value="{{$evento->valor_entrada}}">
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
                        <input type="date" class="form-control @error('inicio') is-invalid @enderror" name="inicio" value="{{$evento->inicio}}">
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
                        <input type="date" class="form-control @error('fin') is-invalid @enderror" name="fin" value="{{$evento->fin}}">
                        @error('fin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">

                        @if ($evento->imagen == null)
                        <p class="text-dark text-center" style="margin: 5%">Sin imagen <i class="fas fa-image"></i></p>
                        @endif
                        @if ($evento->imagen !== null)
                        <img src="/uploads/{{$evento->imagen}}" style="width: 150px; margin: 5% auto" class="d-block" alt="">
                        @endif
                        <label for=" formFileDisabled" class="form-label">Adjuntar imagen de evento</label>
                        <input class="form-control @error('imagen') is-invalid @enderror" name="imagen" type="file" id="formFileDisabled" value="{{$evento->imagen}}">
                        @error('imagen')
                        <span class=" invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
    </div>
    <button type="submit" class="btn btn-warning d-block m-auto mb-1">Modificar</button>
    </form>
</div>
@endsection