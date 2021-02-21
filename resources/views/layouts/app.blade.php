<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Supercito</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/sweetalert.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}" defer></script>
    <script src="{{ asset('js/jQuery.print/jQuery.print.js') }}" defer></script>
    <script src="{{ asset('plantilla/js/bootstrap.min.js') }}" defer></script>

    <script src="{{ asset('js/select2.min.js') }}" defer></script>
    {{-- <script src="{{ asset('js/bootstrap-toggle.js') }}" defer></script> --}}
    {{-- <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('plantilla/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plantilla/css/estilos.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-toggle.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/w3school-toggle.css') }}" rel="stylesheet">

    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <script type="text/javascript">
      var servidor="http://young-woodland-01238.herokuapp.com";
      function iniciarMap() {
        console.log('mapa');
        var coord = {lat: -0.8457982, lng:-80.163039};
        map = new google.maps.Map(document.getElementById('map'), {
          center: coord,
          zoom: 16,
        });

        var marker = new google.maps.Marker({
          position: coord,
          map: map,
          title: 'SUPERCITO',
          draggable: true,
          animation: google.maps.Animation.DROP,
        });
        // $.get(`${servidor}/v0/consultar_ubicacion_courier`, function(data, status){
        //   // alert("Data: " + data + "\nStatus: " + status);
        //   console.log(data);
        // });
        // var request = new Request(servidor+'/v0/consultar_ubicacion_courier');
        // fetch(request).then(function(response) {
        //   console.log(response);
        //   // return response.text();
        // }).then(function(text) {
        //   console.log(text.substring(0, 30));
        // });



      }



    </script>

    <script type="text/javascript">

        function initialize() {


            // var latlng = new google.maps.LatLng(-0.8518257,-80.1605608);
            // var marker1 = new google.maps.Marker({
            //   position: latlng,
            //   map: map,
            //   title: 'SUPERCITO',
            //   draggable: true,
            //   animation: google.maps.Animation.DROP,
            // });

          var FrmData=
          {
            value: '',
          }


          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
          });
          lista = [];
          $.ajax({
              url: '/api/v0/consultar_ubicacion_courier',// Url que se envia para la solicitud esta en el web php es la ruta
              method: "GET",             // Tipo de solicitud que se enviará, llamado como método
              data: null,               // Datos enviados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
              success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
              {
                  //console.log(data);
                  if (data.code == '500') {

                  }else if (data.code == '200') {

                    var latlng = new google.maps.LatLng(-0.8457982,-80.163039);
                    var myOptions = {
                        zoom: 16,
                        center: latlng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    var map = new google.maps.Map(document.getElementById("map"),myOptions);

                    var marker = new google.maps.Marker({
                      position: latlng,
                      map: map,
                      title: 'SUPERCITO',
                      label: 'SUPERCITO',
                      draggable: true,
                      animation: google.maps.Animation.DROP,
                    });

                    map.addListener('click', function(e) {
                      console.log('hover');
                      loadScript();
                    });

                    console.log('code 200:',data.items);
                    for (let index = 0; index < data.items.length; index++) {
                      const item = data.items[index];
                      if (item.ubicacion[0]) {
                        
                        var _lat = Number.parseFloat( item.ubicacion[item.ubicacion.length-1].latitud);
                        var _lng = Number.parseFloat( item.ubicacion[item.ubicacion.length-1].longitud);
                        lista.push({lat:_lat,lng:_lng});

                        console.log('lat',_lat);

                        console.log("lista", lista);
                        var coords =  { lat: _lat , lng: _lng  };
                        var marker = new google.maps.Marker({
                          position: coords,
                          map: map,
                          title: `${item.name}`,
                          draggable: true,
                          animation: google.maps.Animation.DROP,
                          icon: {
                            url: "http://maps.google.com/mapfiles/ms/icons/yellow.png"
                          }
                        }); 
                      } else {
                        
                      }
                    }
                    // $.each(data.items, function(a, item) { // recorremos cada uno de los datos que retorna el objero json n valores
                    //   // var coords =  new google.maps.LatLng(-0.8518257,-80.1605608);
                    //   // debugger
                      
                    //   // var _lat = Number.parseFloat( item.ubicacion[0].latitud);
                    //   // var _lng = Number.parseFloat( item.ubicacion[0].longitud);
                    //   // try {
                    //     // debugger

                    //     // var _lat =-0.8457982;
                    //     // var _lng = -80.163039;

                    //     var _lat = Number.parseFloat( item.ubicacion[0].latitud);
                    //     var _lng = Number.parseFloat( item.ubicacion[0].longitud);
                    //     lista.push({lat:_lat,lng:_lng});

                    //     console.log('lat',_lat);

                    //     console.log("lista", lista);
                    //     var coords =  { lat: _lat , lng: _lng  };
                    //     // // debugger
                    //     // // var coords = { lat: parseFloat( item.ubicacion[0].latitud), lng: parseFloat( item.ubicacion[0].longitud)};
                    //     // // coords.lat = parseFloat( item.ubicacion[0].latitud);
                    //     // // coords.lng = parseFloat( item.ubicacion[0].longitud);
                    //     //
                    //     var marker = new google.maps.Marker({
                    //       position: coords,
                    //       map: map,
                    //       title: `${item.name}`,
                    //       draggable: true,
                    //       animation: google.maps.Animation.DROP,
                    //     });  
                    //   // } catch (error) {
                        
                    //   // }
                      
                    // });
                  }
              },
              error: function (err) {
                  console.log(err);
                  mensaje = "OCURRIO UN ERROR: Archivo->app , funcion->initialize()";
                  swal(mensaje);
              }
          });


          for (var i = 0; i < lista.length; i++) {
            lista[i];
            var marker = new google.maps.Marker({
              position: { lat: lista[0].lat, lng: lista[0].lng },
              map: map,
              title: `${item.name}`,
              draggable: true,
              animation: google.maps.Animation.DROP,
            });
          }

        }
        var myKey = "AIzaSyDaFgXu36yCuXiG01kIc4_BO3P_oYuXEAw";
        function loadScript() {
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = "https://maps.googleapis.com/maps/api/js?key=" + myKey + "&sensor=false&callback=initialize";
            document.body.appendChild(script);
        }
    </script>

    {{-- <style media="screen">
      .botones{
        background: #b9007f;
        color: #fff;
      }
      .botones:hover{
        background: #974398;
        color: #fff;
      }
      .barra{
        background:#b9007f;
        color: #fff;
      }
    </style> --}}

    <style>
    #map {
    	height: 500px;
    	width: 100%;
    }

    </style>

