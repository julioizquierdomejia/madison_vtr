@extends('admin.layouts.app', ['title' => 'Perfil'])
@php
    $plan_id = $user->plans->first()->id;
@endphp
@section('content')
<link rel="stylesheet" href="{{ asset('online/dropzone/dropzone.min.css') }}" />
<div class="row">
	<div class="col-12 col-md-5 col-xl-4">
        <form class="card shadow mb-4 h-100" id="frmPerfil" action="{{route('perfil.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold"><span>Perfil</span></h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuPerfil"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuPerfil">
                        <div class="dropdown-header">Información:</div>
                        <a class="dropdown-item" href="#">Action</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p><strong>Utiliza el correo del trabajo</strong></p>
                <div class="form-group">
                	<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="Nombre Administrador de la cuenta" value="{{$user->name}}">
                </div>
                <div class="form-group">
                	<input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Correo electrónico registrado" value="{{$user->email}}">
                </div>
                <div class="form-group">
                	<input class="form-control @error('cargo') is-invalid @enderror" type="text" name="cargo" placeholder="Cargo de la compañia" value="{{$user->info ? $user->info->cargo : ''}}">
                </div>
                <div class="form-group">
                	<input class="form-control @error('empresa') is-invalid @enderror" type="text" name="empresa" placeholder="Empresa" value="{{$user->info ? $user->info->empresa : ''}}">
                </div>
                <div class="form-group">
                    <div id="dzPhoto" class="dropzone">
                        <div class="dz-default dz-message">Sube aquí tus imágenes</div>
                    </div>
                </div>
                <div class="form-group">
                	<label>
                		delegar rol de aministrador
                		<input type="checkbox" name="rol" value="1">
                	</label>
                </div>

                <div class="form-group">
                	<input class="form-control" type="text" name="name_delegado" placeholder="Nombre del delegado">
                </div>
                <div class="form-group">
                	<input class="form-control" type="email" name="email_delegado" placeholder="Correo del delegado">
                </div>
                <div class="row">
                	<div class="col-12 col-md-6 form-group">
                		<label for="date_from">Desde</label>
                		<input class="form-control" id="date_from" type="date" name="date_from" placeholder="DD/MM/AA">
                	</div>
                	<div class="col-12 col-md-6 form-group">
                		<label for="date_from">Hasta</label>
                		<input class="form-control" id="date_to" type="date" name="date_from" placeholder="DD/MM/AA">
                	</div>
                </div>
                <div class="form-group row text-right">
                	<div class="col-12 col-md-6 ml-md-auto">
                		<button class="btn btn-primary btn-block" id="btnPerfil" type="submit">Guardar</button>
                	</div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-12 col-md-7 col-xl-8">
    	<form class="card shadow mb-4" id="perfil_password" action="{{route('perfil.segurity')}}" enctype="multipart/form-data" method="POST">
            @csrf
    		<div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold"><span>Seguridad</span></h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuSeguridad"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuSeguridad">
                        <div class="dropdown-header">Información:</div>
                        <a class="dropdown-item" href="#">Action</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p><strong>Actualiza o cambia los datos de tu acceso.</strong></p>
                <div class="row mb-2 align-items-center">
                	<label class="col-12 col-md-6 mb-md-0" for="change_email">Cambiar correo registrado</label>
                	<div class="col-12 col-md-6 form-group">
                		<input class="form-control" id="change_email" type="email" name="change_email" placeholder="Ingrese el nuevo correo">
                	</div>
                </div>
                <div class="row mb-2 align-items-center">
                	<label class="col-12 col-md-6 mb-md-0" for="actual_pass">Contraseña actual</label>
                	<div class="col-12 col-md-6 form-group">
                		<span>*********</span>
                	</div>
                </div>
                <div class="row mb-2 align-items-center">
                	<label class="col-12 col-md-6 mb-md-0" for="new_password">Cambiar o actualizar contraseña</label>
                	<div class="col-12 col-md-6 form-group">
                		<input class="form-control" id="new_password" type="password" name="new_password" placeholder="Nueva contraseña" value="123456">
                	</div>
                </div>
                <div class="form-group row text-right">
                	<div class="col-12 col-md-4 ml-md-auto">
                		<button class="btn btn-dark btn-block" type="submit">Guardar</button>
                	</div>
                </div>
            </div>
    	</form>
    	<div class="card shadow">
    		<div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold"><span>Plan MVR.</span></h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuPlan"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuPlan">
                        <div class="dropdown-header">Información:</div>
                        <a class="dropdown-item" href="#">Action</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p><strong>Cambia de plan según tus necesidades. ¿Preguntas? <a class="btn-link" href="/soporte">¿Contáctanos?</a></strong></p>
                <div class="row justify-content-center">
                    @foreach ($planes as $plan)
                	<div class="col-12 col-lg-6 col-xl-4 my-2">
                		<div class="card @if ($plan_id == $plan->id) border-left-success @endif">
                			<div class="card-body">
                				<h6 class="text-center {{$plan_id == $plan->id ? 'text-success' : 'text-dark'}} mb-4"><strong>{{$plan->name}}</strong></h6>
								{!! $plan->description !!}
                			</div>
                		</div>
                        @if ($plan_id == $plan->id)
                        <div class="text-center mt-2 text-success">
                            <span class="align-middle pr-2">Plan actual </span><i class="fas fa-ws fa-check-circle fa-2x align-middle"></i>
                        </div>
                        @endif
                	</div>
                    @endforeach
                </div>
            </div>
    	</div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('online/dropzone/dropzone.min.js') }}"></script>
