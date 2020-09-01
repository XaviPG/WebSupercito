<!-- z_modal.blade.php -->
<!-- Large modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".frmProductos_img_modal">Large modal</button> -->

<div class="modal fade frmProductos_img_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
  
        <div id="header"class=" modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Modificar Imagen de Producto</h4>
        </div>
  
            <form class="" id="frmProductos_img_modificar" class="needs-validation" enctype="multipart/form-data"> 


                <div class="modal-body">
    
                    
                    <div class="container">
                        <input name="id_foraneo" type="hidden" id="id_foraneo">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input name="file_producto_img" type="file" class="custom-file-input" id="file_producto_img" aria-describedby="inputGroupFileAddon01">
                                <br><!-- <label id="file_producto_img_label" class="custom-file-label" for="file_producto_img">Subir una imagen</label> -->
                            </div>
                        </div>
                            <br>
                        <div class="row" id="tabla_infor_producto_img" >
                        
                            <iframe id="iframe_producto_img"    width="75%" height="350px" frameborder="0">
                            <img src="/img/supercito.jpg" class="img-fluid" alt="Responsive image"></iframe>
                        
                        </div>
                    </div>
                </div>
    

                <div class="form-group row">
			         <div class="col-sm-12">
			         <input type="submit" class="form-control form-control-sm color-principal" id="btnGuardarImagenProducto" style="color: white" value="Enviar">
			        </div>
			    </div>
                
            </form>

        </div>
    </div>
</div>
  