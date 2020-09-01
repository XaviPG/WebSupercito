<!-- z_modal.blade.php -->
<!-- Large modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".frmVentas_modal">Large modal</button> -->
<div class="modal fade frmVentas_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl"  role="document" >
      <div class="modal-content">
        <div id="header"class=" modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Datos de la venta</h4>
        </div>
 

	  	<div class="modal-body">
 
			<form id="frmVentas_modificar" class="needs-validation">
				{{-- <input type="hidden" name="" id="nome_token_ventas_modal" required> --}}
				{{-- <div class="container"> --}}
					<div  id="tabla_infor_venta">
					</div>
					<div >
						<div class="table-responsive">
								<table  class="display" id="venta_listado_ventas" style="width: 100%!important;">
								</table>
						</div>
					</div>
				{{-- </div> --}}
			</form>

	  	</div>

	  	<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
	  	</div>
    </div>
  </div>
</div>
