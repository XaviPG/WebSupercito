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
      <div class="col-sm-2">
		    <label for="colFormLabelSm" class="form-control form-control-sm">       Reporte de:</label>
      </div> 
        <div class="col-sm-8">
		      <select id="cmbTipoReporte" class="form-control form-control-sm" id="cmb_tipo_reporte" placeholder="col-form-label-sm" required>escoger..
          <option value=0 selected>
            <strong>Escoger...</strong>
          </option>  
          <!-- <option value="usuarios" selected>Usuarios</option> -->
            <!-- s -->
            <option value="ventas" selected>Ventas</option>
          </select>
        </div>
    
        <div class="col-sm-2">
          <button id="jqueryPrinf" class="form-control form-control-sm btn btn-sm btn-primary">Imprimir</button>
        </div>
      </div>
      <div id="contenido_ventas" class="form-row" >
           <div class="form-row" >
               <div class="col-md-3">
                  <div class="input-group-prepend">
                        <div class="input-group-text">
                           <input type="checkbox" aria-label="Checkbox for following text input" id="check_consultar">  <label  for=""> Consultar por fecha</label>
                        </div>
                  </div>    
               </div>  
      
            </div> 
            <div class="form-row" >     
               <div id="desde" class="col-md-4">
                    <label id="desde">Desde</label>
                       <div class="input-group">
                         <div class="input-group-addon"><i class="fa fa-calendar" ></i></div>
                           <input  type="date" class="form-control pull-right " id="fecha_desde" value="{{ date('Y-m-d') }}">
                         </div>
                       </div>  
                 </div> 
                       
                  <div id="hasta" class="col-md-4">
                      <label >Hasta</label>
                      <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar" ></i></div>
                                <input  type="date" class="form-control pull-right " id="fecha_hasta" value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
             
                
                    <div  class="col-md-1">
                    <label > </label>
                       <div class="input-group">
                       <button id="btn_consultarxfecha" type='button' style='color: black;' ><i class='fa fa-search' aria-hidden='false'></i></button>
                      <!-- <input type="submit" class="form-control form-control-sm btn-red" id="btnGuardarUsuario"  value="Enviar"> -->
                       </div>
                    </div>
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