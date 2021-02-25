@php
  if($role == 'admin') {
    $title = 'Usuario';
  } else {
    $title = 'Cliente';
  }
@endphp
@extends('admin.layouts.app', ['title' => $title])
@section('content')
<div class="clients-container">
  <h1>{{$title}}s</h1>
<div class="row">
  <div class="col">
    <a class="btn btn-success" href="{{ route('clientes.create') }}" title="Create a project">
      <i class="fas fa-plus-circle mr-2"></i>
      Crear Nuevo {{$title}}
    </a>    
  </div>
</div>
{{-- <div class="row row-cols-1 row-cols-md-4 mt-4">
  @foreach($clientes as $cliente)
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
</div> --}}
<div class="clients-section mt-4">
  <table class="table cards w-100" id="clientsTb">
  <thead class="d-none">
    <tr>
      <th>Foto</th>
      <th>Empresa</th>
      <th>Nombre</th>
      <th>Email</th>
      <th>Rol</th>
    </tr>
  </thead>
</table>
</div>
</div>
@endsection
@section('script')
<style type="text/css">
  .table,
  .table tbody,
  .table tbody tr,
  .table tbody td {
    display: block;
  }

    table.cards {
        background-color: transparent;
        border-bottom: 0 !important;
    }

    .cards tbody {
      display: flex;
      flex-wrap: wrap;
      margin: 0 -1%;
    }
    .cards tbody tr {
      width: 48%;
      margin: 10px 1%;
      border: 1px solid #e3e6f0;
      box-shadow: 3px 3px 6px rgba(0,0,0,0.2);
      background-color: white;
    }
    .cards tbody td {
      border: 0;
      display: block;
      width: 100%;
      overflow: hidden;
      text-align: left;
    }

    /*---[ The remaining is just more dressing to fit my preferances ]-----------------*/
    .table {
        background-color: #fff;
    }
    .table tbody label {
        display: none;
        margin-right: 5px;
        width: 50px;
    }   
    .table .glyphicon {
        font-size: 20px;
    }

    .cards .glyphicon {
        font-size: 75px;
    }

    .cards tbody label {
        display: inline;
        position: relative;
        font-size: 85%;
        font-weight: normal;
        top: -5px;
        left: -3px;
        float: left;
        color: #808080;
    }
    .cards tbody td:nth-child(1) {
        text-align: center;
    }
    @media (min-width: 768px) {
      .cards tbody tr {
        width: 31.333%;
      }
    }

    @media (min-width: 1200px) {
      .cards tbody tr {
        width: 23%;
      }
    }
    @media (max-width: 480px) {
      .cards .empresa {
        font-size: 15px;
      }
      .cards .name {
        font-size: 13px;
      }
    }

</style>
<script type="text/javascript">
  clientsTb = $('#clientsTb').DataTable({
     processing: true,
     serverSide: true,
     ajax: "{{route('clients.list')}}",
     pageLength: 5,
     lengthMenu: [ 5, 25, 50 ],
     columns: [
        { data: 'photo', class: 'photo text-center p-0' },
        { data: 'empresa', class: 'empresa text-left h4 mb-0' },
        { data: 'name', class: 'name h5 mb-0 py-0' },
        { data: 'email', class: 'email text-left' },
        { data: 'role', class: 'role text-left' },
    ],
    "createdRow": function( row, data, dataIndex){
      $(row).addClass('card');
    },
    order: [[ 0, "desc" ]],
    language: dLanguage
  });
</script>
@endsection