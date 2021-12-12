@extends('layouts.app')

@section('content')

<h1 class="d-flex justify-content-center" style="margin-top:30vh">Bienvenido, {{ Auth::user()->name }}.</h4>
    @endsection