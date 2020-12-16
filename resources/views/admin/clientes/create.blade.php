@extends('admin.layouts.app', ['title' => 'Home'])
@section('content')
@php
  $role = \Auth::user()->roles->first()->name;
  if($role == 'admin') {
    $class = 'd-none';
    $title = 'Usuarios';
    $empresa = \Auth::user()->info->empresa;
    $plan_id = \Auth::user()->plans->first()->id;
  } else {
    $class = '';
    $title = 'Clientes';
    $empresa = '';
    $plan_id = '';
  }
@endphp

<h1>{{$title}}</h1>

<div class="row">
  <div class="col">
    <a class="btn btn-success" href="{{ route('clientes.index') }}" title="Create a project">
      <i class="far fa-address-card mr-2"></i>
      Ver lista de {{$title}}
    </a>    
  </div>
</div>

<div class="row mt-4">
  <div class="col">
      
      <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <div class="form-row">
          <div class="form-group col-md-6 @if ($role == 'admin') d-none @endif">
            <label for="empresa">Razon Social</label>
            <input type="text" class="form-control" id="empresa" name='empresa' placeholder="Nombre de la empresa" value="{{old('empresa', $empresa)}}" 
            @error('empresa') style="border:1px solid red"@enderror>
            @error('empresa')
              <span class="text-danger"><i class="fas fa-exclamation-circle mr-1 mt-2"></i>{{$message}}</span>
            @enderror
          </div>
          
          <div class="form-group col-md-6">
            <label for="cargo">Cargo</label>
            <input type="text" class="form-control" id="cargo" name='cargo' placeholder="Cargo" value="{{old('cargo')}}"
            @error('cargo') style="border:1px solid red"@enderror>
            @error('cargo')
              <span class="text-danger"><i class="fas fa-exclamation-circle mr-1 mt-2"></i>{{$message}}</span>
            @enderror
          </div>

        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="name">Nombre Completo</label>
            <input type="text" class="form-control" id="name" name='name' placeholder="Nombre de usuario" value="{{old('name')}}"
            @error('name') style="border:1px solid red"@enderror>
            @error('name')
              <span class="text-danger"><i class="fas fa-exclamation-circle mr-1 mt-2"></i>{{$message}}</span>
            @enderror
          </div>
          
          <div class="form-group col-md-6">
            <label for="email">Nombre de usuario <span class="text-info"> | Correo electrónico</span></label>
            <input type="text" class="form-control" id="email" name='email' placeholder="Email" value="{{old('email')}}"
            @error('email') style="border:1px solid red"@enderror>
            @error('email')
              <span class="text-danger"><i class="fas fa-exclamation-circle mr-1 mt-2"></i>{{$message}}</span>
            @enderror
          </div>
        </div>
        @if (Auth::user()->roles->first()->name != 'superadmin')
        <div class="f-c-list form-group" @error('roles') style="border:1px solid red;padding: 0 10px"@enderror>
        <h4 class="h6">Roles</h4>
        @foreach($roles as $key => $role)
        <div class="form-check form-check-inline mt-2 mb-4">
          <input class="form-check-input" type="radio" name="roles" id="role{{$role->id}}" value="{{$role->id}}" {{ old('roles.'.$key) == $role->id ? 'checked' : ''}}>
          <label class="form-check-label" for="role{{$role->id}}">
            {{$role->description}}
          </label>
        </div>
        @endforeach
        </div>
        @endif
        
        <div class="f-c-list form-group {{$class}}" @error('plan_id') style="border:1px solid red;padding: 0 10px"@enderror>
        <h4 class="h6">Plan</h4>
        @foreach($planes as $key => $plan)
        <div class="form-check form-check-inline mt-2 mb-4">
          <input class="form-check-input" type="radio" name="plan_id" id="plan{{$plan->id}}" value="{{$plan->id}}" {{old('plan_id', $plan_id) == $plan->id ? 'checked' : ''}}>
          <label class="form-check-label" for="plan{{$plan->id}}">
            {{$plan->name}}
          </label>
        </div>
        @endforeach
      </div>

        <button type="submit" class="btn btn-primary">Registrar</button>
      </form>

  </div>
</div>

@endsection