<!-- <div id="cardReportes" class="card">
    <input id="fecha_inicio" type="hidden" name="" value="<?php echo date('d-m-y') ?>">
    <div class="card-header barra">Reportes</div> -->
<div id="cardReportes" class="card" class="col-md-9">
<input id="fecha_inicio" type="hidden" name="" value="<?php echo date('d-m-y') ?>">
      <div class="panel panel-default">
      <div class="panel-heading main-color-bg">
        <h3 class="panel-title">Reportes</h3>
      </div>
      <div class="panel-body">
    <div class="card-body">

		<form id="frmReportes" class="needs-validation">

		  <div class="form-group row">
		    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Tipo de Reporte:</label>
		    <div class="col-sm-8">
		      <select id="cmbTipoReporte" class="form-control form-control-sm" id="cmb_tipo_reporte" placeholder="col-form-label-sm" required>escoger..
          <option value=0 selected>
            <strong>Escoger...</strong>
          </option>  
          <option value="usuarios" selected>Usuarios</option>
            <!-- s -->
            <option value="ventas" selected>Ventas</option>
          </select>
        </div>
        <div class="col-sm-2">
          <button id="jqueryPrinf" class="form-control form-control-sm btn btn-sm btn-primary">Imprimir</button>
        </div>
		  </div>

		</form>

    </div>

	<div class="card-footer">
    @include('z_admin.Reportes.tabla')
    <!-- @include('z_admin.Reportes.tabla_usuario') -->
		{{--@include('z_admin.Reportes.z_modal')--}}
	</div>

</div>
</div>
</div>