<script>
Dropzone.autoDiscover = false;
$(document).ready(function () {
    var userid;
    var myDropzone = new Dropzone("#dzPhoto", { 
    paramName: "file",
    url: "{{ route('perfil.photo') }}",
    addRemoveLinks: true,
    autoProcessQueue: false,
    uploadMultiple: false,
    parallelUploads: 1,
    maxFiles: 1,
    params: {
        _token: '{{csrf_token()}}'
    },
     // The setting up of the dropzone
    init: function() {
        var myDropzone = this;
        //form submission code goes here
        $("#frmPerfil").submit(function(event) {
            //Make sure that the form isn't actully being sent.
            event.preventDefault();
            URL = $("#frmPerfil").attr('action');
            formData = $('#frmPerfil').serialize();
            $.ajax({
                type: 'POST',
                url: URL,
                data: formData,
                success: function(result) {
                    if(result.status == "success"){
                        // fetch the useid 
                        userid = result.user_id;
                        //process the queue
                        myDropzone.processQueue();
                            //location.reload();
                            Swal.fire(
                              'Mi Perfil',
                              'Se actualizó el perfil',
                              'success'
                            )
                    } else {
                        console.log("error");
                    }
                },
                error: function (data) {
                    var errors = data.responseJSON;
                    errorsHtml = '<div class="alert alert-danger mb-0"><ul>';

                    $.each( errors.errors, function( key, value ) {
                        errorsHtml += '<li>'+ value + '</li>'; //showing only the first error.
                    });
                    errorsHtml += '</ul></div>';
                    Swal.fire(
                      'Mi Perfil',
                      errorsHtml,
                      'error'
                    )
                }
            });
        });
        //Gets triggered when we submit the image.
        this.on('sending', function(file, xhr, formData){
        //fetch the user id from hidden input field and send that userid with our image
           formData.append('userid', userid);
        });
        
        this.on("success", function (file, response) {
            //reset the form
            $('.img-profile').attr('src', response.photo);
            $('#frmPerfil')[0].reset();
        });
        this.on("queuecomplete", function () {
        
        });

        this.on("complete", function(file) {
            myDropzone.removeFile(file);
        });
        
        // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
        // of the sending event because uploadMultiple is set to true.
        this.on("sendingmultiple", function() {
          // Gets triggered when the form is actually being sent.
          // Hide the success button or the complete form.
        });
        
        this.on("successmultiple", function(files, response) {
          // Gets triggered when the files have successfully been sent.
          // Redirect user or notify of success.
        });
        
        this.on("errormultiple", function(files, response) {
          // Gets triggered when there was an error sending the files.
          // Maybe show form again, and notify user of error
        });
    }
    });
});
</script>
@endsection