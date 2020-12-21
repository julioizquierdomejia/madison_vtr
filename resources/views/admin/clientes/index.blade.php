@extends('admin.layouts.app', ['title' => 'Home'])
@section('content')
@php
  $role = \Auth::user()->roles->first()->name;
  if($role == 'admin') {
    $title = 'Usuario';
  } else {
    $title = 'Cliente';
  }
@endphp
<h1>{{$title}}s</h1>


<div class="row">
  <div class="col">
    <a class="btn btn-success" href="{{ route('clientes.create') }}" title="Create a project">
      <i class="fas fa-plus-circle mr-2"></i>
      Crear Nuevo {{$title}}
    </a>    
  </div>
</div>


<div class="row row-cols-1 row-cols-md-4 mt-4">
  @foreach($clientes as $cliente)
  @if ($cliente->id == 1)
    @continue
  @endif
    <div class="col mb-4">
      <div class="card">
        <div class="card-image text-center bg-light card-img-top">
          @if ($cliente->info->photo)
          <div class="embed-responsive embed-responsive-16by9 card-img-top" style="background-image: url('/uploads/photos/{{$cliente->id.'/'.$cliente->info->photo}}');background-size: cover;background-repeat: no-repeat;background-position: center;">
          </div>
          @else
          <div class="embed-responsive embed-responsive-16by9 card-img-top">
            <div class="embed-responsive-item d-flex align-items-center"><i class="far fa-user fa-3x w-100"></i></div>
          </div>
          @endif
        </div>
        <div class="card-body">
          <h4 class="card-title">{{$cliente->info->empresa}}</h4>
          <h5 class="card-title">{{$cliente->name}}</h5>
          <p class="card-text">{{$cliente->email}}</p>
          <p class="card-text">
          @if ($cliente->roles->count())
            @if ($cliente->roles->first()->id == 2)
              <span class="badge badge-primary px-3 py-1">{{$cliente->roles->first()->name}}</span>
            @else
              <span class="badge badge-success px-3 py-1">{{$cliente->roles->first()->name}}</span>
            @endif
          @endif
          </p>
        </div>
      </div>
    </div>
  @endforeach
</div>

@endsection