</head>
<!--  -->
<body onload="loadScript()">
    @guest
        <!-- no esta logueado -->
        <input type="hidden" name="" id="nome_token">
    @else
        <input type="hidden" name="" id="nome_token_user" value="{{Auth::user()->nome_token}}">
    @endguest

    <div id="app">
        <nav class="navbar navbar-default ">


                @guest


                   @else

                   
                   <div class="container">
                   {{-- <div id="navbar-expand-md navbar-light bg-primary shadow-sm" class="collapse navbar-collapse"> --}}
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>

                    </div>

                    <div id="navbar" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                          <li ><a class="fa fa-home" aria-hidden="true" href="{{ route('home') }}"> Home</a></li>
                          {{-- <li><a href="entradas.html">Roles</a></li>
                          <li><a href="entradas.html">Usuarios</a></li>
                          <li><a href="usuarios.html">Productos</a></li>
                          <li><a href="usuarios.html">Productos</a></li>
                          --}}
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class=" nav-item nav navbar-nav navbar-right">
                                <a  class="fa fa-user-o" id="navbarDropdown" class="nav-link  text-white"  aria-expanded="false" v-pre>
                                    <i aria-hidden="true"> Bienvenid@: {{ Auth::user()->name }} </i>
                                   
                                </a>

                             </li>

                             <li>
                                    <a class="fa fa-window-close-o" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ 'Salir' }}
                                    </a>
                            </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                        </ul>
                      </div>


                  {{-- </div><!--/.nav-collapse --> --}}
              </div>
                 @endguest
          </div>

       </div>
    </nav>
  <section id="main">
    <main class="py-4">
       @yield('content')
    </main>

    @yield('scripts')
  </section>
                              <br><br><br>
<footer id="footer">
  <p>Copyright Supercito &copy; 2020</p>
</footer>
    <script src="{{ asset('js/adminSistema.js') }}" defer></script>
{{-- <script src="{{ asset('plantilla/js/bootstrap.min.js') }}" defer></script> --}}
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDaFgXu36yCuXiG01kIc4_BO3P_oYuXEAw&callback=iniciarMap"></script> -->
</body>

</html>
