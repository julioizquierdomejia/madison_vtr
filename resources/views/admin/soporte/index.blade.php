@extends('admin.layouts.app', ['title' => 'Soporte'])
@section('content')
<div class="row">
    <div class="col-12 col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><span>Tutoriales</span></h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuTutorial"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
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
                <div class="embed-responsive embed-responsive-16by9 form-group">
                  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>
                </div>
                <div class="embed-responsive embed-responsive-16by9 form-group">
                  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card shadow h-100 mb-4">
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Contáctanos</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuContacto"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuContacto">
                        <div class="dropdown-header">Información:</div>
                        <a class="dropdown-item" href="#">Action</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p><strong>Estamos para servirte</strong></p>
                <ul class="list-unstyled">
                    <li class="item my-3 d-flex justify-content-between">
                        <span>Quiero cambiar el plan que tengo</span>
                        <input type="radio" name="tipoproblema">
                    </li>
                    <li class="item my-3 d-flex justify-content-between">
                        <span>Tengo dudas sobre los rituales</span>
                        <input type="radio" name="tipoproblema">
                    </li>
                    <li class="item my-3 d-flex justify-content-between">
                        <span>No entiendo muy bien como subir o solicitar un video</span>
                        <input type="radio" name="tipoproblema">
                    </li>
                    <li class="item my-3 d-flex justify-content-between">
                        <span>Tengo un problema</span>
                        <input type="radio" name="tipoproblema">
                    </li>
                    <li class="item my-3 d-flex justify-content-between">
                        <span>Otro tema</span>
                        <input type="radio" name="tipoproblema">
                    </li>
                </ul>
                <div class="form-group">
                    <textarea class="form-control" rows="5" name="mensaje" placeholder="Mensaje"></textarea>
                </div>
                <div class="buttons text-right">
                    <button class="btn btn-dark">Enviar</button>
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