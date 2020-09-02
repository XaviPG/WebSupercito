<div class="col-md-2">
    <div class="card">
        <!-- <div class="card-header">Opciones</div> -->
        <div class="card-body">
            <!-- <button class="btn btn-secondary btn-lg --> <!--btn-block">Usuarios</button> -->
      @guest

			@else
				@if(Auth::user()->idtipo==1)
	          <button id="btnVerFrmTipoUsuarios" class="btn btn-lg btn-block botones">
			  			<div class="row fa fa-users"></div>
			  			<div class="row"><div class="col-md-12"><h6 class="text-white">Roles</h6></div>
			  		</button>
			  		<button id="btnVerFrmUsuarios" class="btn btn-lg btn-block botones">
			  			<div class="fa fa-user"></div>
			  			<div class="row"><div class="col-md-12"><h6>Usuarios</h6></div>
			  		</button>
			  		<button id="btnVerFrmProductos" class="btn btn-lg btn-block botones">
			  			<div class="fa fa-product-hunt"></div>
			  			<div class="row"><div class="col-md-12"><h6>Productos</h6></div>
			  		</button>
				@endif
			@endguest
	  		<button id="btnVerFrmPedidos" class="btn btn-secondary btn-lg btn-block botones">
	  			<div class="fa fa-cubes"></div>
	  			<div class="row"><div class="col-md-12"><h6>Pedidos</h6></div>
	  		</button>
	  		<button id="btnVerFrmVentas" class="btn btn-secondary btn-lg btn-block botones">
	  			<div class="fa fa-shopping-cart"></div>
	  			<div class="row"><div class="col-md-12"><h6>Ventas<h6></div>
	  		</button>
      @guest
      @else
        @if(Auth::user()->idtipo==1)
          <button id="btnVerFrmReportes" class="btn btn-secondary btn-lg btn-block botones">
            <div class="fa fa-phone"></div>
            <div class="row"><div class="col-md-12"><h6>Reportes<h6></div>
          </button>
        @endif
      @endguest
        </div>
    </div>
</div>
