@extends('admin.layouts.app', ['title' => 'Home'])
@section('content')

<h1>Clientes</h1>

<div class="row">
  <div class="col">
    <a class="btn btn-success" href="{{ route('clientes.index') }}" title="Create a project">
      <i class="far fa-address-card mr-2"></i>
      Ver lista de Clientes
    </a>    
  </div>
</div>



<div class="row mt-4">
  <div class="col">
      
      <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="empresa">Razon Social</label>
            <input type="text" class="form-control" id="empresa" name='empresa' placeholder="Nombre de la empresa"
            @error('empresa') style="border:1px solid red"@enderror>
            @error('empresa')
              <span class="text-danger"><i class="fas fa-exclamation-circle mr-1 mt-2"></i>{{$message}}</span>
            @enderror
          </div>
          
          <div class="form-group col-md-6">
            <label for="name">Cargo</label>
            <input type="text" class="form-control" id="cargo" name='cargo' placeholder="Nombre de usuario"
            @error('cargo') style="border:1px solid red"@enderror>
            @error('cargo')
              <span class="text-danger"><i class="fas fa-exclamation-circle mr-1 mt-2"></i>{{$message}}</span>
            @enderror
          </div>

        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="name">Nombre Completo</label>
            <input type="text" class="form-control" id="name" name='name' placeholder="Nombre de usuario"
            @error('name') style="border:1px solid red"@enderror>
            @error('name')
              <span class="text-danger"><i class="fas fa-exclamation-circle mr-1 mt-2"></i>{{$message}}</span>
            @enderror
          </div>
          
          <div class="form-group col-md-6">
            <label for="name">Nombre de usuario <span class="text-info"> | Correl electrónico</span></label>
            <input type="text" class="form-control" id="email" name='email' placeholder="Nombre de usuario"
            @error('email') style="border:1px solid red"@enderror>
            @error('email')
              <span class="text-danger"><i class="fas fa-exclamation-circle mr-1 mt-2"></i>{{$message}}</span>
            @enderror
          </div>

        </div>

        @foreach($planes as $plan)
        <div class="form-check mt-2 mb-4">
          <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
          <label class="form-check-label" for="exampleRadios1">
            {{$plan->name}}
          </label>
        </div>
        @endforeach
        

        <button type="submit" class="btn btn-primary">Registrar</button>
      </form>

  </div>
</div>

@endsection