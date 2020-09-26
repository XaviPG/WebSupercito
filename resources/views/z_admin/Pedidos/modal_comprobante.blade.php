<!-- z_modal.blade.php -->
<!-- Large modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".frmProductos_img_modal">Large modal</button> -->

<div class="modal fade modal_combrobante" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
  
        <div id="header"class=" modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Comprobante de la venta</h4>
        </div>
  
            <form class=""  class="needs-validation" enctype="multipart/form-data"> 


                <div class="modal-body">
    
                    
                    <div class="container">
                        
                            <br>
                        <div class="row"  >
                            <img id="prototipo" src="" alt="">
                            <iframe id="iframe_comprobante_img"    width="75%" height="350px" frameborder="0">
                            <img src="/img/supercito.jpg" class="img-fluid" alt="Responsive image"></iframe>
                        
                        </div>
                    </div>
                </div>
    

                <div class="form-group row">
			         <!-- <div class="col-sm-12">
			         <input type="submit" class="form-control form-control-sm color-principal" id="btnGuardarImagenProducto" style="color: white" value="Enviar">
			        </div> -->
			    </div>
                
            </form>

        </div>
    </div>
</div>
  