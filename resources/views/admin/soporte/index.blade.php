@extends('admin.layouts.app', ['title' => 'Soporte'])
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex align-items-center justify-content-between" style="background-color: #44BBC7;">
                <h6 class="m-0 font-weight-bold"><span>Tutoriales</span></h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuTutorial"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuTutorial">
                        <div class="dropdown-header">Información:</div>
                        <a class="dropdown-item" href="#">Action</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p><strong>A continuación,te explicamos con unos breves videos todas las funcionalidades disponibles.</strong></p>
                <div class="row">
                    <div class="col">
                        <div class="embed-responsive embed-responsive-16by9 bg-dark form-group">
                          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/ZMo29EKgeQg" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="col">
                        <div class="embed-responsive embed-responsive-16by9 bg-dark">
                          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/ZMo29EKgeQg" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3 d-flex align-items-center justify-content-between" style="background-color: #44BBC7;">
                <h6 class="m-0 font-weight-bold">Contáctanos</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuContacto"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuContacto">
                        <div class="dropdown-header">Información:</div>
                        <a class="dropdown-item" href="#">Action</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <p><strong>Estamos para servirte</strong></p>
                            <ul class="list-unstyled">
                                <li class="item my-3 d-flex justify-content-between">
                                    <label for="cambiarplan">Quiero cambiar el plan que tengo</label>
                                    <input type="radio" name="soporte" id="cambiarplan" value="1">
                                </li>
                                <li class="item my-3 d-flex justify-content-between">
                                    <label for="dudas">Tengo dudas sobre los rituales</label>
                                    <input type="radio" name="soporte" id="dudas" value="2">
                                </li>
                                <li class="item my-3 d-flex justify-content-between">
                                    <label for="solicitarvideo">No entiendo muy bien como subir o solicitar un video</label>
                                    <input type="radio" name="soporte" id="solicitarvideo" value="3">
                                </li>
                                <li class="item my-3 d-flex justify-content-between">
                                    <label for="tngoproblema">Tengo un problema</label>
                                    <input type="radio" name="soporte" id="tngoproblema" value="4">
                                </li>
                                <li class="item my-3 d-flex justify-content-between">
                                    <label for="otrotema">Otro tema</label>
                                    <input type="radio" name="soporte" id="otrotema" value="5">
                                </li>
                            </ul>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <textarea class="form-control" rows="5" name="mensaje" placeholder="Mensaje"></textarea>
                        </div>
                        <div class="buttons text-right">
                            <button class="btn btn-dark btn-sm px-5">Enviar</button>
                        </div>                        
                    </div>
                </div>

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