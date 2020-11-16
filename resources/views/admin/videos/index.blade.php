@extends('admin.layouts.app', ['title' => 'Vídeos'])
@section('content')
<div class="row">
    <div class="col-12 col-md-6">
        <div class="card shadow card-steps mb-4">
            <nav class="card-header py-3 d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary"><span>Subir un vídeo</span></h6>
                <div class="input-group ml-auto col-6 col-md-7">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-upload"></i></span>
                    </div>
                    <div class="custom-file">
                        <input type="file" accept="application/pdf" class="custom-file-input" id="inputGroupFile"
                        aria-describedby="inputGroupFile" name="upload_file">
                        <label class="custom-file-label" for="inputGroupFile">Seleccionar archivo</label>
                    </div>
                </div>
                <div class="dropdown no-arrow ml-2" style="z-index: 2">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuSbVideo"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuSbVideo">
                        <div class="dropdown-header">Información:</div>
                        <a class="dropdown-item" href="#">Action</a>
                    </div>
                </div>
            </nav>
            <div class="card-body">
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
        </div>
        <div class="card shadow card-steps mb-4">
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><span>Solicitar un vídeo</span></h6>
                <div class="dropdown no-arrow ml-2">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuSVideo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
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
                <ul class="list-inline">
                    <li class="d-inline-block"><label>Activar servicio express <input type="checkbox" name=""></label></li>
                    <li class="d-inline-block"><label>Animación <input type="checkbox" name=""></label></li>
                    <li class="d-inline-block"><label>Grabación <input type="checkbox" name=""></label></li>
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
                                    <input type="file" accept="application/pdf" class="custom-file-input" id="inputGroupFile"
                                    aria-describedby="inputGroupFile" name="upload_file">
                                    <label class="custom-file-label" for="inputGroupFile">subir speech</label>
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
            <div class="card-header py-3 d-flex align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Estado de Vídeos</h6>
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
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuSVideo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuSVideo">
                        <div class="dropdown-header">Información:</div>
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