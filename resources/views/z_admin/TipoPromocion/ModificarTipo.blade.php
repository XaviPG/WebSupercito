
<div class="modal fade " tabindex="-1" role="dialog" id="frmTipo_Promocion">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div id="header"class=" modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Modificar tipo de promoción</h4>
        </div>
        <div class="modal-body">

			<form id="frmTipoPromocion" class="needs-validation" method="post">
				<input type="hidden" name="" id="nome_token_TIPO" required>
				<div class="form-group row">
				    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Descripcion:</label>
				    <div class="col-sm-6">
				    	<input type="text" class="form-control form-control-sm" id="txt_descripcion" placeholder="col-form-label-sm" required>
				    </div>
				   
				</div>
			</form>

	  	</div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" onclick=" botonClose();" data-dismiss="modal">SALIR</button>
          <button type="button" class="btn btn-warning btn-sm" onclick=" UpdateTipo();">MODIFICAR DATOS</button> 
          
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
