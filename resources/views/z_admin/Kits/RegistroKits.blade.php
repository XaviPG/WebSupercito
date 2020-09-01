

<div class="panel panel-default " id="cardregistrokit" >
		
        <div class="panel-heading text-center" >  <h3 class="panel-title"> <strong>INGRESOS DE KITS</strong></h3> </div>
          <div class="panel-body ">
        
            <form class="form-horizontal form "  id="frm_Pro">
    
                  <div class="form-row">
                        <div class="col-md-6">
                        <br>
                            <label>Datos del promocion </label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-building "></i></div>
                                <select name = "cmbTipo_Promocion3" id ="cmbTipo_Promocion3" class ="form-control " > </select> 
                                  
                            </div>
                          </div>
                          <div class="col-md-6">
                          <br>
                          <label>promocion </label>
                            <br>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-building "></i></div>
                                <select name = "selectPromocion" id ="selectPromocion" class ="form-control " > </select> 
                                  
                            </div>
                           
                      
                        </div>
                          
                          <div class="col-md-6">
                          <br>
                           
                            <br>
                            <label>Datos de la producto </label>
                            
                            <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar" ></i></div>
                            <select name = "cmbTipo_Producto" id = "cmbTipo_Producto" class ="form-control pull-right " > </select> 
                            </div>
                            <br>
                            <label>Cantidad</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar" ></i></div>
                                <input  type="number" class="form-control pull-right " id="cantidad_id">
                            </div>
                         </div>  
    
                       
                        
                  </div>
            </form>
            <br>
					<div class="col-md-12 ">
								<br>
								<br>
                          
                                <br>
                                <br>
                                <div class="table-responsive">
          
                                      <table class="display" id="tablakit">
                                        <thead> <!-- style="border: 1px solid #000000" -->
                                          <tr>
                                  
                                          </tr>
                                        </thead>
                                        <tbody id="tabla_kits">



                                          </tbody>
                                      </table>
                                </div>   
                             
                
                    </div>
                         		
           
          </div>    
          <div class="modal-footer">
                
                <button type="button" class="btn btn-primary btn-sm" onclick="ingresarKit()">AGREGAR</button>
       </div>           
 </div>
         

     