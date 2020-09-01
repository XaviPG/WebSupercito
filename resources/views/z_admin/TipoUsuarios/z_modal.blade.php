<div class="modal fade frmTipoUsuarios_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div id="header"class=" modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Modificar Rol</h4>
        </div>
        <div class="modal-body">

			<form id="frmTipoUsuarios_modificar" class="needs-validation">
				<input type="hidden" name="" id="nome_token_tipo_u_modal" required>
				<div class="form-group row">
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Descripcion:</label>
				    <div class="col-sm-6">
				    	<input type="text" class="form-control form-control-sm" id="txt_descripcion_t_u_modal" placeholder="col-form-label-sm" required>
				    </div>
				    <div class="col-sm-4">
                        <input type="submit" class="form-control form-control-sm color-principal" id="btnGuardarTipoUsuario_modal" value="Enviar" style="color: white">
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