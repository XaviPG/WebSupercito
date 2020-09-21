@extends('layouts.app')

@section('content')

<header id="header">
    <div class="container">
      
       
          <h4 style="text-align: center"><span class="glyphicon glyphicon-cog "  aria-hidden="true"></span> Administración web de Supercito </h4>
       
        
   
    </div>
  </header>

  <div id="op">
   
    {{-- @include('z_admin.Usuarios.frm')
    @include('z_admin.Productos.frm')

    @include('z_admin.Pedidos.frm')
    @include('z_admin.Ventas.frm')
    @include('z_admin.Promociones.registroPromocion')
    @include('z_admin.TipoPromocion.registroTipo')
    @include('z_admin.TipoPromocion.ModificarTipo')
    @include('z_admin.PromocioneDelProducto.registro')
    @include('z_admin.kits.RegistroKits')
 
    @include('z_admin.Reportes.frm') --}}
</div>
<section id="breadcrumb">

  <div class="container">
    <ol class="breadcrumb">


      <li id="menuPanel" class="active" >Panel de Control</li>
    </ol>
  </div>
</section>

  <section id="main">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="list-group">
          <br>

            <a class="list-group-item active color-principal">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Panel de Control
            </a>
            <a style="cursor:pointer;" id="btnVerFrmTipoUsuarios"  class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Roles de Usuario <span id="spanCountTipo" class="badge">..</span></a>
            <a style="cursor:pointer;" id="btnVerFrmUsuarios" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Usuarios <span id="spanCountUser" class="badge">..</span></a>
            <a style="cursor:pointer;" id="btnVerFrmProductos"  class="list-group-item"><span class="glyphicon glyphicon-apple" aria-hidden="true"></span> Productos <span id="spanCountProducto" class="badge">..</span></a>
            <a style="cursor:pointer;" id="btnVerFrmPedidos" class="list-group-item"><span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span> Ordenes <span  id="spanCountOrden"  class="badge">..</span></a>
            <a style="cursor:pointer;" id="btnVerFrmVentas"  class="list-group-item"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Ventas <span id="spanCountVenta" class="badge">..</span></a>
            <a style="cursor:pointer;" id="btnVerFrmPromocion" class="list-group-item"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span> Promociones <span id="spanCountPromocion" class="badge">..</span></a>
            <a style="cursor:pointer;" id="btnVerFrmkits" class="list-group-item"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Kits<span id="spanCountKit" class="badge">..</span></a>
            <a style="cursor:pointer;" id="btnVerFrmUbicacion"  class="list-group-item"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Ubicación </a>
            <a style="cursor:pointer;" id="btnVerFrmReportes" class="list-group-item"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> Reportes </a>
          </div>
          
          {{-- <div class="well">
            <h4>Espacio en disco</h4>
            <div class="progress">
                <div class="barra-progreso" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 40%;">
                    40%
            </div>
          </div>
          <h4>Ancho de banda </h4>
          <div class="progress">
              <div class="barra-progreso" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
                  75%
          </div>
        </div>
          </div> --}}
        </div>
        <div class="col-md-9">
          <!-- Vista rápida del sitio -->
          <br>
      
            <div id="fondo" style="height: 100%" class="card">
                
            <div class="card-body">

                
                {{-- 
                
                @include('z_admin.Pedidos.frm')
                @include('z_admin.Ventas.frm')
                @include('z_admin.Reportes.frm') 
                @include('z_admin.Promociones.modalDuplicado')
                @include('z_admin.kits.RegistroKits')
          
                --}}

                <picture>
                    <img class="img-fluid" style="width: 100%" src="{{asset('img/supercito.jpg')}}">
                </picture>
            </div>
           
          </div>
           
                    @include('z_admin.TipoUsuarios.frm')
                    @include('z_admin.Usuarios.frm')
                    @include('z_admin.Productos.frm')
                    @include('z_admin.Pedidos.frm')
                    @include('z_admin.Ventas.frm')
                    @include('z_admin.Promociones.tablaPromociones')    
                    @include('z_admin.Promociones.registroPromocion')
                    @include('z_admin.TipoPromocion.registroTipo')
                    @include('z_admin.PromocioneDelProducto.registro')
                   
                    @include('z_admin.Kits.RegistroKits')
                    @include('z_admin.Ubicacion.frm')
                    @include('z_admin.Reportes.frm')

                
                    
            {{-- <div class="panel-heading main-color-bg">
              <h3 class="panel-title">Vista Rápida</h3>
            </div>
            <div class="panel-body">
              <div class="col-md-3">
                <div class="well dash-box">
                  <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 508</h2>
                  <h4>Usuarios</h4>
                </div>
              </div>
              <div class="col-md-3">
                <div class="well dash-box">
                  <h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 17</h2>
                  <h4>Paginas</h4>
                </div>
              </div>
              <div class="col-md-3">
                <div class="well dash-box">
                  <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 33</h2>
                  <h4>Entradas</h4>
                </div>
              </div>
              <div class="col-md-3">
                <div class="well dash-box">
                  <h2><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> 15,336</h2>
                  <h4>Visitantes</h4>
                </div>
              </div>
            </div> --}}
            </div>

            <!-- últimos usuarios -->
            <div class="panel panel-default">
              {{-- <div class="panel-heading">
                <h3 class="panel-title">Últimos usuarios</h3>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-hover">
                    <tr>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Registrado</th>
                    </tr>
                    <tr>
                      <td>Juan Lopez</td>
                      <td>juancho4582@gmail.com</td>
                      <td>Dic 17, 2012</td>
                    </tr>
                    <tr>
                      <td>Martha Solis</td>
                      <td>mart789ha@yahoo.es</td>
                      <td>Dic 17, 2012</td>
                    </tr>
                    <tr>
                      <td>John Doe</td>
                      <td>jdoe@gmail.com</td>
                      <td>Dic 17, 2012</td>
                    </tr>
                    <tr>
                      <td>Mauricio Osorio</td>
                      <td>mauosoro@yahoo.com</td>
                      <td>Dic 17, 2012</td>
                    </tr>
                    <tr>
                      <td>Mike Mayer</td>
                      <td>mjohn88@gmail.com</td>
                      <td>Dic 17, 2012</td>
                    </tr>
                  </table>
              </div> --}}
            </div>
        
      </div>
    </div>
  </section>

