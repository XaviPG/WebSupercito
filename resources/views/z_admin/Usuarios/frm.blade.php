<div id="cardUsuarios" class="card" class="col-md-9">

     <div class="panel panel-default">
      <div class="panel-heading main-color-bg">
        <h3 class="panel-title">Usuarios</h3>
      </div>
      <div class="panel-body">

			

    <div class="card-body">

		<form id="frmUsuarios" class="needs-validation"  autocomplete="off">

		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Tipo de Usuario:</label>
		    <div class="col-sm-10">
		      <select class="form-control form-control-sm" id="cmb_tipo_u" placeholder="col-form-label-sm" required> </select>
		    </div>
		  </div>

		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Nombre:</label>
		    <div class="col-sm-10">
		      <input type="text" name="name" class="form-control form-control-sm limpiar" id="txt_nombre_u" placeholder="col-form-label-sm" required>
		    </div>
		  </div>

		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Email:</label>
		    <div class="col-sm-10">
		      <input type="email"  name="email" class="form-control form-control-sm limpiar" id="txt_email_u" placeholder="col-form-label-sm" required>
		    </div>
		  </div>

		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Cédula:</label>
		    <div class="col-sm-10">
		      <input type="text" name="cedula" class="form-control form-control-sm limpiar" id="txt_cedula_u" placeholder="col-form-label-sm" required>
		    </div>
		  </div>

		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Celular:</label>
		    <div class="col-sm-10">
		      <input type="text" name="celular" class="form-control form-control-sm limpiar" id="txt_celular_u" placeholder="col-form-label-sm" required>
		    </div>
		  </div>

		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Dirección:</label>
		    <div class="col-sm-10">
		      <input type="text" name="direccion" class="form-control form-control-sm limpiar" id="txt_direccion_u" placeholder="col-form-label-sm" required>
		    </div>
		  </div>

		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Referencia:</label>
		    <div class="col-sm-10">
		      <input type="text" name="referencia" class="form-control form-control-sm limpiar" id="txt_referencia_u" placeholder="col-form-label-sm" required>
		    </div>
		  </div>

		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Contraseña:</label>
		    <div class="col-sm-9">
		      <input type="text"  autocomplete="new-password" class="form-control form-control-sm limpiar password" id="txt_password_u" placeholder="col-form-label-sm" required>
			</div>
			<div class="col-sm-1">
				<button  type="button" class="form-control form-control-sm ver_password"  placeholder="col-form-label-sm" > <i class="fa fa-eye" aria-hidden="true"></i></button> 
			</div>
		  </div>

		  <div class="form-group row">
		    <div class="col-sm-12">
		      <input type="submit" class="form-control form-control-sm btn-red" id="btnGuardarUsuario"  value="Enviar">
			</div>
			
		  </div>

		</form>

    </div>

	<div class="card-footer">
		@include('z_admin.Usuarios.tabla')
		@include('z_admin.Usuarios.z_modal')
	</div>
</div>
</div>
</div>
