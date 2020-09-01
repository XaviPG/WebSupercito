<div class="card" id="cardTipoUsuarios">
	<div class="panel-heading main-color-bg">
		<h3 class="panel-title">Roles</h3>
	</div>
	
    <div class="card-header barra"> <!-- <button class="btn btn-sm btn-primary btnOcultarFrmTipoUsuarios"><span class="fa fa-minus"></span></button> --> Roles de Usuarios </div>

	<div class="card-body">

		<!-- <div class="form-group row">

		    <div class="col-sm-1">
		      <button class="btn btn-sm btn-primary"><span class="fa fa-minus"></span></button>
		    </div>
		    <label for="colFormLabelSm" class="col-sm-11 col-form-label col-form-label-sm"><strong>USUARIOS</strong></label>
		</div> -->

		<form id="frmTipoUsuarios" class="needs-validation">

		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Descripcion:</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control form-control-sm limpiar" id="txt_descripcion_t_u" placeholder="col-form-label-sm" required>
		    </div>
		    <div class="col-sm-4">
		      <input type="submit" class="form-control form-control-sm bg-primary" id="btnGuardarTipoUsuario" value="Enviar" style="color: white">
		    </div>
		  </div>

		</form>
    </div>

	<div class="card-footer">
		@include('z_admin.TipoUsuarios.tabla')
		@include('z_admin.TipoUsuarios.z_modal')
	</div>

</div>
