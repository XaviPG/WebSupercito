<!-- z_modal.blade.php -->
<!-- Large modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".frmProductos_modal">Large modal</button> -->

<div class="modal fade frmProductos_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="width:350px;">
      <div class="modal-content">
        <div id="header"class=" modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Datos del Producto</h4>
        </div>
 
	  	<div class="modal-body">

			<form id="frmProductos_modificar" class="needs-validation">
				{{-- <input type="hidden" name="" id="nome_token_productos_modal" required> --}}
				<div class="container">
					<div class="row" id="tabla_infor_producto">
					</div>
				</div>
			</form>

	  	</div>

	  	<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	  	</div>
    </div>
  </div>
</div>
