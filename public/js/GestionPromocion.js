var servidor="http://young-woodland-01238.herokuapp.com";
// var servidor="http://127.0.0.1:8000";
  //////////////////////////////////////////////////////////////////////////////////////////////////////
  /////////////////////////////////////DATOS PROMOCIÓN//////////////////////////////////////////////////
  //////////////////////////////////////////////////////////////////////////////////////////////////////
  //var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  $( document ).ready(function() {

    contar_Promocion();
    
  });

  function contar_Promocion(){
 

    $.ajax({
      url:servidor+ '/api/v0/contarPromocion',// Url que se envia para la solicitud esta en el web php es la ruta
      method: "GET",             // Tipo de solicitud que se enviará, llamado como método
      // data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
      success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
      {
  
        // console.log(data);
        $('#spanCountPromocion').html(data);
      },
      error: function () {
          mensaje = "error";
          swal(mensaje);
      }
    });
  
  }

  $("#cmbTipoPromocion").select2({
    placeholder: "Seleccióne el tipo de promociónes",
    allowClear: true,
    language: {
 
      noResults: function() {
  
        return "No hay resultado";        
      },
      searching: function() {
  
        return "Buscando..";
      }
    },
    ajax: {
      url: servidor +'/api/v0/tipo_promociones_Buscar/'+ $('#nome_token_user').val(),
      data: function(params) {
        return {
            term: params.term
        }
      },
      processResults: function (data) {
        // Transforms the top-level key of the response object from 'items' to 'results'
        return {
          results: data.items
        };
      }
    }
  });

  ////////////////////////////////////////LIMPIAR //////////////////////////////////////////////
 
  function limpiarregistro() {
  $('input[type="text"]').val(null);
  $('input[type="number"]').val(null);
  $('input[type="date"]').val(null);
  
  }

  //////////////////////////////////REGISTRO PROMOCION/////////////////////////////////////////////////////
  function ingresarRegistroPromocion(){ 
      if(($('#ID_Nombre').val()) == ""){
        swal({
          title: 'ERROR',
          text: "Campo  Nombre Vacia",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        }) 
      }else if(parseInt($('#ID_DESCUENTOS').val()) == ""){
        swal({
          title: 'ERROR',
          text: "Campo  descuento Vacia",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
      }else if(parseInt($('#ID_DESCUENTOS').val())<=0){
        swal({
          title: 'ERROR',
          text: "No puede existir un  descuento igual o menor a cero",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
      }else if($('#ID_CANTIDAD').val().trim() == ""){
        swal({
          title: 'ERROR',
          text: "Campo cantidad Vacia",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
      }else if(parseInt($('#ID_CANTIDAD ').val())<=0){
        swal({
          title: 'ERROR',
          text: "No se puede colocar un cantidad menor o igual a cero",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
      }else if($('#FECHA_FINAL').val()<=$('#FECHA_INGRESO').val()){
        swal({
          title: 'ERROR',
          text: "No puede colocar una fecha menor menor o igual que la de inicio",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
      }else if($('#FECHA_INGRESO').val().trim() == ""){
        swal({
          title: 'ERROR',
          text: "Campo fecha inicio Vacia",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
      }else if($('#FECHA_FINAL').val().trim() == ""){
        swal({
          title: 'ERROR',
          text: "Campo fecha final Vacia",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
      }else
      {
        
      swal({
          title: 'Estas seguro de esto?',
          text: "Si aceptas, se creará un nuevo tipo de promoción!",
         
          icon: "warning",
          buttons: true,
          dangerMode: true,
      }).then((willDelete) =>{
        if (willDelete) {
          var FrmData = {
            idTipoPromocion:$('#cmbTipoPromocion').val(),
            descripcion:$('#ID_Nombre').val(),
            descuento:$('#ID_DESCUENTOS').val(),
            cantidad:$('#ID_CANTIDAD').val(),
            fecha_inicio:$('#FECHA_INGRESO').val(),
            fecha_fin:$('#FECHA_FINAL').val(), 
          }
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          
          $.ajax({
              url: servidor+''+'/api/v0/RegistroPromociones_store/'+FrmData, // Url que se envia para la solicitud esta en el web php es la ruta
              method: "POST",             // Tipo de solicitud que se enviará, llamado como método
              data: FrmData,               // Datos enviados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
              success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
              {
                cargar_tablaRegistro();
                limpiarregistro();
                if(data['code'] == "200"){
                  swal("ACCION EXITOSA!", "Datos Guardados", "success");
                }else{
                  swal("ERROR",data['message'], "success");
                }
              },
              
              error: function () {
                mensaje = "OCURRIO UN ERROR: Archivo->GestionProductodescuento.js";
                swal(mensaje);
        
            }
          });  
        } else {
          swal("Cancelado!");
       
        }
      });
     
    }
    

}
function cargar_tablaRegistro() {
    
      var FrmData=
      {
         
      }
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  
      $.ajax({
          url: servidor+'/api/v0/RegistroPromociones_filtro',// Url que se envia para la solicitud esta en el web php es la ruta
          method: "GET",             // Tipo de solicitud que se enviará, llamado como método
          data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
          success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
          {
          
            llenar_tabla_Registro(data);
          },
          error: function () {
              mensaje = "OCURRIO UN ERROR en la función cargar_tablaProductoPromo1() ";
                 swal(mensaje);
          }
      });
}
  
  function llenar_tabla_Registro(data) {

    var ancho = '16%';
    var anchos= '5%';
    $('#tablaRegistroPro').html('');
    $('#tablaREGISTRO').html('');
  
    $('#tablaRegistroPro').DataTable({
       destroy: true,
      order: [],
      data: data.items,
        'createdRow': function (row, data, dataIndex) {
          //console.log(data);
        },
        'columnDefs': [
            {
               'targets':5,
               'data':'item.id_item',
               'createdCell':  function (td, cellData, rowData, row, col) {
  
               },
            }
         ],
        columns: [
           {
                width:anchos,
                data: null,
                render: function (data, type, row) {
                  var html='';
                  if(data.estado_del>0)
                  {
                       var html = `<i class="fa fa-circle" ></i>`;
                  }else
                  {
                       html = ` `;
                  }
                       return `${html}`;
                       
    
                }
                
            },
            {
                title: 'Tipo de promoción',
                width:ancho,
                data: 'tipo_promocion[0].descripcion'
            },
            {
              title: 'Promoción',
              width:ancho,
              data: 'descripcion'
          },
            {
                title: 'Descuento',
                width:ancho,
                data: 'descuento'
            },
            {
                title: 'Cantidad',
                width:ancho,
                data: 'cantidad'
            },
            {
              
              title: 'Fecha inicio',
              width:ancho,
              data:'fecha_inicio',
            },
      
            {
                title: 'Fecha fin',
                width:ancho,
                data: 'fecha_fin',
            },
            {
              title: 'ACCIONES',
              width:ancho,
              data: null,
              render: function (data, type, row) {
                var html='';
                if(data.publicado==null)
                {
                   html += `<button type="button" class="btn btn-sm btn-danger eliminarRegistro" value="${data.id}"><i class="fa fa-trash" aria-hidden="true"></i></button> `;
                }
                if(data.publicado==null && data.kits_count>0){
                  html += `<button  type="button" class="btn btn-sm btn-success modalpublicado1" style="margin: 10px" value="${data.id}"><i class="fa fa-bullhorn"></i></button>`;
                }
                     return `${html}`;
              }
           }
        ],
  
    });
  }

  $('body').on('click','.eliminarRegistro',function(){
    EliminarRegistro($(this).val());
    cargar_tablaRegistro();
    });
  
  function EliminarRegistro(id) {
    
      var FrmData=
      {
        id:id,
      }
    
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      swal({
        title: "Estas seguro de esto?",
        text: "Si aceptas, los datos seran eliminados!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) =>
       {
        if (willDelete) 
        {
    
          $.ajax({
            url: servidor+'/api/v0/RegistroPromociones_delete/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
            method: "DELETE",             // Tipo de solicitud que se enviará, llamado como método
            data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
            success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
            {
              swal("ACCION EXITOSA!", "Datos Eliminados", "success");
              cargar_tablaRegistro();
            
            },
            error: function (data) {
                mensaje = "OCURRIO UN ERROR: Archivo->GestionUsuarios.js , funcion->elimi()"
           
                swal(mensaje);
    
            }
          });
    
        } else {
          swal("Cancelado!");
        }
      });
    
    }

    $('body').on('click','.modalpublicado1',function(e){ 
     
      cargar_tablaPublicado($(this).val());
   
     });
     function cargar_tablaPublicado(idregi) {
    
      var FrmData=
      {
         id:idregi,
      }
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  
      $.ajax({
          url: servidor+'/api/v0/RegistroPromociones_publicidad/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
          method: "PUT",             // Tipo de solicitud que se enviará, llamado como método
          data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
          success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
          {
            if(data['code'] == "200"){
              cargar_tablaRegistro();
              swal("ACCION EXITOSA!", "Datos Guardados", "success");  
            }else{
              swal("ERROR!",data['items'], "success");  
            }
          
          },
          error: function () {
              mensaje = "OCURRIO UN ERROR en la función cargar_tablaProductoPromo1() ";
                 swal(mensaje);
          }
      });
}
  // ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  // ////////////////////////////////////DaATOS TIPO PROMOCIÓN///////////////////////////////////////////////////////
  // ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  $('#idmoda_REGISTRO').on('click',function(){
    cargar_tablaTipo('');
    limpiar();
 
    $('#Modal_TipoPro').modal('show');
  });
    
  function botonClose(){
    if($("#botonCerrar").val()=="close"){
      $("#boton").val("guardar");
        $("#boton").html("AGREGAR");
        $("#nombreCabecera").text("Ingreso tipo de promoción");
    }else{
      UpdateTipo();
    }
  }
  function validarEjecucion(){
      if($("#boton").val()=="guardar"){
        ingresarTipoPromocion();
      }else{
        UpdateTipo();
      }
    }
    function ingresarTipoPromocion(){ 
      swal({
        title: 'Estas seguro de esto?',
        text: "Si aceptas, se creará una nueva promocion al producto!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
     }).then((willDelete) =>{
      if (willDelete) {
        var FrmData = {
          descripcion: $('#frmTipodescripcion').val(),
        }
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
         });
        
        $.ajax({
            url: servidor+'/api/v0/tipo_promociones_store/'+$('#nome_token_user').val()+'/'+FrmData, // Url que se envia para la solicitud esta en el web php es la ruta
            method: "POST",             // Tipo de solicitud que se enviará, llamado como método
            data: FrmData,               // Datos enviados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
            success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
            {
              cargar_tablaTipo('') ;
              limpiar();
              
              swal("ACCION EXITOSA!", "Datos Guardados", "success");  
            },
            error: function () {
              mensaje = "OCURRIO UN ERROR: Archivo->GestionProducto.js";
              swal(mensaje);
          }
        });  
      } else {
        swal("Cancelado!");
      }
    });      
        return false;

}
function cargar_tablaTipo() {
    
  var FrmData=
  {
    
  }
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $.ajax({
      url: servidor+'/api/v0/tipo_ObtenerTipoRelacionado',// Url que se envia para la solicitud esta en el web php es la ruta
      method: "GET",             // Tipo de solicitud que se enviará, llamado como método
      data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
      success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
      {
        
        crear_tablaTipo(data);
      },
      error: function () {
          mensaje = "OCURRIO UN ERROR en la función cargar_tablaProductoPromo1() ";
             swal(mensaje);
      }
  });
}

function crear_tablaTipo(data) {
  var ancho = '16%';
  var anchos= '5%';
  $('#tablaTipoPromocion').html('');
  $('#tablaTIPO').html('');

  $('#tablaTipoPromocion').DataTable({
      destroy: true,
      order: [],
      data: data.items,
      'createdRow': function (row, data, dataIndex) {
          //console.log(data);
      },
      'columnDefs': [
          {
             'targets': 1,
             'data':'item.id_item',
             'createdCell':  function (td, cellData, rowData, row, col) {

             },
          }
       ],
      columns: [
        {
          width:anchos,
          data: null,
          render: function (data, type, row) {
            var html='';
            if(data.estado_del>0)
            {
                 var html = `<i class="fa fa-circle" ></i>`;
            }else
            {
                 html = ` `;
            }
                 return `${html}`;
                 

          }
          
      },
          {
              title: 'Descripción',
              width:ancho,
              data: 'descripcion'
          },
          {
              title: 'ACCIONES',
              width:ancho,
              data: null,
              render: function (data, type, row) {
                var html='';
                if(data.registro_count>0){
                  var html = `<button type="button" class="btn btn-sm btn-warning  abril_modaltipo" value="${data.nome_token} " data-toggle="modal" ><i class="fa fa-edit" aria-hidden="true"></i></button>`;
    
              }else
              {
              
              html = ` <button type="button" class="btn btn-sm btn-warning  abril_modaltipo" value="${data.nome_token} " data-toggle="modal" ><i class="fa fa-edit" aria-hidden="true"></i></button>
                    <button type="button" class="btn btn-sm btn-danger eliminartipoPromocion"value="${data.nome_token}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    `; 
              }
               
                return `${html}`;
                // return `<button>hola</button>`;

              }
          }
      ],

  });
}

var idtipo = '';
$('body').on('click','.abril_modaltipo',function(){ 
  $("#boton").val("modificar");
  idtipo='';
  idtipo=$(this).val();// este es el id del prodcuto que le va a servir al ingresar la pomocion del producto
  var informacion = new Array();
    i=0;
  $(this).parents("tr").find("td").each(function()
  {
    informacion[i]=$(this).html();
    i++;    
  })

   $('#frmTipodescripcion').val(informacion[1]);
   $("#nombreCabecera").text("Modificar Tipo Promoción");
   $("#boton").text("MODIFICAR");
 });

// Modificar tipo Promociones
function UpdateTipo(){ 
  swal({
    title: 'Estas seguro de esto?',
    text: "Si aceptas, los datos seran modificados!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
 }).then((willDelete) =>{
  if (willDelete) {
  var FrmData = {
    nome_token:idtipo ,
    descripcion: $('#frmTipodescripcion').val(),
      
   }
   console.log(FrmData);
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
   $.ajax({
    url: urlServidor+'/api/v0/tipo_promociones_update/'+$('#nome_token_user').val()+'/'+FrmData, // Url que se envia para la solicitud esta en el web php es la ruta
       method: "PUT",             // Tipo de solicitud que se enviará, llamado como método
       data: FrmData,               // Datos enviados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
       success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
       {
        $("#nombreCabecera").text("Ingreso tipo de promoción");
        $("#boton").val("guardar");
        $("#boton").html("AGREGAR");
        cargar_tablaTipo('');
        swal("ACCION EXITOSA!", "Datos Modificados", "success");
        limpiar();
       },
       error: function () {
         mensaje = "OCURRIO UN ERROR: Archivo->GestionProducto.js";
              swal(mensaje);
          }
        });  
      } else {
        swal("Cancelado!");
        $("#boton").val("guardar");
        $("#boton").html("AGREGAR");
      }
      });      
   return false; 
}
$('body').on('click','.eliminartipoPromocion',function(){
  cargar_tablaTipo('');
  EliminarTipoPromocion($(this).val());
  });

function EliminarTipoPromocion(nome_token) {
  
    var FrmData=
    {
      nome_token:nome_token,
    }
  
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    swal({
      title: "Estas seguro de esto?",
      text: "Si aceptas, los datos seran eliminados!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) =>
     {
      if (willDelete) 
      {
  
        $.ajax({
          url: servidor+'/api/v0/tipo_promociones_delete/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
          method: "DELETE",             // Tipo de solicitud que se enviará, llamado como método
          data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
          success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
          {
            swal("ACCION EXITOSA!", "Datos Eliminados", "success");
         cargar_tablaTipo('');
          
          },
          error: function (data) {
              mensaje = "OCURRIO UN ERROR: Archivo->GestionUsuarios.js , funcion->elimi()"
         
              swal(mensaje);
  
          }
        });
  
      } else {
        swal("Cancelado!");
      }
    });
  
  }
  