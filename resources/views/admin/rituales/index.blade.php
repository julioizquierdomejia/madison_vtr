@extends('admin.layouts.app', ['title' => 'Home'])
@section('content')
<div class="row">
    <div class="col-12 col-md-6 mb-4">
        <div class="card shadow card-steps h-100">
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
                            @foreach($objectives as $objective)
                            <option value="{{$objective->id}}">{{$objective->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mb-4" for="modo">¿Cómo Quieres armar el ritual?</label>
                        <br>
                        @foreach($ritual_types as $key => $type)
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" id="ritual_type_id{{$key}}" value="{{$type->id}}" name="ritual_type_id">
                            <label class="form-check-label" for="ritual_type_id{{$key}}"><span class="align-middle">{{$type->name}}</span></label>
                        </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label class="mb-4" for="modo">Tercera parte</label>
                        <input class="form-control" type="date" name="fecha" min="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}">
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
    <div class="col-12 col-md-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3 d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Estado Rituales</h6>
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
                    {{-- <li class="item my-1">
                        <div class="row py-2 bg-light">
                            <div class="col-2 text-center">
                                <div class="ritual h-100 p-2 d-table w-100 bg-dark">
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
                                <div class="ritual h-100 p-2 d-table w-100 bg-dark">
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
                                <div class="ritual h-100 p-2 d-table w-100 bg-dark">
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
                                <div class="ritual h-100 p-2 d-table w-100 bg-dark">
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
</script>
@endsection