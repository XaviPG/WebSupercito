<!-- Large modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".frmCourier_modal">Large modal</button> -->

<div class="modal fade frmCourier_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

	<div id="header"class=" modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Asignar Transportista</h4>
        </div>

	  	<div class="modal-body">
			  
			<input type="hidden" name="" id="fk_courier_nome_token" value="fk_courier_nome_token">

			@include('z_admin.Pedidos.zfk_tabla_courier')

	  	</div>

	  	<div class="modal-footer">

	  	</div>

    </div>
  </div>
</div>
