@extends('admin.layouts.app', ['title' => 'Home'])
@section('content')
<div class="row">
    <div class="col-12 col-md-6">
        <div class="card shadow card-steps h-100 mb-4">
            <nav class="card-header py-3 d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary"><span>Crea un ritual</span></h6>
                <div class="nav nav-tabs ml-auto" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-text="Crea un ritual" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fas fa-dot-circle"></i></a>
                    <a class="nav-item nav-link" id="nav-armando1-tab" data-text="Armando ritual" data-toggle="tab" href="#nav-armando1" role="tab" aria-controls="nav-armando1" aria-selected="false"><i class="fas fa-dot-circle"></i></a>
                    <a class="nav-item nav-link" id="nav-armando2-tab" data-text="Armando ritual" data-toggle="tab" href="#nav-armando2" role="tab" aria-controls="nav-armando2" aria-selected="false"><i class="fas fa-dot-circle"></i></a>
                    <a class="nav-item nav-link" id="nav-configuracion-tab" data-text="Configuración final" data-toggle="tab" href="#nav-configuracion" role="tab" aria-controls="nav-configuracion" aria-selected="false"><i class="fas fa-dot-circle"></i></a>
                </div>
                <div class="dropdown no-arrow ml-2">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuSVideo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
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
                        <label class="mb-4" for="objetivo">Empieza escogiendo un objetivo</label>
                        <select class="form-control" name="objetivo" id="objetivo">
                            <option>Incentivar la colaboración</option>
                            <option>Objetivo 2</option>
                            <option>Objetivo 3</option>
                            <option>Objetivo 4</option>
                            <option>Objetivo 5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mb-4" for="modo">¿Cómo Quieres armar el ritual?</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" id="modo1" value="1" name="modo">
                            <label class="form-check-label" for="modo1"><span class="align-middle">Sugerirme un ritual</span></label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" id="modo2" value="2" name="modo">
                            <label class="form-check-label" for="modo2"><span class="align-middle">Armaré el ritual a medida</span></label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="mb-4" for="modo">Tercera parte</label>
                        <input class="form-control" type="date" name="fecha" value="{{date('Y-m-d')}}">
                        <i class="fa fa-date"></i>
                    </div>
                    <div class="buttons text-right" role="tablist">
                        <a class="btn btn-sm px-5 btn-primary shadow-sm" data-toggle="tab" href="#nav-armando1" role="tab">Siguiente <i class="fas fa-angle-right fa-sm"></i></a>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-armando1" role="tabpanel" aria-labelledby="nav-armando1-tab">
                    <h4 class="title"><strong>Armando ritual</strong> <button class="btn btn-info btn-circle btn-sm" type="button"><i class="fas fa-info-circle"></i></button></h4>
                    <ul>
                        <li>Objetivo: Incentivar colaboraración</li>
                        <li>fecha de publicación: ss/mm/aaaa</li>
                    </ul>
                    <div class="video-list form-group">
                        <button class="btn btn-block btn-secondary" type="button" data-toggle="collapse" data-target="#vlist1" aria-expanded="false" aria-controls="vlist1">Primera parte</button>
                        <div class="collapse" id="vlist1">
                          <div class="card card-body">
                            <ul class="list list-unstyled mb-0">
                                <li class="item my-1">
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
                                        <div class="col-4 my-auto">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="video1p1" value="1" name="video1">
                                                <label class="form-check-label" for="video1p1">Seleccionar</label>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                          </div>
                        </div>
                    </div>
                    <div class="video-list form-group">
                        <button class="btn btn-block btn-secondary" type="button" data-toggle="collapse" data-target="#vlist2" aria-expanded="false" aria-controls="vlist2">Primera parte</button>
                        <div class="collapse" id="vlist2">
                          <div class="card card-body">
                            <ul class="list list-unstyled mb-0">
                                <li class="item my-1">
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
                                        <div class="col-4 my-auto">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="video1p2" value="1" name="video2">
                                                <label class="form-check-label" for="video1p2">Seleccionar</label>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                          </div>
                        </div>
                    </div>
                    <div class="video-list form-group">
                        <button class="btn btn-block btn-secondary" type="button" data-toggle="collapse" data-target="#vlist3" aria-expanded="false" aria-controls="vlist3">Primera parte</button>
                        <div class="collapse" id="vlist3">
                          <div class="card card-body">
                            <ul class="list list-unstyled mb-0">
                                <li class="item my-1">
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
                                        <div class="col-4 my-auto">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="video1p3" value="1" name="video3">
                                                <label class="form-check-label" for="video1p3">Seleccionar</label>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                          </div>
                        </div>
                    </div>
                    <div class="buttons text-right" role="tablist">
                        <a class="btn btn-block btn-sm px-5 btn-primary shadow-sm" data-toggle="tab" href="#nav-armando2" role="tab">Siguiente <i class="fas fa-angle-right fa-sm"></i></a>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-armando2" role="tabpanel" aria-labelledby="nav-armando2-tab">
                    <h4 class="title"><strong>Armando ritual 2</strong> <button class="btn btn-info btn-circle btn-sm" type="button"><i class="fas fa-info-circle"></i></button></h4>
                    <div class="video-list form-group">
                        <button class="btn btn-block btn-secondary" type="button" data-toggle="collapse" data-target="#vlistsolicitados" aria-expanded="false" aria-controls="vlistsolicitados">Vídeos solicitados</button>
                        <div class="collapse" id="vlistsolicitados">
                          <div class="card card-body">
                            <ul class="list list-unstyled mb-0">
                                <li class="item my-1">
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
                                        <div class="col-4 my-auto">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="checkarmandop1" value="1" name="armandovideo1">
                                                <label class="form-check-label" for="checkarmandop1">Seleccionar</label>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                          </div>
                        </div>
                    </div>
                    <div class="video-list form-group">
                        <button class="btn btn-block btn-secondary" type="button" data-toggle="collapse" data-target="#vlistsubidos" aria-expanded="false" aria-controls="vlistsubidos">Tus vídeos subidos</button>
                        <div class="collapse" id="vlistsubidos">
                          <div class="card card-body">
                            <ul class="list list-unstyled mb-0">
                                <li class="item my-1">
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
                                        <div class="col-4 my-auto">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="checkarmandop2" value="1" name="armandovideo2">
                                                <label class="form-check-label" for="checkarmandop2">Seleccionar</label>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                          </div>
                        </div>
                    </div>
                    <div class="buttons text-right" role="tablist">
                        <a class="btn btn-sm px-5 btn-primary shadow-sm" data-toggle="tab" href="#nav-configuracion" role="tab">Siguiente <i class="fas fa-angle-right fa-sm"></i></a>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-configuracion" role="tabpanel" aria-labelledby="nav-configuracion-tab">
                    <h4 class="title"><strong>Configuración final</strong> <button class="btn btn-info btn-circle btn-sm" type="button"><i class="fas fa-info-circle"></i></button></h4>
                    <div class="form-group">
                    <h6 class="m-0 font-weight-bold text-primary"><span>Primera parte</span></h6>
                    <ul class="list list-unstyled mb-0">
                        <li class="item my-1">
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
                                <div class="col-4 my-auto">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="checkarmandop2" value="1" name="armandovideo2">
                                        <label class="form-check-label" for="checkarmandop2">Seleccionar</label>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <h6 class="m-0 font-weight-bold text-primary"><span>Segunda parte</span></h6>
                    <ul class="list list-unstyled mb-0">
                        <li class="item my-1">
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
                                <div class="col-4 my-auto">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="checkarmandop2" value="1" name="armandovideo2">
                                        <label class="form-check-label" for="checkarmandop2">Seleccionar</label>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <h6 class="m-0 font-weight-bold text-primary"><span>Tercera parte</span></h6>
                    <ul class="list list-unstyled mb-0">
                        <li class="item my-1">
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
                                <div class="col-4 my-auto">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="checkarmandop2" value="1" name="armandovideo2">
                                        <label class="form-check-label" for="checkarmandop2">Seleccionar</label>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <h6 class="m-0 font-weight-bold text-primary"><span>Parte final</span></h6>
                    <ul class="list list-unstyled mb-0">
                        <li class="item my-1">
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
                                <div class="col-4 my-auto">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="checkarmandop2" value="1" name="armandovideo2">
                                        <label class="form-check-label" for="checkarmandop2">Seleccionar</label>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    </div>
                    <div class="buttons text-center">
                        <a class="btn btn-sm px-5 btn-primary shadow-sm" data-toggle="tab" href="#nav-armando2" role="tab"><i class="fas fa-angle-left fa-sm"></i> Atrás</a>
                        <button class="btn btn-sm px-5 btn-primary shadow-sm" type="button">Compilar <i class="fab fa-mixer fa-sm"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card shadow h-100 mb-4">
            <div class="card-header py-3 d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Estado Rituales</h6>
                <div class="text-right ml-auto">
                    <select class="form-control" name="filter">
                        <option value="">Ver todos</option>
                        <option value="1">Subidos</option>
                        <option value="2">Por aprobar</option>
                        <option value="3">Aprobados</option>
                        <option value="4">En producción</option>
                        <option value="5">En revisión</option>
                    </select>
                </div>
                <div class="dropdown no-arrow ml-2">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuERituales" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuERituales">
                        <a class="dropdown-item" href="#">Action</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="list list-unstyled mb-0">
                    <li class="item my-1">
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
                            <div class="col-4 d-flex">
                                <button class="btn col btn-sm btn-success shadow-sm h-100"><i class="fas fa-check d-block"></i> aprobar</button>
                                <button class="btn col btn-sm btn-danger shadow-sm h-100">hacer <br>cambios</button>
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
                            <div class="col-4 d-flex">
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
                            <div class="col-4 d-flex">
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
                            <div class="col-4 d-flex">
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
                            <div class="col-4 d-flex">
                                <button class="btn col btn-sm btn-primary shadow-sm h-100"><i class="fas fa-check d-block"></i> publicar</button>
                                <button class="btn col btn-sm btn-danger shadow-sm h-100"><i class="fas fa-trash d-block"></i> borrar</button>
                            </div>
                        </div>
                    </li>
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
</script>
@endsection