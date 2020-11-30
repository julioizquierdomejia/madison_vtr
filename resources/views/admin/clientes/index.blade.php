@extends('admin.layouts.app', ['title' => 'Home'])
@section('content')

<h1>Clientes</h1>


<div class="row">
  <div class="col">
    <a class="btn btn-success" href="{{ route('clientes.create') }}" title="Create a project">
      <i class="fas fa-plus-circle mr-2"></i>
      Crear Nuevo Cliente
    </a>    
  </div>
</div>


<div class="row row-cols-1 row-cols-md-4 mt-4">
  @foreach($clientes as $cliente)
    <div class="col mb-4">
      <div class="card">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{$cliente->name}}</h5>
          <p class="card-text">{{$cliente->email}}</p>
        </div>
      </div>
    </div>
  @endforeach
</div>

@endsection