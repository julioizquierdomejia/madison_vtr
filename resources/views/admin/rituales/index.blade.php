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
                    <div class="form-group">
                        <label class="mb-2" for="modo">¿Cómo Quieres armar el ritual?</label>
                        <br>
                        @foreach($ritual_types as $key => $type)
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" id="ritual_type_id{{$key}}" value="{{$type->id}}" name="ritual_type_id">
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
                        <button class="btn btn-primary" type="button" data-step="1">Siguiente <i class="fas fa-angle-right fa-sm"></i></button>
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
                                <li class="item my-1">...</li>
                            </ul>
                          </div>
                        </div>
                    </div>
                    <div class="video-list form-group">
                        <button class="btn btn-block btn-secondary" type="button" data-toggle="collapse" data-target="#vlist2" aria-expanded="false" aria-controls="vlist2">Segunda parte</button>
                        <div class="collapse" id="vlist2">
                          <div class="card card-body" style="max-height: 133px;overflow-y: auto;">
                            <ul class="list list-second-part list-unstyled mb-0">
                                <li class="item my-1">...</li>
                            </ul>
                          </div>
                        </div>
                    </div>
                    <div class="video-list form-group">
                        <button class="btn btn-block btn-secondary" type="button" data-toggle="collapse" data-target="#vlist3" aria-expanded="false" aria-controls="vlist3">Tercera parte</button>
                        <div class="collapse" id="vlist3">
                          <div class="card card-body" style="max-height: 133px;overflow-y: auto;">
                            <ul class="list list-third-part list-unstyled mb-0">
                                <li class="item my-1">...</li>
                            </ul>
                          </div>
                        </div>
                    </div>
                    <div class="buttons text-center" role="tablist">
                        <button class="btn btn-sm px-5 btn-primary shadow-sm" data-back="true" type="button">Anterior <i class="fas fa-angle-left fa-sm"></i></button>
                        <button class="btn btn-sm px-5 btn-primary shadow-sm" data-step="2" type="button">Siguiente <i class="fas fa-angle-right fa-sm"></i></button>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-armando2" role="tabpanel" aria-labelledby="nav-armando2-tab">
                    <h4 class="title"><strong>Armando ritual 2</strong> <button class="btn btn-info btn-circle btn-sm" type="button"><i class="fas fa-info-circle"></i></button></h4>
                    <div class="video-list form-group">
                        <button class="btn btn-block btn-secondary" type="button" data-toggle="collapse" data-target="#vlistsolicitados" aria-expanded="false" aria-controls="vlistsolicitados">Vídeos solicitados</button>
                        <div class="collapse show" id="vlistsolicitados">
                          <div class="card card-body" style="max-height: 133px;overflow-y: auto;">
                            <ul class="list list-unstyled mb-0">
                                <li class="item my-1">...</li>
                            </ul>
                          </div>
                        </div>
                    </div>
                    <div class="video-list form-group">
                        <button class="btn btn-block btn-secondary" type="button" data-toggle="collapse" data-target="#vlistsubidos" aria-expanded="false" aria-controls="vlistsubidos">Tus vídeos subidos</button>
                        <div class="collapse show" id="vlistsubidos">
                          <div class="card card-body" style="max-height: 133px;overflow-y: auto;">
                            <ul class="list list-inline list-own-part mb-0">
                                <li class="item my-1">...</li>
                            </ul>
                          </div>
                        </div>
                    </div>
                    <div class="buttons text-center" role="tablist">
                        <button class="btn btn-sm px-5 btn-primary shadow-sm" data-back="true" type="button">Anterior <i class="fas fa-angle-left fa-sm"></i></button>
                        <button class="btn btn-sm px-5 btn-primary shadow-sm" data-step="3" type="button">Siguiente <i class="fas fa-angle-right fa-sm"></i></button>
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
                        <button class="btn btn-sm px-5 btn-primary shadow-sm" data-back="true" type="button"><i class="fas fa-angle-left fa-sm"></i> Atrás</button>
                        <button class="btn btn-sm px-5 btn-primary shadow-sm btn-uploadRitual" type="submit">Compilar <i class="fab fa-mixer fa-sm"></i></button>
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
                <ul class="list list-inline list-rituals mb-0">
                    @if($rituales->count())
                    @foreach($rituales as $ritual)
                    <li class="item my-1" id="ritual-{{$ritual->id}}">
                        <div class="row py-2 bg-light">
                            <div class="col-2 text-center">
                                <div class="ritual h-100 p-2 d-table w-100 bg-dark">
                                    <span class="d-table-cell align-middle"><i class="fa fa-play text-white-50"></i></span>
                                </div>
                            </div>
                            <div class="col-6 my-auto">
                                <h6 class="mb-1">{{date('d-m-Y', strtotime($ritual->created_at))}}
                                    <span class="badge badge-dark">{{$ritual->objective}}</span>
                                </h6>
                                <p class="mb-0">{{$ritual->name}}</p>
                            </div>
                            <div class="col-4 btn-group">
                                @if($ritual->ritual_status_id == 1)
                                <button class="btn btn-sm btn-success shadow-sm h-100"><i class="fas fa-check d-block"></i> aprobar</button>
                                <button class="btn btn-sm btn-danger shadow-sm h-100">hacer <br>cambios</button>
                                @elseif($ritual->ritual_status_id == 2)
                                <button class="btn bg-white col btn-block shadow-sm h-100"><i class="fas fa-eye fa-2x text-danger d-block"></i> En revisión</button>
                                @elseif($ritual->ritual_status_id == 3)
                                <button class="btn bg-white col btn-block shadow-sm h-100"><i class="fas fa-check fa-2x text-success d-block"></i> Aprobado</button>
                                @elseif($ritual->ritual_status_id == 4)
                                <button class="btn bg-white col btn-block shadow-sm h-100"><i class="fas fa-eye fa-2x text-danger d-block"></i> En revisión</button>
                                @elseif($ritual->ritual_status_id == 5)
                                <button class="btn bg-white col btn-block shadow-sm h-100"><i class="fas fa-play fa-2x text-warning d-block"></i> En producción</button>
                                @endif
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @else
                    <li class="item my-1 text-center py-3">
                        <svg enable-background="new 0 0 508.399 508.399" height="60" viewBox="0 0 508.399 508.399" width="60" xmlns="http://www.w3.org/2000/svg"><g><ellipse cx="244.863" cy="100.966" rx="53.844" ry="53.844" transform="matrix(.987 -.16 .16 .987 -13.011 40.526)"/><path d="m440.002 377.576-126.312-23.273v-130.37h.909c5.444 0 10.425 4.488 10.48 9.429v77.686c0 20.921 23.435 33.131 40.573 21.494l83.286-56.547c11.871-8.06 14.96-24.217 6.901-36.087-8.06-11.87-24.216-14.961-36.087-6.9l-42.712 29v-28.729c0-.043 0-.087 0-.13-.169-33.731-28.18-61.173-62.44-61.173-13.856 0-123.136 0-139.474 0-34.315 0-62.371 27.442-62.541 61.173v.13 29.466l-39.568-26.145c-11.972-7.91-28.087-4.618-35.998 7.354-7.91 11.971-4.618 28.088 7.354 35.998l79.87 52.774c17.158 11.336 40.302-.897 40.302-21.676v-77.685c.055-4.941 5.084-9.429 10.581-9.429h.63v129.542c-11.31 2.867-98.909 25.076-109.399 27.735-13.419 3.402-22.988 15.247-23.494 29.081-.505 13.835 8.173 26.346 21.308 30.719l197.615 65.785c16.332 5.436 33.987-3.392 39.427-19.733 5.438-16.337-3.396-33.989-19.733-39.427l-96.586-32.153c.347-.115 73.216-7.033 73.216-7.033l-24.191 7.31 52.369 17.434c14.019 4.667 24.314 15.382 28.977 28.277l124.632-22.557c14.816-2.681 25.598-15.568 25.624-30.625.027-15.06-10.712-27.983-25.519-30.715z"/><path d="m474.269 76.952-25.96-21.522c-3.844 1.343-7.926 2.047-12.118 2.047-9.699 0-18.823-3.743-25.723-10.546-.912-.899-1.702-1.924-2.222-3.094-1.771-3.978-.82-8.38 2.034-11.235l4.757-4.757c-3.686-3.056-5.295-7.828-4.627-12.569.171-1.215.179-2.483-.002-3.782-.839-6.043-5.857-10.84-11.929-11.429-6.993-.679-13.01 4.024-14.421 10.453l-7.713 4.353c-1.036.585-.773 2.145.397 2.357l8.089 1.471c.613 1.422 1.465 2.714 2.505 3.829 4.972 5.328 7.504 12.488 7.504 19.776 0 22.946 18.601 41.547 41.547 41.547h35.392c3.653.001 5.301-4.569 2.49-6.899z"/><path d="m436.192 47.477c6.819 0 13.637-2.602 18.839-7.804l14.952-14.952c-5.202-5.202-12.021-7.804-18.839-7.804-6.819 0-13.637 2.602-18.839 7.804l-14.952 14.952c5.202 5.202 12.02 7.804 18.839 7.804z"/></g></svg>
                        <p class="pt-4">No existen rituales por el momento.</p>
                        <p>Cree un ritual de acuerdo a la selección de vídeos que tenemos.</p>
                    </li>
                    @endif
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
        $('.form-Steps .card-header h6 span').text(element.data('text'));
    })
    $('[data-back="true"]').on('click', function (event) {
        $('.nav-tabs .nav-item.active').prev().trigger('click');
    })

    $('[data-step="1"]').on('click', function (event) {
        var objective = $('#objetivo').val();
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

        ajaxList(objective, 1, 'first');
        ajaxList(objective, 2, 'second');
        ajaxList(objective, 3, 'third');

        nextNav();
    })
    $('[data-step="2"]').on('click', function (event) {
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

            ajaxList(objective, 4, 'own');
            nextNav();
        }
    })
    $('[data-step="3"]').on('click', function (event) {
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
        }
    })

    function nextNav() {
        $('.nav-tabs .nav-item.active').next().trigger('click');
    }

    function ajaxList(objective, part, element) {
        $.ajax({
            type: 'GET',
            url: '/videos/'+objective+'/'+part+'/list',
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
                        list.append('<li class="item my-1">No hay vídeos</li>')
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
                    <div class="col-4 my-auto">
                        <div class="form-check">
                            <input type="radio" class="form-check-input align-middle" id="video`+video.id+`p`+part+`" value="`+video.id+`" name="video`+part+`">
                            <label class="form-check-label align-middle" for="video`+video.id+`p`+part+`">Seleccionar</label>
                        </div>
                    </div>
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
                    $.each(request, function (id, item) {
                        $('.list-rituals').append(getRequestList(item));
                    })
                    $('.btn-uploadRitual').attr('disabled', false);
                    Swal.fire(
                      'Rituales',
                      'Se registró el ritual',
                      'success'
                    )
                }
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