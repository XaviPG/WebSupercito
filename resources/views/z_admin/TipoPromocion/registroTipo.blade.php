

<!-- Modal -->
<div class="modal fade" id="Modal_TipoPro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

    <div class="modal-body">
        <div class="row">
            
          <div class="col-lg-12">
            <div class="panel panel-default ">
                <div  class="panel-heading text-center " style="color: black;">
                <h3 id="nombreCabecera" class="panel-title"> Ingreso tipo de promoción</h3>
                 
                 </div>
              <div class="panel-body">
               <form class="form-horizontal" >
                      <div class="form-group">     
                        <div class="col-sm-12"> 
                            <label>Descripción</label>
                            <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-percent bigicon"></i></div>
                               <input type="text" class="form-control pull-right " id="frmTipodescripcion" name="Tipo_descripcion">
                              </div>
                        </div>
                                  
                            
                      </div> 
                    
                    </form>         
              </div>
            </div>
          </div> 
          
        <div class="col-lg-12">
        <div class="panel panel-danger ">
        <div class="panel-heading text-center " style="color: black;">
                 TIPO DE PROMOCIONES 
                 </div>
          <br>
          <br>
          
          <div class="table-responsive">
      
           <table class="display" id="tablaTipoPromocion">
              <thead> <!-- style="border: 1px solid #000000" -->
                <tr>
       
                </tr>
              </thead>
              <tbody id="tablaTIPO">

     

               </tbody>
            </table>
            </div>

          
          </div>
          </div>
        </div> 
       </div>  

     



       <div class="modal-footer">
        <button value="close" onclick=" botonClose();" id="botonCerrar" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button id="boton" value="guardar" type="button" class="btn btn-primary btn-sm" onclick="validarEjecucion()">AGREGAR</button>
       
     
     
      </div>
    </div>
  </div>
</div>


