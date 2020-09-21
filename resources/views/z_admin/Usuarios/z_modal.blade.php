<div class="modal fade frmUsuarios_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div id="header"class=" modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Modificar Usuario</h4>
        </div>
        <div class="modal-body">

			<form id="frmUsuarios_modificar" class="needs-validation">
				<input type="hidden" id="nome_token_u_modal" required>
			  <div class="form-group row">
			    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Tipo de Usuario:</label>
			    <div class="col-sm-9">
			      <select class="form-control form-control-sm" id="cmb_tipo_u_modal" placeholder="col-form-label-sm" required> </select>
			    </div>
			  </div>

			  <div class="form-group row">
			    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Nombre:</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control form-control-sm" id="txt_nombre_u_modal" placeholder="col-form-label-sm" required>
			    </div>
			  </div>

			  <div class="form-group row">
			    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Email:</label>
			    <div class="col-sm-9">
			      <input type="email" class="form-control form-control-sm" id="txt_email_u_modal" placeholder="col-form-label-sm" required>
			    </div>
			  </div>

			  <div class="form-group row">
			    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Cédula:</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control form-control-sm" id="txt_cedula_u_modal" placeholder="col-form-label-sm" required>
			    </div>
			  </div>		  

			  <div class="form-group row">
			    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Celular:</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control form-control-sm" id="txt_celular_u_modal" placeholder="col-form-label-sm" required>
			    </div>
			  </div>

			  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Dirección:</label>
		    <div class="col-sm-9">
		      <input type="text" name="direccion" class="form-control form-control-sm" id="txt_direccion_u_modal" placeholder="col-form-label-sm" required>
		    </div>
		  </div>

		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Referencia:</label>
		    <div class="col-sm-9">
		      <input type="text" name="referencia" class="form-control form-control-sm" id="txt_referencia_u_modal" placeholder="col-form-label-sm" required>
		    </div>
		  </div>

		  <div class="form-group row">
			    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Contraseña:</label>
			    <div class="col-sm-7">
			      <input type="password" class="form-control form-control-sm password" id="txt_password_u_modal" placeholder="col-form-label-sm" required>
			    </div>
			   
					<!-- <button  type="button" class=" ver_password"  placeholder="col-form-label-sm" >  -->
					<div class="col-sm-2">
						<button  type="button" class="form-control form-control ver_password"  placeholder="col-form-label-sm" > <i class="fa fa-eye" aria-hidden="true"></i></button> 
					</div>
						<!-- <i class="fa fa-eye" aria-hidden="true"></i></button>  -->
			
			  </div>		  

			  <div class="form-group row">
			    <div class="col-sm-12">
			      <input type="submit" class="form-control form-control-sm color-principal" id="btnGuardarUsuario_modal" style="color: white" value="Enviar">
			    </div>
			  </div>

			</form>

	  	</div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
          {{-- <input type="submit" class="form-control form-control-sm bg-primary" id="btnGuardarTipoUsuario_modal" value="Enviar"> --}}
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->