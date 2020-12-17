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
        <div class="card-image text-center bg-light card-img-top d-table w-100">
          <div class="d-table-cell align-middle" style="height: 150px">
          @if ($cliente->photo)
          <img src="{{$cliente->photo}}" class="card-img-top" alt="{{$cliente->name}}">
          @else
          <i class="far fa-user fa-3x py-3"></i>
          @endif
          </div>
        </div>
        <div class="card-body">
          <h5 class="card-title">{{$cliente->name}}</h5>
          <p class="card-text">{{$cliente->email}}</p>
          <p class="card-text"><span class="badge badge-primary">{{$cliente->plans->count() ? $cliente->roles->first()->name : ''}}</span></p>
        </div>
      </div>
    </div>
  @endforeach
</div>

@endsection