{{-- <div class="container">
    <div class="row justify-content-center">

        @include('z_admin.z_menu')

        
        <div class="col-md-10">
            <div id="op">
                @include('z_admin.TipoUsuarios.frm')
                @include('z_admin.Usuarios.frm')
                @include('z_admin.Productos.frm')
               
                @include('z_admin.Promociones.Frm')
             
                @include('z_admin.Promociones.tablaPromociones')
                @include('z_admin.Promociones.registroPromocion')
                @include('z_admin.PromocioneDelProducto.registro')
            
                @include('z_admin.Pedidos.frm')
                @include('z_admin.Ventas.frm')
                @include('z_admin.TipoPromocion.registroTipo')
                @include('z_admin.kits.RegistroKits')
                
                @include('z_admin.Reportes.frm')
            </div>

            <div id="fondo" style="height: 100%" class="card">
                <div class="card-body">
                    <picture>
                        <img class="img-fluid" style="width: 100%" src="{{asset('/img/fondo3.jpg')}}">
                    </picture>
                </div>
            </div>

        </div>
       
    </div>
</div> --}}

@endsection
@section('scripts')
    <script src="{{ asset('js/jsPDF/dist/jspdf.min.js') }}" defer></script>

    <script src="{{ asset('js/GestionTipoUsuarios.js') }}" defer></script>
    <script src="{{ asset('js/GestionUsuarios.js') }}" defer></script>
    <script src="{{ asset('js/GestionPedidos.js') }}" defer></script>
    <script src="{{ asset('js/GestionVentas.js') }}" defer></script>
    {{-- <script src="{{ asset('js/GestionProductosJSON.js') }}" defer></script> --}}
    <script src="{{ asset('js/GestionProducto.js') }}" defer></script>
    <script src="{{ asset('js/GestionReportes.js') }}" defer></script>
    <script src="{{ asset('js/GestionPromocion.js')}}" defer></script>
    <script src="{{ asset('js/GestionKits.js')}}" defer></script>
    {{-- <script src="{{ asset('js/GestionOrden.js')}}" defer></script> --}}
    <!-- <script src="{{ asset('js/GestionUbicacion.js')}}" defer></script> -->

    <script>
        function printDiv(nombreDiv) {
            var contenido= document.getElementById(nombreDiv).innerHTML;
            var contenidoOriginal= document.body.innerHTML;

            document.body.innerHTML = contenido;

            window.print();

            document.body.innerHTML = contenidoOriginal;
        }
    </script>
@endsection
