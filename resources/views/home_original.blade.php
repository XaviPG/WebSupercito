@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @include('z_admin.z_menu')

        <!-- <div id="ops"> -->
        <div class="col-md-10">
            <div id="op">
                @include('z_admin.TipoUsuarios.frm')
                @include('z_admin.Usuarios.frm')
                @include('z_admin.Productos.frm')
                @include('z_admin.Pedidos.frm')
                @include('z_admin.Promociones.Frm')
                @include('z_admin.Promociones.registroPromocion')
                @include('z_admin.PromocioneDelProducto.registro')
                
                @include('z_admin.Ventas.frm')
                @include('z_admin.Reportes.frm')
                @include('z_admin.TipoPromocion.registroTipo')
               
                @include('z_admin.kits.RegistroKits')
            
            </div>

            <div id="fondo" style="height: 100%" class="card">
                <div class="card-body">
                    <picture>
                        <img class="img-fluid" style="width: 100%" src="{{asset('/img/fondo3.jpg')}}">
                    </picture>
                </div>
            </div>

        </div>
        <!-- </div> -->
    </div>
</div>

@endsection
@section('scripts')
    <script src="{{ asset('js/jsPDF/dist/jspdf.min.js') }}" defer></script>

    <script src="{{ asset('js/GestionTipoUsuarios.js') }}" defer></script>
    <script src="{{ asset('js/GestionUsuarios.js') }}" defer></script>
    <script src="{{ asset('js/GestionPedidos.js') }}" defer></script>
    <script src="{{ asset('js/GestionVentas.js') }}" defer></script>
    <script src="{{ asset('js/GestionProductosJSON.js') }}" defer></script>
    <script src="{{ asset('js/GestionProductos.js') }}" defer></script>
    <script src="{{ asset('js/GestionReportes.js') }}" defer></script>
    <script src="{{ asset('js/GestionPromocion.js') }}" defer></script>
    <script src="{{ asset('js/GestionKits.js')}}" defer></script>
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
