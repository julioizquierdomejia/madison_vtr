@extends('admin.layouts.app', ['title' => 'Rituales'])
@section('content')
<div class="row">
    <div class="col-12 col-md-6 mb-4">
        <form class="card shadow form-Steps h-100" action="/rituales" method="POST">
            @csrf
            <nav class="card-header py-3 d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-white"><span>Crea un ritual</span></h6>
                <div class="nav nav-tabs ml-auto user-no-select" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-text="Crea un ritual" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fas fa-dot-circle"></i></a>
                    <a class="nav-item nav-link" id="nav-armando1-tab" data-text="Armando ritual" data-toggle="tab" href="#nav-armando1" role="tab" aria-controls="nav-armando1" aria-selected="false"><i class="fas fa-dot-circle"></i></a>
                    <a class="nav-item nav-link" id="nav-armando2-tab" data-text="Armando ritual" data-toggle="tab" href="#nav-armando2" role="tab" aria-controls="nav-armando2" aria-selected="false"><i class="fas fa-dot-circle"></i></a>
                    <a class="nav-item nav-link" id="nav-configuracion-tab" data-text="Configuración final" data-toggle="tab" href="#nav-configuracion" role="tab" aria-controls="nav-configuracion" aria-selected="false"><i class="fas fa-dot-circle"></i></a>
                </div>
                <div class="dropdown no-arrow ml-2">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuSVideo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuSVideo">
                        <a class="dropdown-item" href="#">Action</a>
                    </div>
                </div>
            </nav>
            <div class="tab-content card-body" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <p>Es un gusto acompañarte en alcanzar tus  metas, recuerda es mmuy importante que .... Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at porttitor sem.  Aliquam erat volutpat. Donec placerat nisl magna, et faucibus arcu condimentum sed.</p>
                    <div class="form-group">
                        <label class="mb-1" for="rname">Nombre del ritual</label>
                        <input class="form-control" type="text" name="name" id="rname">
                        <p class="error rname-error" style="display: none;">Escriba un nombre</p>
                    </div>
                    <div class="form-group">
                        <label class="mb-2" for="objetivo">Escoge un objetivo</label>
                        <select class="form-control" name="objetivo" id="objetivo">
                            @foreach($objectives as $objective)
                            <option value="{{$objective->id}}">{{$objective->name}}</option>
                            @endforeach
                        </select>
                        <p class="error object-error" style="display: none;">Escoge un objetivo</p>
                    </div>
                    <div class="form-group d-none">
                        <label class="mb-2" for="modo">¿Cómo Quieres armar el ritual?</label>
                        <br>
                        @foreach($ritual_types as $key => $type)
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" id="ritual_type_id{{$key}}" value="{{$type->id}}" @if ($type->id == 2) checked @endif name="ritual_type_id">
                            <label class="form-check-label" for="ritual_type_id{{$key}}"><span class="align-middle">{{$type->name}}</span></label>
                        </div>
                        @endforeach
                        <p class="error ritual_types-error" style="display: none;">Escoge una opción</p>
                    </div>
                    <div class="form-group">
                        <div class="f-g">
                            <label class="mb-2" for="modo">Tercera parte</label>
                            <input class="form-control" type="date" name="published_at" min="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}">
                        </div>
                        <p class="error date-error" style="display: none;">Escoge una fecha</p>
                    </div>
                    <div class="buttons text-center" role="tablist">
                        <button class="btn btn-primary btn-step" type="button" data-step="1">Siguiente <i class="fas fa-angle-right fa-sm"></i></button>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-armando1" role="tabpanel" aria-labelledby="nav-armando1-tab">
                    <h4 class="title"><strong>Armando ritual</strong> <button class="btn btn-info btn-circle btn-sm" type="button"><i class="fas fa-info-circle"></i></button></h4>
                    <ul>
                        <li>Objetivo: <span class="objective-selected"></span></li>
                        <li>fecha de publicación: <span class="published-selected"></span></li>
                    </ul>
                    <div class="video-list form-group">
                        <button class="btn btn-block btn-secondary" type="button" data-toggle="collapse" data-target="#vlist1" aria-expanded="false" aria-controls="vlist1">Primera parte</button>
                        <div class="collapse show" id="vlist1">
                          <div class="card card-body" style="max-height: 133px;overflow-y: auto;">
                            <ul class="list list-first-part list-unstyled mb-0">
                                <li class="item my-1">No se encontraron vídeos.</li>
                            </ul>
                          </div>
                        </div>
                    </div>
                    <div class="video-list form-group">
                        <button class="btn btn-block btn-secondary collapsed" type="button" data-toggle="collapse" data-target="#vlist2" aria-expanded="false" aria-controls="vlist2">Segunda parte</button>
                        <div class="collapse" id="vlist2">
                          <div class="card card-body" style="max-height: 133px;overflow-y: auto;">
                            <ul class="list list-second-part list-unstyled mb-0">
                                <li class="item my-1">No se encontraron vídeos.</li>
                            </ul>
                          </div>
                        </div>
                    </div>
                    <div class="video-list form-group">
                        <button class="btn btn-block btn-secondary collapsed" type="button" data-toggle="collapse" data-target="#vlist3" aria-expanded="false" aria-controls="vlist3">Tercera parte</button>
                        <div class="collapse" id="vlist3">
                          <div class="card card-body" style="max-height: 133px;overflow-y: auto;">
                            <ul class="list list-third-part list-unstyled mb-0">
                                <li class="item my-1">No se encontraron vídeos.</li>
                            </ul>
                          </div>
                        </div>
                    </div>
                    <div class="buttons text-center" role="tablist">
                        <button class="btn btn-sm px-5 btn-primary" data-back="true" type="button">Anterior <i class="fas fa-angle-left fa-sm"></i></button>
                        <button class="btn btn-sm px-5 btn-primary btn-step" data-step="2" type="button">Siguiente <i class="fas fa-angle-right fa-sm"></i></button>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-armando2" role="tabpanel" aria-labelledby="nav-armando2-tab">
                    <h4 class="title"><strong>Armando ritual 2</strong> <button class="btn btn-info btn-circle btn-sm" type="button"><i class="fas fa-info-circle"></i></button></h4>
                    <div class="video-list form-group">
                        <button class="btn btn-block btn-secondary" type="button" data-toggle="collapse" data-target="#vlistsolicitados" aria-expanded="false" aria-controls="vlistsolicitados">Vídeos solicitados</button>
                        <div class="collapse show" id="vlistsolicitados">
                          <div class="card card-body" style="max-height: 133px;overflow-y: auto;">
                            <ul class="list list-unstyled mb-0">
                                <li class="item my-1">No se encontraron vídeos.</li>
                            </ul>
                          </div>
                        </div>
                    </div>
                    <div class="video-list form-group">
                        <button class="btn btn-block btn-secondary" type="button" data-toggle="collapse" data-target="#vlistsubidos" aria-expanded="false" aria-controls="vlistsubidos">Tus vídeos subidos</button>
                        <div class="collapse show" id="vlistsubidos">
                          <div class="card card-body" style="max-height: 133px;overflow-y: auto;">
                            <ul class="list list-inline list-own-part mb-0">
                                <li class="item my-1">No se encontraron vídeos.</li>
                            </ul>
                          </div>
                        </div>
                    </div>
                    <div class="buttons text-center" role="tablist">
                        <button class="btn btn-sm px-5 btn-primary" data-back="true" type="button">Anterior <i class="fas fa-angle-left fa-sm"></i></button>
                        <button class="btn btn-sm px-5 btn-primary btn-step" data-step="3" type="button">Siguiente <i class="fas fa-angle-right fa-sm"></i></button>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-configuracion" role="tabpanel" aria-labelledby="nav-configuracion-tab">
                    <h4 class="title"><strong>Configuración final</strong> <button class="btn btn-info btn-circle btn-sm" type="button"><i class="fas fa-info-circle"></i></button></h4>
                    <div class="form-group">
                    <h6 class="m-0 font-weight-bold"><span>Primera parte</span></h6 style="max-height: 133px;overflow-y: auto;">
                    <ul class="list list-inline mb-0">
                        <li class="item first-item my-1">
                            <div class="row py-2 bg-light">
                                <div class="col-2 text-center">
                                    <div class="video h-100 p-2 d-table w-100 bg-dark">
                                        <span class="d-table-cell align-middle"><i class="fa fa-play text-white-50"></i></span>
                                    </div>
                                </div>
                                <div class="col-10 my-auto">
                                    <h6 class="mb-1">{{date('d-m-Y')}} <span class="badge badge-dark">Armado</span></h6>
                                    <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus.</p>
                                </div>
                            </div>
                        </li>
                        <li><h6 class="m-0 font-weight-bold"><span>Segunda parte</span></h6></li>
                        <li class="item second-item my-1">
                            <div class="row py-2 bg-light">
                                <div class="col-2 text-center">
                                    <div class="video h-100 p-2 d-table w-100 bg-dark">
                                        <span class="d-table-cell align-middle"><i class="fa fa-play text-white-50"></i></span>
                                    </div>
                                </div>
                                <div class="col-10 my-auto">
                                    <h6 class="mb-1">{{date('d-m-Y')}} <span class="badge badge-dark">Armado</span></h6>
                                    <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus.</p>
                                </div>
                            </div>
                        </li>
                        <li><h6 class="m-0 font-weight-bold"><span>Tercera parte</span></h6></li>
                        <li class="item third-item my-1">
                            <div class="row py-2 bg-light">
                                <div class="col-2 text-center">
                                    <div class="video h-100 p-2 d-table w-100 bg-dark">
                                        <span class="d-table-cell align-middle"><i class="fa fa-play text-white-50"></i></span>
                                    </div>
                                </div>
                                <div class="col-10 my-auto">
                                    <h6 class="mb-1">{{date('d-m-Y')}} <span class="badge badge-dark">Armado</span></h6>
                                    <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus.</p>
                                </div>
                            </div>
                        </li>
                        <li><h6 class="m-0 font-weight-bold"><span>Parte final</span></h6></li>
                        <li class="item four-item my-1">
                            <div class="row py-2 bg-light">
                                <div class="col-2 text-center">
                                    <div class="video h-100 p-2 d-table w-100 bg-dark">
                                        <span class="d-table-cell align-middle"><i class="fa fa-play text-white-50"></i></span>
                                    </div>
                                </div>
                                <div class="col-10 my-auto">
                                    <h6 class="mb-1">{{date('d-m-Y')}} <span class="badge badge-dark">Armado</span></h6>
                                    <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                    </div>
                    <div class="buttons text-center">
                        <button class="btn btn-sm px-5 btn-primary" data-back="true" type="button"><i class="fas fa-angle-left fa-sm"></i> Atrás</button>
                        <button class="btn btn-sm px-5 btn-primary btn-uploadRitual" type="submit">Compilar <i class="fab fa-mixer fa-sm"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-12 col-md-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3 d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-white">Estado Rituales</h6>
                <div class="text-right ml-auto">
                    <select class="form-control" name="filter">
                        <option value="">Ver todos</option>
                        @foreach($status as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="dropdown no-arrow ml-2">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuERituales" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuERituales">
                        <a class="dropdown-item" href="#">Action</a>
                    </div>
                </div>
            </div>
            <div class="card-body" style="max-height: 717px;overflow-y: auto;">
                <table class="table" id="tbRituales">
                    <thead>
                        <tr>
                            <th>Ritual</th>
                            <th>Detalles</th>
                            <th class="d-none">Objetivo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot class="d-none">
                        <tr>
                            <th>Ritual</th>
                            <th>Detalles</th>
                            <th class="objective" hidden="">Objetivo</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalVideo" tabindex="-1" role="dialog" aria-labelledby="modalVideoLbl" aria-hidden="true">
    <div class="modal-dialog modal-lg h-100" role="document" style="max-height: calc(100% - 63px)">
        <div class="modal-content h-100">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVideoLbl">Vídeo</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="embed-responsive embed-responsive-16by9 h-100 bg-dark"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $('#modalVideo').on('show.bs.modal', function (event) {
      $('#modalVideo .embed-responsive').html(
        `<video controls class="embed-responsive-item item-video">
            <source src="`+$(event.relatedTarget).data('video')+`" type="">
        </video>`
        )
    })

    $('#nav-tab').on('show.bs.tab', function (event) {
        var element = $(event.target);
        $('.form-Steps .card-header h6 span').text(element.data('text'));
    })
    $('[data-back="true"]').on('click', function (event) {
        $('.nav-tabs .nav-item.active').prev().trigger('click');
    })

    $(document).on('click', '#nav-armando1 .video-list .form-check-input', function (event) {
        var btn_collapse = $(this).parents('.video-list').next().find('[data-toggle="collapse"]');
        if(btn_collapse.hasClass('collapsed')) {
            btn_collapse.trigger('click');
        }
    })

    tbrituales = $('#tbRituales').DataTable({
         processing: true,
         serverSide: true,
         ajax: "{{route('ritual.list')}}",
         pageLength: 5,
         lengthMenu: [ 5, 25, 50 ],
         columns: [
            { data: 'video', class: 'border-0' },
            { data: 'details', class: 'border-0' },
            { data: 'objective', class: 'border-0 d-none' },
            { data: 'tools', class: 'text-center border-0 text-nowrap'}
        ],
         columnDefs: [
          //{ orderable: false, targets: 2 },
          { orderable: false, targets: 2 }
        ],
        order: [[ 0, "desc" ]],
        language: dLanguage,
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( '.iv-input', this.footer()).on( 'keyup change clear', function () {
                    if ( that.search() != this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });

    $('.btn-step').on('click', function (event) {
        var objective = $('#objetivo').val();
        var step = $(this).data('step');
        var r_type = $('[name="ritual_type_id"]').val();
        if(step == 1) {
            if($('#rname').val().length == 0) {
                $('.rname-error').show();
                return;
            } else {
                $('.rname-error').hide();
            }
            if(objective.length == 0) {
                $('.object-error').show();
                return;
            } else {
                $('.object-error').hide();
            }
            if($('[name=ritual_type_id]:checked').length == 0) {
                $('.ritual_types-error').show();
                return;
            } else {
                $('.ritual_types-error').hide();
            }
            if($('[name=published_at]').val().length == 0) {
                $('.date-error').show();
                return;
            } else {
                $('.date-error').hide();
            }
            var date = new Date($('[name=published_at]').val());
            var options = { year: 'numeric', month: 'long', day: 'numeric' };

            $('.published-selected').text(date.toLocaleDateString("es-ES", options));
            $('.objective-selected').text($('#objetivo option:selected').text());

            ajaxList(objective, 1, r_type, 'first');
            ajaxList(objective, 2, r_type, 'second');
            ajaxList(objective, 3, r_type, 'third');

            nextNav();
        } else if(step == 2) {
            var objective = $('#objetivo').val();
            if(objective.length == 0) {
                $('.object-error').show();
                return;
            } else {
                $('.object-error').hide();
            }
            if($('#vlist1 .form-check-input:checked').length
                && $('#vlist2 .form-check-input:checked').length
                && $('#vlist3 .form-check-input:checked').length
                ) {

                ajaxList(objective, 4, r_type, 'own');
                nextNav();
            } else {
                Swal.fire(
                  'Rituales',
                  'Se deben seleccionar todos los vídeos',
                  'warning'
                )
            }
        } else if(step == 3) {
            var objective = $('#objetivo').val();
            if(objective.length == 0) {
                $('.object-error').show();
                return;
            } else {
                $('.object-error').hide();
            }
            if($('#vlistsolicitados .form-check-input:checked').length
                || $('#vlistsubidos .form-check-input:checked').length
                ) {

                var first = $('.list-first-part .form-check-input:checked').parents('.item').clone();
                first.find('.form-check').remove()
                var second = $('.list-second-part .form-check-input:checked').parents('.item').clone();
                second.find('.form-check').remove()
                var third = $('.list-third-part .form-check-input:checked').parents('.item').clone();
                third.find('.form-check').remove()
                var four = $('#nav-armando2 .form-check-input:checked').parents('.item').clone();
                four.find('.form-check').remove()

                $('.first-item').html(first.html())
                $('.second-item').html(second.html())
                $('.third-item').html(third.html())
                $('.four-item').html(four.html())
                //ajaxList(objective, 4, 'own');
                nextNav();
            } else {
                Swal.fire(
                  'Rituales',
                  'No se seleccionó ningún vídeo',
                  'warning'
                )
            }
        }
    })

    function nextNav() {
        $('.nav-tabs .nav-item.active').next().trigger('click');
    }

    function ajaxList(objective, part, type, element) {
        $.ajax({
            type: 'GET',
            url: '/videos/'+objective+'/'+part+'/'+type+'/list',
            data: {},
            dataType: 'json',
            success: function(result) {
                var list = $('.list-'+element+'-part');
                list.empty();
                if(result.status == "success") {
                    var data = result.data;
                    if(data.length) {
                        $.each(data, function (id, item) {
                            list.append(getItem(item, part))
                        })
                    } else {
                        list.append('<li class="item my-1">No se encontraron vídeos.</li>')
                    }
                }
            },
            error: function (data) {
                var errors = data.responseJSON;
                console.log(errors)
            }
        });
    }

    function getItem(video, part) {
        html = `
            <li class="item my-1">
                <div class="row py-2 bg-light">
                    <div class="col-2 text-center">
                        <div class="embed-responsive embed-responsive-16by9 h-100 bg-dark">
                        <video class="embed-responsive-item item-video">
                            <source src="uploads/videos/`+video.file+`" type="">
                        </video>
                        </div>
                    </div>
                    <div class="col-6 my-auto">
                        <h6 class="mb-1">`+dateFormatter(video.created_at)+` <span class="badge badge-dark">`+video.video_type+`</span></h6>
                        <p class="mb-0">`+video.name+`</p>
                    </div>
                    <label class="col-4 d-flex align-items-center mb-0" for="video`+video.id+`p`+part+`">
                        <div class="form-check py-2">
                            <input type="radio" class="form-check-input align-middle" id="video`+video.id+`p`+part+`" value="`+video.id+`" name="video`+part+`">
                            <span class="form-check-label align-middle">Seleccionar</span>
                        </div>
                        <button class="btn btn-success py-2 shadow-sm ml-2" data-toggle="modal" data-target="#modalVideo" data-video="/uploads/videos/`+video.file+`" title="Ver" type="button"><i class="fas fa-eye d-block"></i></button>
                    </label>
                </div>
            </li>`;
        return html;
    }

    $('.form-Steps').submit(function (event) {
        event.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            type: "post",
            url: url,
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function (data) {
                $('.btn-uploadRitual').attr('disabled', true);
            },
            success: function (response) {
                if(response.success) {
                    $('.list-rituals').empty();
                    var request = $.parseJSON(response.data);
                    /*$.each(request, function (id, item) {
                        $('.list-rituals').append(getRequestList(item));
                    })*/
                    tbrituales.ajax.reload();
                    Swal.fire(
                      'Rituales',
                      'Se registró el ritual',
                      'success'
                    )
                }
                $('.btn-uploadRitual').attr('disabled', false);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                var errors = jqXHR.responseJSON;
                errorsHtml = '<div class="alert alert-danger mb-0"><ul class="mb-0">';

                $.each( errors.errors, function( key, value ) {
                    errorsHtml += '<li>'+ value + '</li>'; //showing only the first error.
                });
                /*if(jqXHR.status == 413) {
                    errorsHtml += '<li>El archivo supera el tamaño configurado.</li>';
                }*/
                errorsHtml += '</ul></div>';
                Swal.fire(
                  'Rituales',
                  errorsHtml,
                  'error'
                )
                $('.btn-uploadRitual').attr('disabled', false);
            }
        });
    })
</script>
@endsection