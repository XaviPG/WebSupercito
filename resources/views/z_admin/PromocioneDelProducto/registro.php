<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modaiddescuentoCantidad" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-body">
              

        <div class=" modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <img class="himodal " src="img/papeleria.png">
        </div>
                      
                  

          <div class="panel-body">
          <br>
          <form class="form-horizontal form "  id="frmProduPromo">
                  <div class="form-row">
                        <div class="col-md-6">
                            <label>Producto</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-building "></i></div>
                                <input readonly type="text" class="form-control " id="id_Procu_DE">
                            </div>
                            <br>
                            <label>Fecha inicio de la promoción</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar" ></i></div>
                                <input  type="date" class="form-control pull-right " id="IDfechaI">
                            </div>
                            <br>
                            <label >Stock</label>
                            <div class="input-group">
                                    <div class="input-group-addon"> <i class="fa fa-briefcase "></i> </div>
                                    <input readonly   class="form-control pull-right "  type="text"  id="IDcantidad">
                            </div>

                        </div>  
                      
                        <div class="col-md-6">
                             <label>Descuento</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-percent "></i></div>
                                <input  type="number" class="form-control pull-right " id="IDdescuento">
                            </div>
                            <br>
                            <label>Fecha fin de la promoción</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar" ></i></div>
                                <input  type="date" class="form-control pull-right " id="IDfechaFN">
                            </div>
                            <br>
                            <label >Cantidad</label>
                            <div class="input-group">
                                   <div class="input-group-addon"><i class="fa fa-sort-amount-asc "></i></div>
                                   <input  type="number" class="form-control pull-right" id="IDcantidad1" min="">
                                    
                                   </div>
                        </div>
                       

            
                  </div>
               
          </div>
                  <div class="form-group row">
                  <div class="col-sm-12">
			                <input type="button" class="form-control form-control-sm color-principal" onclick="ingresarCantidaDescuento()" style="color: white" value="AGREGAR">
			            </div>  
                   
            </form>
            
            <div class="col-md-12 ">
            
            <br>
                              <div class="panel panel-danger ">
                                <br>
                                <br>
                                <div class="table-responsive">
          
                                      <table class="display" id="tablaDescuentoCantidad">
                                        <thead> <!-- style="border: 1px solid #000000" -->
                                          <tr>
                                  
                                          </tr>
                                        </thead>
                                        <tbody id="tablaDescuentoCant">



                                          </tbody>
                                      </table>
                                </div>   
                              </div>   
                            </div>
          



           </div>    
       </div>

       <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-sm" onclick="ingresarCantidaDescuento()">AGREGAR</button>
       </div> -->


    </div>
  </div>
</div>
