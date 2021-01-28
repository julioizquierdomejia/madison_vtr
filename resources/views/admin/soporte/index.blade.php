@extends('admin.layouts.app', ['title' => 'Soporte'])
@section('content')
<div class="row">
    @if($role != 'superadmin')
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
                <form class="frm row" action="/soporte" method="POST">
                    @csrf
                    <div class="col">
                        <p><strong>Estamos para servirte</strong></p>
                            <ul class="list-unstyled">
                                @foreach ($support_types as $key => $item)
                                <li class="item my-3 d-flex justify-content-between">
                                    <label for="st{{$key}}">{{$item->name}}</label>
                                    <input type="radio" name="soporte" id="st{{$key}}" value="{{$item->id}}">
                                </li>
                                @endforeach
                            </ul>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <textarea class="form-control" rows="5" name="mensaje" placeholder="Mensaje"></textarea>
                        </div>
                        <div class="buttons text-right">
                            <button class="btn btn-dark btn-sm px-5" type="submit">Enviar</button>
                        </div>                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    @else
    <div class="col-12">
        <table class="table" id="tbSupports">
            <thead>
                <tr>
                    <td>Fecha</td>
                    <td>Tipo</td>
                    <td>Usuario</td>
                    <td>Mensaje</td>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($supports as $item)
                <tr>
                    <td>{{$item->created_at->format('d-m-Y')}}</td>
                    <td>{{$item->type->name}}</td>
                    <td>{{$item->user->name}}</td>
                    <td>{{$item->message}}</td>
                </tr>
                @endforeach --}}
            </tbody>
        </table>
        </div>
    @endif
</div>
@endsection
@section('script')
<script>
    $(document).ready(function (event) {
        $('#nav-tab').on('show.bs.tab', function (event) {
            var element = $(event.target);
            $('.card-steps .card-header h6 span').text(element.data('text'));
        })

        $('#tbSupports').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/soporte/list",
            pageLength: 5,
            lengthMenu: [ 5, 25, 50 ],
            columns: [
                { data: 'created_at', class: 'text-nowrap' },
                { data: 'type', class: 'type' },
                { data: 'user', class: 'user text-center' },
                { data: 'message' },
            ],
            columnDefs: [
                //{ orderable: false, targets: 2 },
            ],
            //order: [[ 0, "desc" ]],
            language: dLanguage
        });
    })
</script>
@endsection