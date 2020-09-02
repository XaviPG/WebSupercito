<!-- Large modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".frmTipoUsuarios_modal">Large modal</button> -->

<div class="modal fade frmUsuarios_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
	  	<div class="modal-header text-white" style="background:  #004a93">
	        <h5 class="modal-title" id="exampleModalLabel">Modificar Usuario</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span class="text-white" aria-hidden="true">&times;</span>
	        </button>  		
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
			    <label for="colFormLabelSm" class="col-sm-3 col-form-label col-form-label-sm">Clave:</label>
			    <div class="col-sm-8">
			      <input type="password" class="form-control form-control-sm password" id="txt_password_u_modal" placeholder="col-form-label-sm" required>
			    </div>
			    <div class="col-sm-1">
					<button  type="button" class="form-control form-control-sm ver_password"  placeholder="col-form-label-sm" > <i class="fa fa-eye" aria-hidden="true"></i></button> 
			      {{-- <label  type="submit" class="form-control form-control-sm" id="btnVerPassword" placeholder="col-form-label-sm" > <i class="fa fa-eye" aria-hidden="true"></i></label>  --}}
			    </div>
			  </div>		  

			  <div class="form-group row">
			    <div class="col-sm-12">
			      <input type="submit" class="form-control form-control-sm bg-primary" id="btnGuardarUsuario_modal" style="color: white" value="Enviar">
			    </div>
			  </div>

			</form>

	  	</div>	     

	  	<div class="modal-footer">
	  		
	  	</div>

    </div>
  </div>
</div>