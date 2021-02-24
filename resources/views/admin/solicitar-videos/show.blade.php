@extends('admin.layouts.app', ['title' => 'Ver solicitud de vídeo'])
@section('content')
<div class="card">
  <div class="card-header py-3 d-flex align-items-center">
      <h6 class="m-0 font-weight-bold text-white">Solicitud de Vídeo N°{{$video_request->id}}</h6>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-12 col-md-6">
        @if ($role == 'superadmin')
        <h3 class="h6 mt-3">Cliente:</h3>
        <p class="text-primary">{{$video_request->user->info->empresa}}</p>
        @endif
        <h3 class="card-title">{{$video_request->topic}}</h3>
        <h5 class="h6">Tipo:</h5>
        <p class="text-primary">{{$video_request->type}}</p>
        <h5 class="h6">Avatar:</h5>
        <p class="text-primary">{{$video_request->avatar}}</p>
        <h5 class="h6">Servicios:</h5>
        <ul class="list-inline">
        @foreach ($video_request->services as $service)
          <li class="mb-1 d-inline-block"><span class="badge badge-primary px-2" style="font-size: 13px"><i class="fa fa-check mr-2"></i>{{$service->name}}</span></li>
        @endforeach
        </ul>
        <h5 class="h6">Objetivo:</h5>
        <p class="text-primary">{{$video_request->objective->name}}</p>
        <h5 class="h6">Comentarios:</h5>
        <p class="text-dark p-3" style="background-color: #c3c3c3">{{$video_request->comments}}</p>
      </div>

      <div class="col-12 col-md-6">
        <h5 class="h6">Speech:</h5>
        <div class="embed-responsive embed-responsive-1by1 bg-dark">
              <iframe class="embed-responsive-item" src="{{ asset('uploads/requests/'.$video_request->id.'/'.$video_request->speech) }}" width="100%"></iframe>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


{{--  
@extends('admin.layouts.app', ['title' => 'Ver solicitud de vídeo'])
@section('content')
<div class="card">
  <div class="card-header py-3 d-flex align-items-center">
      <h6 class="m-0 font-weight-bold text-white">Solicitud de Vídeo N°{{$video_request->id}}</h6>
  </div>
  <div class="card-body">
    <h5 class="card-title">{{$video_request->topic}}</h5>
    <div class="row">
    	<div class="card-text col-12 col-md-6 mb-4">
	    	<h5 class="h6">Tipo:</h5>
	    	<p>{{$video_request->type}}</p>
	    </div>
	    <div class="card-text col-12 col-md-6 mb-4">
	    	<h5 class="h6">Avatar:</h5>
	    	{{$video_request->avatar}}
	    </div>
	    </div>
    <div class="card-text mb-4">
    	<h5 class="h6">Speech:</h5>
    	<div class="embed-responsive embed-responsive-16by9 h-100 bg-dark">
            <iframe class="embed-responsive-item" src="{{ asset('uploads/requests/'.$video_request->id.'/'.$video_request->speech) }}" width="100%"></iframe>
        </div>
    </div>
    <div class="card-text mb-4">
    	<h5 class="h6">Comentarios:</h5>
    	{{$video_request->comments}}
    </div>
  </div>
</div>
@endsection
--}}