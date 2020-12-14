@extends('admin.layouts.app', ['title' => 'Vídeos'])
@section('content')
<div class="row">
    <div class="col-12 col-md-6">
        <form class="card shadow form-uploadvideo mb-4" action="{{route('videos.upload')}}" method="POST" enctype="multipart/form-data">
            <nav class="card-header py-3 row mx-0 align-items-center" style="background-color: #E72F77;">
                <h6 class="m-0 font-weight-bold"><span>Subir un vídeo</span></h6>
                <div class="input-group ml-auto col-6 col-md-7">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-upload"></i></span>
                    </div>
                    @csrf
                    <div class="custom-file">
                        <input type="file" accept="video/mp4,video/x-m4v,video/*" class="custom-file-input" id="videoUpload"
                        aria-describedby="videoUpload" name="video">
                        <label class="custom-file-label text-nowrap" for="videoUpload" style="overflow: hidden;">Seleccionar el vídeo</label>
                    </div>
                </div>
                <div class="dropdown no-arrow ml-2" style="z-index: 2">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuSbVideo"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuSbVideo">
                        <div class="dropdown-header">Información:</div>
                        <a class="dropdown-item" href="#">Action</a>
                    </div>
                </div>
                <div class="col-12 text-right">
                    <p class="video-error pr-4 text-white mb-0 pt-2" style="display: none;">Mostrar vídeo</p>
                </div>
            </nav>
            <div class="card-body">
                {{-- <div class="form-group">
                    <label class="mb-4" for="objetivo">Empieza escogiendo un objetivo</label>
                    <select class="form-control" name="objetivo" id="objetivo">
                        @foreach($objectives as $objective)
                        <option value="{{$objective->id}}">{{$objective->name}}</option>
                        @endforeach
                    </select>
                    <p class="error object-error" style="display: none;">Escoge un objetivo</p>
                </div> --}}
                <p><strong>Revisa las especificaciones</strong></p>
                <ul class="list list-unstyled">
                    <li class="item my-3 d-flex justify-content-between">
                        <span>Formato .AVI o MP4</span>
                        <input type="checkbox" name="fomato" disabled="">
                    </li>
                    <li class="item my-3 d-flex justify-content-between">
                        <span>Calidad HD 1280 x 720 Píxeles</span>
                        <input type="checkbox" name="calidad" disabled="">
                    </li>
                    <li class="item my-3 d-flex justify-content-between">
                        <span>Buena calidad de audio</span>
                        <input type="checkbox" name="audio" disabled="">
                    </li>
                </ul>
                <div class="buttons text-right">
                    <button class="btn btn-dark btn-sm px-5 btn-upload"><span class="px-md-4">Subir</span></button>
                </div>
            </div>
        </form>
        <div class="card shadow card-steps mb-4">
            <div class="card-header py-3 d-flex align-items-center justify-content-between" style="background-color: #E72F77;">
                <h6 class="m-0 font-weight-bold"><span>Solicitar un vídeo</span></h6>
                <div class="dropdown no-arrow ml-2">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuSVideo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuSVideo">
                        <div class="dropdown-header">Información:</div>
                        <a class="dropdown-item" href="#">Action</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p><strong>Llena el formulario</strong></p>
                <ul class="list-inline row">
                    <li class="d-inline-block col-auto"><label><span class="align-middle">Activar servicio express </span><input class="align-middle" type="checkbox" name="express"></label></li>
                    <li class="d-inline-block col-auto"><label><span class="align-middle">Animación </span><input class="align-middle" type="checkbox" name="animation"></label></li>
                    <li class="d-inline-block col-auto"><label><span class="align-middle">Grabación </span><input class="align-middle" type="checkbox" name="recording"></label></li>
                </ul>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <input class="form-control" placeholder="Tema principal" type="text" name="tema">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Tipo de presentación" type="text" name="tipo">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Avatar" type="text" name="avatar">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Comentarios" rows="3" name="comentarios"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-upload"></i></span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" accept="application/pdf" class="custom-file-input" id="documentUpload"
                                    aria-describedby="documentUpload" name="upload_file">
                                    <label class="custom-file-label" for="documentUpload">subir speech</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-right">
                    <div class="col-12 col-md-6">
                        <label for="terminos"><input type="checkbox" id="terminos" name="terminos">Acepto los términos y condiciones de Madison por mi solicitud.Cualquier modificación durante el proceso tendrá un costo adicional.</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <button class="btn btn-dark btn-block btn-sm px-5 btn-upload"><span class="px-md-4">Solicitar</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3 d-flex align-items-center" style="background-color: #E72F77;">
                <h6 class="m-0 font-weight-bold">Estado de Vídeos</h6>
                <div class="text-right ml-auto">
                    <select class="form-control" name="filter">
                        <option value="">Ver todos</option>
                        @foreach($status as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="dropdown no-arrow ml-2">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuSVideo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuSVideo">
                        <div class="dropdown-header">Información:</div>
                        <a class="dropdown-item" href="#">Action</a>
                    </div>
                </div>
            </div>
            <div class="card-body" style="max-height: 600px;overflow-y: auto;">
                <ul class="list videos-list list-unstyled mb-0">
                    @if($videos->count())
                    @foreach($videos as $video)
                    <li class="item my-1" id="video-{{$video->id}}">
                        <div class="row py-2 bg-light">
                            <div class="col-2 text-center">
                                <div class="video h-100 w-100 bg-dark">
                                    <div class="embed-responsive embed-responsive-16by9 h-100">
                                        <video class="embed-responsive-item item-video">
                                            <source src="{{ asset('uploads/videos/'.$video->file) }}">
                                        </video>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 my-auto">
                                <h6 class="mb-1">{{date('d-m-Y', strtotime($video->created_at))}} 
                                    <span class="badge badge-dark">{{$video->video_type}}</span>
                                </h6>
                                <p class="mb-0">{{$video->name}}</p>
                            </div>
                            <div class="col-4 btn-group">
                                @if($video->video_status_id == 1)
                                <button class="btn btn-sm btn-success shadow-sm h-100"><i class="fas fa-check d-block"></i> aprobar</button>
                                <button class="btn btn-sm btn-danger shadow-sm h-100">hacer <br>cambios</button>
                                @elseif($video->video_status_id == 2)
                                <button class="btn bg-white col btn-block shadow-sm h-100"><i class="fas fa-eye fa-2x text-danger d-block"></i> En revisión</button>
                                @elseif($video->video_status_id == 3)
                                <button class="btn bg-white col btn-block shadow-sm h-100"><i class="fas fa-check fa-2x text-success d-block"></i> Aprobado</button>
                                @elseif($video->video_status_id == 4)
                                <button class="btn bg-white col btn-block shadow-sm h-100"><i class="fas fa-eye fa-2x text-danger d-block"></i> En revisión</button>
                                @elseif($video->video_status_id == 5)
                                <button class="btn bg-white col btn-block shadow-sm h-100"><i class="fas fa-play fa-2x text-warning d-block"></i> En producción</button>
                                @endif
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @else
                    <li class="item my-1 text-center py-3">
                        <i class="fa fa-play text-dark fa-2x mb-4"></i>
                        <p>No existen vídeos por el momento.</p>
                        <p>Sube o solicita un vídeo para empezar.</p>
                    </li>
                    @endif
                    {{-- <li class="item my-1">
                        <div class="row py-2 bg-light">
                            <div class="col-2 text-center">
                                <div class="video h-100 p-2 d-table w-100 bg-dark">
                                    <span class="d-table-cell align-middle"><i class="fa fa-play text-white-50"></i></span>
                                </div>
                            </div>
                            <div class="col-6 my-auto">
                                <h6 class="mb-1">{{date('d-m-Y')}} <span class="badge badge-dark">Armado</span></h6>
                                <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus.</p>
                            </div>
                            <div class="col-4 btn-group">
                                <button class="btn btn-sm btn-success shadow-sm h-100"><i class="fas fa-check d-block"></i> aprobar</button>
                                <button class="btn btn-sm btn-danger shadow-sm h-100">hacer <br>cambios</button>
                            </div>
                        </div>
                    </li>
                    <li class="item my-1">
                        <div class="row py-2 bg-light">
                            <div class="col-2 text-center">
                                <div class="video h-100 p-2 d-table w-100 bg-dark">
                                    <span class="d-table-cell align-middle"><i class="fa fa-play text-white-50"></i></span>
                                </div>
                            </div>
                            <div class="col-6 my-auto">
                                <h6 class="mb-1">{{date('d-m-Y')}} <span class="badge badge-danger">Armado</span></h6>
                                <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus.</p>
                            </div>
                            <div class="col-4 btn-group">
                                <button class="btn bg-white col btn-block shadow-sm h-100"><i class="fas fa-eye fa-2x text-danger d-block"></i> En revisión</button>
                            </div>
                        </div>
                    </li>
                    <li class="item my-1">
                        <div class="row py-2 bg-light">
                            <div class="col-2 text-center">
                                <div class="video h-100 p-2 d-table w-100 bg-dark">
                                    <span class="d-table-cell align-middle"><i class="fa fa-play text-white-50"></i></span>
                                </div>
                            </div>
                            <div class="col-6 my-auto">
                                <h6 class="mb-1">{{date('d-m-Y')}} <span class="badge badge-warning">Armado</span></h6>
                                <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus.</p>
                            </div>
                            <div class="col-4 btn-group">
                                <button class="btn bg-white col btn-block shadow-sm h-100"><i class="fas fa-play fa-2x text-warning d-block"></i> En producción</button>
                            </div>
                        </div>
                    </li>
                    <li class="item my-1">
                        <div class="row py-2 bg-light">
                            <div class="col-2 text-center">
                                <div class="video h-100 p-2 d-table w-100 bg-dark">
                                    <span class="d-table-cell align-middle"><i class="fa fa-play text-white-50"></i></span>
                                </div>
                            </div>
                            <div class="col-6 my-auto">
                                <h6 class="mb-1">{{date('d-m-Y')}} <span class="badge badge-success">Armado</span></h6>
                                <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus.</p>
                            </div>
                            <div class="col-4 btn-group">
                                <button class="btn bg-white col btn-block shadow-sm h-100"><i class="fas fa-check fa-2x text-success d-block"></i> Aprobado</button>
                            </div>
                        </div>
                    </li>
                    <li class="item my-1">
                        <div class="row py-2 bg-light">
                            <div class="col-2 text-center">
                                <div class="video h-100 p-2 d-table w-100 bg-dark">
                                    <span class="d-table-cell align-middle"><i class="fa fa-play text-white-50"></i></span>
                                </div>
                            </div>
                            <div class="col-6 my-auto">
                                <h6 class="mb-1">{{date('d-m-Y')}} <span class="badge badge-primary">Sugerido</span></h6>
                                <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus.</p>
                            </div>
                            <div class="col-4 btn-group">
                                <button class="btn btn-sm btn-primary shadow-sm h-100"><i class="fas fa-check d-block"></i> publicar</button>
                                <button class="btn btn-sm btn-danger shadow-sm h-100"><i class="fas fa-trash d-block"></i> borrar</button>
                            </div>
                        </div>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $('#nav-tab').on('show.bs.tab', function (event) {
        var element = $(event.target);
        $('.card-steps .card-header h6 span').text(element.data('text'));
    })
    $('#videoUpload').on('change', function (event) {
        var filename = $(this).val().split('\\').pop();
        if(filename) {
            $(this).parent().find('.custom-file-label').text(filename);
        } else {
            $(this).parent().find('.custom-file-label').text('Seleccionar el vídeo');
        }
    })

    $('.form-uploadvideo').submit(function (event) {
        event.preventDefault();
        if($('#videoUpload').val().length == 0) {
            $('.video-error').show();
            return;
        } else {
            $('.video-error').hide();
        }
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            type: "post",
            url: url,
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function (data) {
                
            },
            success: function (response) {
                if(response.success) {
                    $('.videos-list').empty();
                    var videos = $.parseJSON(response.data);
                    $.each(videos, function (id, item) {
                        $('.videos-list').append(getList(item));
                    })
                }
            },
            error: function (request, status, error) {
              var data = jQuery.parseJSON(request.responseText);
              console.log(data);
            }
        });
    })

    function getList(video) {
        var html = `<li class="item my-1" id="video-`+video.id+`">
                        <div class="row py-2 bg-light">
                            <div class="col-2 text-center">
                                <div class="video h-100 w-100 bg-dark">
                                    <div class="embed-responsive embed-responsive-16by9 h-100">
                                        <video class="embed-responsive-item item-video">
                                            <source src="uploads/videos/`+video.file+`">
                                        </video>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 my-auto">
                                <h6 class="mb-1">`+dateFormatter(video.created_at)+` 
                                    <span class="badge badge-dark">`+video.video_type+`</span>
                                </h6>
                                <p class="mb-0">`+video.name+`</p>
                            </div>
                            <div class="col-4 btn-group">`;
                            if(video.video_status_id == 1) {
                                html += `<button class="btn btn-sm btn-success shadow-sm h-100"><i class="fas fa-check d-block"></i> aprobar</button>
                                <button class="btn btn-sm btn-danger shadow-sm h-100">hacer <br>cambios</button>`;
                            } else if (video.video_status_id == 2) {
                                html += `<button class="btn bg-white col btn-block shadow-sm h-100"><i class="fas fa-eye fa-2x text-danger d-block"></i> En revisión</button>`;
                            } else if (video.video_status_id == 3) {
                                html += `<button class="btn bg-white col btn-block shadow-sm h-100"><i class="fas fa-check fa-2x text-success d-block"></i> Aprobado</button>`;
                            } else if(video.video_status_id == 4) {
                                html += `<button class="btn bg-white col btn-block shadow-sm h-100"><i class="fas fa-eye fa-2x text-danger d-block"></i> En revisión</button>`;
                            } else if(video.video_status_id == 5) {
                                html += `<button class="btn bg-white col btn-block shadow-sm h-100"><i class="fas fa-play fa-2x text-warning d-block"></i> En producción</button>`;
                            }
                            html += `</div>
                        </div>
                    </li>`;
        return html;
    }
    function dateFormatter(date) {
      var formattedDate = new Date(date);

      var d = formattedDate.getDate();
      var m =  formattedDate.getMonth();
      m += 1;  // JavaScript months are 0-11
      var y = formattedDate.getFullYear();
      /*var hours = formattedDate.getHours();
      var symbol = hours >= 12 ? 'pm' : 'am';
      hours = hours % 12;
      hours = hours ? hours : 12;
      var min = formattedDate.getMinutes();
      min = min < 10 ? '0'+min : min;*/

      return (d + "-" + m + "-" + y /*+ " " + hours + ":" + min + " "+ symbol*/);
    }
</script>
@endsection