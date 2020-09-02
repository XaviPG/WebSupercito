
{{-- <input type="" name="" id="filtroPedidos"> --}}
<input type="hidden" name="" id="pedido_nome_token" value="pedido_nome_token">
<div class="table-responsive">
  {{-- <table class="table table-sm"> --}}
  <table class="display" id="tablaPedidos_padre">
    <thead> <!-- style="border: 1px solid #000000" -->
      <tr>
        <th scope="col">#</th>
        <th scope="col">Fecha</th>
        <th scope="col">Cliente</th>
        <th scope="col">Transporte</th>
        <th scope="col">Acciones</th>

        <!--
        <th scope="col">#</th>
        <th scope="col">Cliente</th>
        <th scope="col">Transporte</th>
        <th scope="col">Total</th>
        <th scope="col">Estado</th>
        <th scope="col">Acciones</th>
        -->

      </tr>
    </thead>
    <tbody id="tablaPedidos">
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td><button type="button" class="btn btn-sm btn-outline-success">Asignar </button></td>
      	<td>
	        <button type="button" class="btn btn-sm btn-outline-info">Ver</button>
	        <button type="button" class="btn btn-sm btn-outline-secondary">Eliminar</button>
      	</td>
      </tr>
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td><button type="button" class="btn btn-sm btn-outline-success">Asignar </button></td>
      	<td>
	        <button type="button" class="btn btn-sm btn-outline-info">Ver</button>
	        <button type="button" class="btn btn-sm btn-outline-secondary">Eliminar</button>
      	</td>
      </tr>
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td><button type="button" class="btn btn-sm btn-outline-success">Asignar </button></td>
      	<td>
	        <button type="button" class="btn btn-sm btn-outline-info">Ver</button>
	        <button type="button" class="btn btn-sm btn-outline-secondary">Eliminar</button>
      	</td>
      </tr>
    </tbody>
  </table>
</div>
