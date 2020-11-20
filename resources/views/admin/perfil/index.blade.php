@extends('admin.layouts.app', ['title' => 'Perfil'])
@section('content')
<div class="row">
	<div class="col-12 col-md-5 col-xl-4">
        <div class="card shadow mb-4 h-100">
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold"><span>Perfil</span></h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuPerfil"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuPerfil">
                        <div class="dropdown-header">Información:</div>
                        <a class="dropdown-item" href="#">Action</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p><strong>Utiliza el correo del trabajo</strong></p>
                <div class="form-group">
                	<input class="form-control" type="text" name="name" placeholder="Nombre Administrador de la cuenta">
                </div>
                <div class="form-group">
                	<input class="form-control" type="email" name="email" placeholder="Correo electrónico registrado">
                </div>
                <div class="form-group">
                	<input class="form-control" type="text" name="cargo" placeholder="Cargo de la compañia">
                </div>
                <div class="form-group">
                	<input class="form-control" type="text" name="empresa" placeholder="Empresa">
                </div>
                <div class="form-group">
                	<label>
                		delegar rol de aministrador
                		<input type="checkbox" name="rol" value="1">
                	</label>
                </div>

                <div class="form-group">
                	<input class="form-control" type="text" name="name_delegado" placeholder="Nombre del delegado">
                </div>
                <div class="form-group">
                	<input class="form-control" type="email" name="email_delegado" placeholder="Correo del delegado">
                </div>
                <div class="row">
                	<div class="col-12 col-md-6 form-group">
                		<label for="date_from">Desde</label>
                		<input class="form-control" id="date_from" type="date" name="date_from" placeholder="DD/MM/AA">
                	</div>
                	<div class="col-12 col-md-6 form-group">
                		<label for="date_from">Hasta</label>
                		<input class="form-control" id="date_to" type="date" name="date_from" placeholder="DD/MM/AA">
                	</div>
                </div>
                <div class="form-group row text-right">
                	<div class="col-12 col-md-6 ml-md-auto">
                		<button class="btn btn-primary btn-block" type="submit">Guardar</button>
                	</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-7 col-xl-8">
    	<div class="card shadow mb-4">
    		<div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold"><span>Seguridad</span></h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuSeguridad"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuSeguridad">
                        <div class="dropdown-header">Información:</div>
                        <a class="dropdown-item" href="#">Action</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p><strong>Actualiza o cambia los datos de tu acceso.</strong></p>
                <div class="row mb-2 align-items-center">
                	<label class="col-12 col-md-6 mb-md-0" for="change_email">Cambiar correo registrado</label>
                	<div class="col-12 col-md-6 form-group">
                		<input class="form-control" id="change_email" type="email" name="change_email" placeholder="Ingrese el nuevo correo">
                	</div>
                </div>
                <div class="row mb-2 align-items-center">
                	<label class="col-12 col-md-6 mb-md-0" for="actual_pass">Contraseña actual</label>
                	<div class="col-12 col-md-6 form-group">
                		<span>*********</span>
                	</div>
                </div>
                <div class="row mb-2 align-items-center">
                	<label class="col-12 col-md-6 mb-md-0" for="new_password">Cambiar o actualizar contraseña</label>
                	<div class="col-12 col-md-6 form-group">
                		<input class="form-control" id="new_password" type="password" name="new_password" placeholder="Nueva contraseña" value="123456">
                	</div>
                </div>
                <div class="form-group row text-right">
                	<div class="col-12 col-md-4 ml-md-auto">
                		<button class="btn btn-dark btn-block" type="submit">Guardar</button>
                	</div>
                </div>
            </div>
    	</div>
    	<div class="card shadow">
    		<div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold"><span>Plan MVR.</span></h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuPlan"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuPlan">
                        <div class="dropdown-header">Información:</div>
                        <a class="dropdown-item" href="#">Action</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p><strong>Cambia de plan según tus necesidades. ¿Preguntas? <a class="btn-link" href="/soporte">¿Contáctanos?</a></strong></p>
                <div class="row justify-content-center">
                	<div class="col-12 col-lg-6 col-xl-4 my-2">
                		<div class="card">
                			<div class="card-body">
                				<h6 class="text-center text-dark mb-4"><strong>Basico mensual</strong></h5>
								<ul class="plan-list list-unstyled">
									<li class="my-2">2 rituales al mes</li>
									<li class="my-2">3 bloques predeterminados</li>
									<li class="my-2">1 bloque persoanlizado</li>
								</ul>
                			</div>
                		</div>
                	</div>
                	<div class="col-12 col-lg-6 col-xl-4 my-2">
                		<div class="card border-left-success shadow">
                			<div class="card-body">
                				<h6 class="text-center text-success mb-4"><strong>Medium mensual</strong></h5>
								<ul class="plan-list list-unstyled">
									<li class="my-2">2 rituales al mes</li>
									<li class="my-2">3 bloques predeterminados</li>
									<li class="my-2">1 bloque persoanlizado</li>
								</ul>
                			</div>
                		</div>
                        <div class="text-center mt-2 text-success">
                            <span class="align-middle pr-2">Plan actual </span><i class="fas fa-ws fa-check-circle fa-2x align-middle"></i>
                        </div>
                	</div>
                	<div class="col-12 col-lg-6 col-xl-4 my-2">
                		<div class="card">
                			<div class="card-body">
                				<h6 class="text-center text-dark mb-4"><strong>Full mensual</strong></h5>
								<ul class="plan-list list-unstyled">
									<li class="my-2">2 rituales al mes</li>
									<li class="my-2">3 bloques predeterminados</li>
									<li class="my-2">1 bloque persoanlizado</li>
								</ul>
                			</div>
                		</div>
                	</div>
                </div>
            </div>
    	</div>
    </div>
</div>
@endsection