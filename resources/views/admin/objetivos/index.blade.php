@extends('admin.layouts.app', ['title' => 'Home'])
@section('content')


@php
  $title = 'Objetivos';
@endphp

<h1>{{$title}}</h1>


<div class="row">
  <div class="col">
    <a class="btn btn-success" href="/objetivos/create" title="Create a project">
      <i class="fas fa-plus-circle mr-2"></i>
      Crear Nuevo {{$title}}
    </a>    
  </div>
</div>


<div class="row row-cols-1 row-cols-md-4 mt-4">
  @foreach($objetivos as $objetivo)
    <div class="col mb-4" style="@if($objetivo->enabled == 1) opacity: 1" @else opa>
      <div class="card">
        <div class="card-image text-center bg-light card-img-top d-table w-100">
        </div>
        <div class="card-body">
          <h5 class="card-title">{{$objetivo->name}}</h5>
          <p class="card-text">{{$objetivo->description}}</p>
          

          	@if($objetivo->enabled == 1)
          		<p class="card-text"><span class="badge badge-primary p-1 px-3">Activo</span></p>
      		@else
      			<p class="card-text"><span class="badge badge-danger p-1 px-3">Inactivo</span></p>
      		@endif
          	
          	<a href="/objetivos/{{$objetivo->id}}/edit" class="btn btn-warning"><i class="far fa-edit"></i> Editar</a>

          	<!--a href="" class="btn btn-danger"><i class="far fa-trash-alt"></i></a-->
          
        </div>
      </div>
    </div>
  @endforeach
</div>

@endsection