<div class="card" id="cardTipoUsuarios" class="col-md-9">
    <!-- Website Overview -->
    <div class="panel panel-default">
      <div class="panel-heading main-color-bg">
        <h3 class="panel-title">Roles</h3>
      </div>
      <div class="panel-body">
        {{-- <div class="row">
              <div class="col-md-12">
                  <input class="form-control" type="text" placeholder="Agregar nuevo rol">
              </div>
        </div> --}}

        <div class="card-body">
    
            <form id="frmTipoUsuarios" class="needs-validation">
    
              <div class="form-group row">
                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Descripción:</label>
                <div class="col-sm-7">
                  <input type="text" class="form-control form-control-sm limpiar" id="txt_descripcion_t_u" placeholder="col-form-label-sm" required>
                </div>
                <div class="col-sm-3">
                  <input type="submit" class="btn btn-default" id="btnGuardarTipoUsuario" value="Enviar" >
                </div>
              </div>
    
            </form>
        </div>
        <br>
        {{-- tabla --}}
        <div class="card-footer">
            @include('z_admin.TipoUsuarios.tabla')
            @include('z_admin.TipoUsuarios.z_modal')
        </div>

      </div>
      </div>

  </div>