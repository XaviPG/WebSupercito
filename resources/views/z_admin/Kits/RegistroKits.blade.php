
<div id="cardregistrokit" class="card" class="col-md-9">

<div class="panel panel-default">
 <div class="panel-heading main-color-bg">
   <h3 class="panel-title">Kits</h3>
 </div>
 <div class="panel-body ">
 <form class="form-horizontal form "  id="frm_Pro">
                  <div class="form-row">
                        <div class="col-md-6">
                            <label>Tipo de promoción </label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-building "></i></div>
                                <select name = "cmbTipo_Promocion3" id ="cmbTipo_Promocion3" class ="form-control " > </select> 
                                  
                            </div>
                            <br>
                            <label>Datos del producto </label>
                            
                            <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar" ></i></div>
                            <select name = "cmbTipo_Producto" id = "cmbTipo_Producto" class ="form-control pull-right " > </select> 
                            </div>
                            <!-- <br>
                            <label >Stock</label>
                            <div class="input-group">
                                    <div class="input-group-addon"> <i class="fa fa-briefcase "></i> </div>
                                    <input readonly   class="form-control pull-right "  type="text"  id="IDcantidad">
                            </div> -->

                        </div>  
                      
                        <div class="col-md-6">
                             <label>Promoción</label>
                              <br>
                              <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-building "></i></div>
                                <select name = "selectPromocion" id ="selectPromocion" class ="form-control " > </select> 
                                  
                             </div>
                            <br>
                            <label>Cantidad</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar" ></i></div>
                                <input  type="number" class="form-control pull-right " id="cantidad_id">
                            </div>
                            <br>
                            <!-- <label >Cantidad</label>
                            <div class="input-group">
                                   <div class="input-group-addon"><i class="fa fa-sort-amount-asc "></i></div>
                                   <input  type="number" class="form-control pull-right" id="IDcantidad1" min="">
                                    
                                   </div> -->
                        </div>
                       

            
                  <!-- </div>
               
          </div> -->
                  <!-- <div class="form-group row">
                  <div class="col-sm-12">
			                <input type="button" class="form-control form-control-sm color-principal" onclick="ingresarCantidaDescuento()" style="color: white" value="AGREGAR">
			            </div>   -->
                   
            </form>
            
            <!-- <form class="form-horizontal form "  id="frm_Pro">
    
                  <div class="form-row">
                        <div class="col-md-6">
                        <br>
                            <label>Tipo de promoción </label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-building "></i></div>
                                <select name = "cmbTipo_Promocion3" id ="cmbTipo_Promocion3" class ="form-control " > </select> 
                                  
                            </div>
                          </div>
                          <div class="col-md-6">
                          <br>
                          <label>Promoción</label>
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
            </form> -->
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
         
 </div>
 </div>
     