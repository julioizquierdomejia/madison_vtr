@php
  $title = 'Objetivo';
@endphp
@extends('admin.layouts.app', ['title' => $title])
@section('content')

<h1>{{$title}}</h1>

<div class="row">
  <div class="col">
  	<a class="btn btn-secondary" href="/objetivos" title="Create a project">
      <i class="far fa-arrow-alt-circle-left"></i>
      Volver al Listado
    </a>    
    <a class="btn btn-success" href="{{ route('clientes.create') }}" title="Create a project">
      <i class="fas fa-plus-circle mr-2"></i>
      Crear Nuevo {{$title}}
    </a>    
  </div>
</div>


<div class="row mt-4">
	<div class="col">
		
		<form action="/objetivos/{{$objetivo->id}}" method="POST">
		  <div class="form-group">
		  	@csrf
        	@method('PUT')

		    <label for="empresa">Nombre del objetivo</label>
		    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $objetivo->name }}" name="name">
		    <small id="emailHelp" class="form-text text-muted">Colocar el nombre del Objetivo</small>
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Descripción</label>
		    <input type="text" class="form-control" id="exampleInputPassword1" value="{{ $objetivo->description }}" name="description">
		  </div>
		  <div class="form-group">
		  	<div class="custom-control custom-switch">
			  <input type="checkbox" class="custom-control-input" id="customSwitch1" name="enabled" @if($objetivo->enabled == 1) checked @endif>
			  <label class="custom-control-label" for="customSwitch1">Activo</label>
			</div>
		  </div>
		  
		  <button type="submit" class="btn btn-primary">Actualizar</button>
		</form>
	</div>
</div>


@endsection