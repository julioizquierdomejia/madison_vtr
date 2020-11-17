@extends('admin.layouts.app', ['title' => 'Resumen'])
@section('content')
<div class="row">
    <div class="col-12 col-sm-6 col-md-4 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            <strong>NPC</strong> Número de paticipantes conectados</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">35/<small>100</small></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <strong>NCA</strong> Número de cámarcas abiertas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">33/<small>100</small></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-play fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-4 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Porcentage de satisfacción</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">80%</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-laugh-beam fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="card shadow h-100 mb-4">
            <div class="card-header py-3 d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Historial de Rituales</h6>
                <div class="text-right ml-auto">
                    <select class="form-control" name="filter">
                        <option value="">Ver todos</option>
                        @foreach($ritual_status as $ritem)
                        <option value="{{$ritem->id}}">{{$ritem->name}}</option>
                        @endforeach
                    </select>
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
            </div>
            <div class="card-body">
                <ul class="list list-unstyled mb-0">
                    @foreach($rituales as $ritual)
                    <li class="item my-1" id="ritual-{{$ritual->id}}">
                        <div class="row py-2 bg-light">
                            <div class="col-2 text-center">
                                <div class="video h-100 p-2 d-table w-100 bg-dark">
                                    <span class="d-table-cell align-middle"><i class="fa fa-play text-white-50"></i></span>
                                </div>
                            </div>
                            <div class="col-6 my-auto">
                                <h6 class="mb-1">{{date('d-m-Y', strtotime($ritual->created_at))}} <span class="badge badge-dark">Armado</span></h6>
                                <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus.</p>
                            </div>
                            <div class="col-4 btn-group">
                                <button class="btn btn-sm btn-success shadow-sm h-100"><i class="fas fa-check d-block"></i> aprobar</button>
                                <button class="btn btn-sm btn-danger shadow-sm h-100">hacer <br>cambios</button>
                            </div>
                        </div>
                    </li>
                    @endforeach
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
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card shadow h-100 mb-4">
            <div class="card-header py-3 d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Historia de Vídeos</h6>
                <div class="text-right ml-auto">
                    <select class="form-control" name="filter">
                        <option value="">Ver todos</option>
                        @foreach($video_status as $vitem)
                        <option value="{{$vitem->id}}">{{$vitem->name}}</option>
                        @endforeach
                    </select>
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
            </div>
            <div class="card-body">
                <ul class="list list-unstyled mb-0">
                    @foreach($videos as $video)
                    <li class="item my-1" id="video-{{$video->id}}">
                        <div class="row py-2 bg-light">
                            <div class="col-2 text-center">
                                <div class="video h-100 p-2 d-table w-100 bg-dark">
                                    <span class="d-table-cell align-middle"><i class="fa fa-play text-white-50"></i></span>
                                </div>
                            </div>
                            <div class="col-6 my-auto">
                                <h6 class="mb-1">{{date('d-m-Y', strtotime($video->created_at))}} <span class="badge badge-dark">Armado</span></h6>
                                <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus.</p>
                            </div>
                            <div class="col-4 btn-group">
                                <button class="btn btn-sm btn-success shadow-sm h-100"><i class="fas fa-check d-block"></i> aprobar</button>
                                <button class="btn btn-sm btn-danger shadow-sm h-100">hacer <br>cambios</button>
                            </div>
                        </div>
                    </li>
                    @endforeach
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