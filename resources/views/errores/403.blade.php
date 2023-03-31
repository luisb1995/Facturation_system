@extends('errors::illustrated-layout')

@section('code', '403')
@section('title', __('Acceso Denegado'))

@section('image')
<div style="background-image: url({{  asset("img/logogigante.png") }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
</div>
@endsection

@section('message', __('Ups, no tienes acceso a la dirección que intentas ingresar.'))