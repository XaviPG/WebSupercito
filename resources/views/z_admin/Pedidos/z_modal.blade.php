<!-- Large modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".frmPedidos_modal">Large modal</button> -->
<div class="modal fade frmPedidos_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl"  role="document" >
      <div class="modal-content">
        <div id="header"class=" modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Datos de la orden</h4>
        </div>
 

	  	<div class="modal-body">

			<form id="frmPedidos_modificar" class="needs-validation">
				<input type="hidden" name="" id="nome_token_pedido_modal" required>
				

					<div id="tabla_infor_pedido">
					</div>
					<div  id="tabla_infor_pedido_productos">
						<div class="table-responsive">
								<table  class="display" id="pedido_listado_productos" style="width: 100%!important;">
								</table>
						</div>
					</div>
				
			</form>



	  	</div>

	  	<div class="modal-footer">

	  	</div>

    </div>
  </div>
</div>
