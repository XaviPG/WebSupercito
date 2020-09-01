
<div class="card" id="cardProductos">
	<div class="panel panel-default">
		<div class="panel-heading main-color-bg">
		  <h3 class="panel-title">Productos</h3>
		</div>
		<div class="panel-body">

	            <div class="card-body">

						<form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
							@csrf
								<div class="form-group row">
									<div class="col-sm-9">
									<input type="file" name="file" class="form-control" required>
									</div>
									<div class="col-sm-1">
									<input  type="submit"  class="btn btn-success" value="Import User Data">
									</div>
								</div>
							<br>
						</form> 
				
				</div>

	         <div class="card-footer">
		
			   @include('z_admin.Productos.tabla')
		

	       </div>
		@include('z_admin.Productos.z_modal')
		@include('z_admin.Productos.z_modal_img') 	</div>
</div>
</div>
