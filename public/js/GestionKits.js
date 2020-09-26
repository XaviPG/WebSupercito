var servidor="http://127.0.0.1:8000";

$( document ).ready(function() {

  contar_Kit();
  
});
$("#cmbTipo_Promocion3").select2({
  placeholder: "Seleccione el tipo de promoción",
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
    url: servidor+'/api/v0/tipo_promociones_Buscar/'+ $('#nome_token_user').val(),
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
}).on("change", function (e) {
  $("#selectPromocion").empty().trigger('change')
  comoboRegistro($(this).val());
});
function comoboRegistro(idTipopromocion){
  $("#selectPromocion").select2({
    placeholder: "Seleccione la promoción",
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
      url: servidor+'/api/v0/RegistroPromociones_buscar',
      data: function(params) {
        return {
            term: params.term,
            idTipoPromocion : idTipopromocion
        }
      },
      processResults: function (data) {
        // Transforms the top-level key of the response object from 'items' to 'results'
        return {
          results: data.items
        };
      }
    }
  }).on("change", function (e) {
    //aqui tiene que ir el codigo donde se limpia la tabla una ves que se elimine la tabla si ejecuta la funcion que esta aqui abajo
    cargar_tablakit($(this).val());
  });
}
$("#cmbTipo_Producto").select2({
  placeholder: "Seleccione el producto",
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
    url: servidor+'/api/v0/productos_Buscar/'+ $('#nome_token_user').val(),
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

function ingresarKit(){ 
  swal({
    title: 'Estas seguro de esto?',
    text: "Si aceptas, se creará una nueva kit!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
 }).then((willDelete) =>{
  if (willDelete) {
    var FrmData = {
      idRegistro : $('#selectPromocion').val(),
      idProducto: $('#cmbTipo_Producto').val(),
      cantidad : $('#cantidad_id').val(),
    }
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
     });
    
    $.ajax({
        url: servidor+'/api/v0/kit_store/'+FrmData, // Url que se envia para la solicitud esta en el web php es la ruta
        method: "POST",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
          if(data['code'] == "200"){
            cargar_tablakit(data.items);
            limpiar() ;
            swal("ACCION EXITOSA!", "Datos Guardados", "success");  
          }else{
            swal("ERROR!",data['message'], "success");  
          }
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
function cargar_tablakit(id) {
    
  var FrmData=
  {
    idRegistro:id,
  }
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $.ajax({
      url: servidor+'/api/v0/kit_filtro/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
      method: "GET",             // Tipo de solicitud que se enviará, llamado como método
      data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
      success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
      {
        llenar_tabla_kit(data);
      },
      error: function () {
          mensaje = "OCURRIO UN ERROR en la función cargar_tablaProductoPromo1() ";
             swal(mensaje);
      }
  });
}

function llenar_tabla_kit(data) {

var ancho = '16%';
var anchos= '5%';
$('#tablakit').html('');
$('#tabla_kits').html('');

$('#tablakit').DataTable({
   destroy: true,
  order: [],
  data: data.items,
    'createdRow': function (row, data, dataIndex) {
    },
    'columnDefs': [
        {
           'targets':2,
           'data':'item.id_item',
           'createdCell':  function (td, cellData, rowData, row, col) {

           },
        }
     ],
    columns: [
       
        {
            title: 'Producto',
            width:ancho,
            data: 'producto_kit2.NAME'
        },
        {
            title: 'Cantidad',
            width:ancho,
            data: null,
            render: function (data, type, row) {
            var html=''; 
                 html = `<input class="tablabuton modificarCantidad" type="number" id="${data.id}" value="${data.cantidad}" readonly></input>`;
                 return `${html}`;
            }
        },
        {
          title: 'ACCIONES',
          width:ancho,
          data: null,
          render: function (data, type, row) {
            var html='';
           
                 html = `<button type="button" class="btn btn-sm btn-danger eliminarKit"  value="${data.id}"><i class="fa fa-trash" aria-hidden="true"></i></button>`;
                 html += `<button type="button" class="btn btn-sm btn-warning modificarKit" value="${data.id}" id="${data.id}Edit"><i class="fa fa-edit" aria-hidden="true"></i></button>`;
                 html += `<button style=" display:none " type="button" class="btn btn-sm btn-warning update" value="${data.id}" id="${data.id}Save"><i class="fa fa-save" aria-hidden="true"></i></button>`;
                 html += `<button style="display:none" type="button" class="btn btn-sm btn-success Close" id="${data.id}Close"><i class="fa fa-times" aria-hidden="true"></i></button>`;
                 return `${html}`;
          }
       }
    ],

});
}
$('body').on('click','.Close',function(e){
  $(".modificarKit").show();
  $(".Close").hide();
  $(".update").hide();
  $(".modificarKit").attr('disabled',false);
  $(".modificarCantidad").attr('readonly',true);
});

$('body').on('click','.update',function(e){
  var nuevaCantidad = $("#"+$(this).val()).val();
  var id = $(this).val();
  var FrmData=
  {
    id: id,
    cantidad: nuevaCantidad,
  }

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  swal({
    title: "Estas seguro de esto?",
    text: "Si aceptas, los datos seran modificados!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {

      $.ajax({
        url: urlServidor+'/api/v0/kit_update/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "PUT",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
          
          cargar_tablakit($("#cmbTipo_Promocion3").val());
          if(data['code'] == "200"){
            $("#"+id).val(parseInt(data['items'].cantidad));
            swal("ACCION EXITOSA!", "Datos Modificados", "success");
            $(".modificarKit").show();
            $(".Close").hide();
            $(".update").hide();
            $(".modificarKit").attr('disabled',false);
            $(".modificarCantidad").attr('readonly',true);
          }else{
            $("#"+id).val(parseInt(CantidadInicial));
            swal("ERROR!",data['message'], "success");  
          }
          
        },
        error: function () {
            mensaje = "OCURRIO UN ERROR : en la funcion modificar catidad";
            swal(mensaje);

        }
      });

    } else {
      swal("Cancelado!");
    }
  });
});
var CantidadInicial=0;
$('body').on('click','.modificarKit',function(e){
  CantidadInicial=0;
  CantidadInicial = $("#"+$(this).val()).val();
  $("#"+$(this).val()+"Save").show();
  $("#"+$(this).val()+"Close").show();
  $(this).hide();
  $(".modificarCantidad").attr('readonly',true);
  $(".modificarKit").attr('disabled',true);
  $(this).attr('disabled',false);
  $("#"+$(this).val()).removeAttr('readonly');
  $("#"+$(this).val()).focus();
});

function limpiar() {
  $('input[type="select2"]').val(null);
  $('input[type="number"]').val(null);
 
  
  }
  $('body').on('click','.eliminarKit',function(){
    Eliminarkit($(this).val());
    });
  
  function Eliminarkit(id) {
    
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
            url: servidor+'/api/v0/kit_delete/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
            method: "DELETE",             // Tipo de solicitud que se enviará, llamado como método
            data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
            success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
            {
              cargar_tablakit($("#cmbTipo_Promocion3").val());
              swal("ACCION EXITOSA!", "Datos Eliminados", "success");
           
            
            },
            error: function (data) {
                mensaje = "OCURRIO UN ERROR: funcion eliminar kit"
           
                swal(mensaje);
    
            }
          });
    
        } else {
          swal("Cancelado!");
        }
      });
    
    }

    function contar_Kit(){
 

      $.ajax({
        url:servidor+ '/api/v0/contar_registros',// Url que se envia para la solicitud esta en el web php es la ruta
        method: "GET",             // Tipo de solicitud que se enviará, llamado como método
        data: null,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
    
          console.log(data);
          $('#spanCountKit').html(data);
        },
        error: function () {
            mensaje = "error";
            swal(mensaje);
        }
      });
    
    }