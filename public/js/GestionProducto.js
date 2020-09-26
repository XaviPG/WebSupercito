
var servidor="http://127.0.0.1:8000";

$( document ).ready(function() {

  contar_Producto();

});

function cargar_tablaProductos(value='') {
	var FrmData=
	{
		value: value,
	}
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: servidor+'/api/v0/productos_filtro/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "GET",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
        	//console.log(data.items);
           	crear_tablaProductos_v2(data);
        },
        error: function () {
            mensaje = "OCURRIO UN ERROR : Archivo->GestionProducto.js , funcion->cargar_tablaProducto()";
           	swal(mensaje);
        }
	});
}

 function crear_tablaProductos(data) {
     $('#tablaProductos').html('');
        //console.log(data);
        $.each(data.items, function(a, item) { // recorremos cada uno de los datos que retorna el objero json n valores

          var fila="";
         fila=`
            <tr class="fila_${item.id}">
               <th scope="row">${a+1}</th>
               <td><input type="hidden" value="${item.NAME}">${item.NAME}</td>
                <td><input type="hidden" value="${item.PRICE}">${item.PRICE}</td>
                <td><input type="hidden" value="${item.MARCA}">${item.MARCA}</td>
               <td><input type="hidden" value="${item.PESOITEM}">${item.PESOITEM}</td>
               <td><input type="hidden" value="${item.stock}">${item.stock}</td>


           </tr>
          `;
           //console.log(item);
            $('#tablaProductos').append(fila);

       });

}

// $('body').on('click','.addIagenes',function(){
//   console.log("dsd");
//   $('#Modal_publicado').modal('show');

//  });
function dosDecimales(n) {
  let t=n.toString();
  let regex=/(\d*.\d{0,2})/;
  return t.match(regex)[0];
}
function crear_tablaProductos_v2(data) {
  var ancho = '16%';
  $('#tablaProductos_padre').html('');
  $('#tablaProductos').html('');

  $('#tablaProductos_padre').DataTable({
      destroy: true,
      order: [],
      data: data.items,
      'createdRow': function (row, data, dataIndex) {
          //console.log(data);
      },
      'columnDefs': [
          {
             'targets': 3,
             'data':'item.id_item',
             'createdCell':  function (td, cellData, rowData, row, col) {

             },
          }
       ],
      columns: [
          {
              title: 'Nombre',
              width:ancho,
              data: 'NAME'
          },
          {
              title: 'Precio',
              width:ancho,
               data: null,
              render:function (data, type, row) {
                // var html =  `${data.total}`;
                var html =  Number(`${data.PRICE}`).toFixed(2);
                // var html = Number((`${data.total}`).toFixed(2));
                // parseFloat(Math.round(278.6 * 100) / 100).toFixed(2);

                  return `$ ${html}`;
              }
          },
          {
            title: 'Marca',
            width:ancho,
            data: 'MARCA'
          },
          {
            title: 'Peso',
            width:ancho,
            data: 'PESOITEM'
          },
          {
            title: 'Stock',
            width:ancho,
            data: 'stock'
          },
          {
              title: 'ACCIONES',
              width:ancho,
              data: null,
              render: function (data, type, row) {

                var html='';
                 html+= "<button type='button' value="+data.id+" style='color: black;' class='abrirmodal'><i class='fa fa-tags' aria-hidden='true'></i></button>";
                 html+= `<button id="boton_p_${data.id}" style='color: black;'  onclick="GP_agregar_imagen_producto(${data.id})"><i class="fa fa-picture-o" aria-hidden="true"></i></button>`;
                 html+= `<button type="button"style='color: black;' onclick="GP_verModalProductos(${data.id})"><i class="fa fa-eye" aria-hidden="true"></i></button>`;

                return `${html}`;
                // return `<button>hola</button>`;

              }
          }
      ],
/////////////////////////////////////////////////////////////////////////////////////
  });
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////DATOS DE DESCUENTO Y CANTIDAD ////////////////////////////////////////////////////////////////////////////////////////
var id = '';
var idcan = '';
$('body').on('click','.abrirmodal',function(){
  $('#IDcantidad').val('');
  idcan = '',
  idcan=$(this).val();
  $('#id_Procu_DE').val('');
   id='';
   id=$(this).val();// este es el id del prodcuto que le va a servir al ingresar la pomocion del producto
   var informacion = new Array();
    i=0;
    $(this).parents("tr").find("td").each(function()
    {
   informacion[i]=$(this).html();
    i++;
   })
   cargartablaDescuento();
   $('#modaiddescuentoCantidad').modal('show');
   console.log(informacion)
   $('#id_Procu_DE').val(informacion[0]);
   $('#IDcantidad').val(informacion[4]);
   $('#IDcantidad1').attr({"min":informacion[2]});
   idcan = informacion[4];
 });
 ////////////////////////////////////////////////////////////////////////////////////////////
 ///////////////////////////ingrezar ////////////////////////////////////////////////////////////////////////////////////////

 function ingresarCantidaDescuento(){
    if(parseInt($('#IDcantidad1').val())>idcan ){
      swal({
        title: 'ERROR',
        text: "No puede colocar en promocion lo que no hay en stock",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
    }else if(parseInt($('#IDcantidad1').val())<=0){
      swal({
        title: 'ERROR',
        text: "No puede colocar en promocion lo que no hay en stock",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
    }else if($('#IDcantidad1').val().trim() == ""){
      swal({
        title: 'ERROR',
        text: "Campo Cantidad Vacia",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
    }else if($('#IDdescuento').val().trim() == ""){
      swal({
        title: 'ERROR',
        text: "Campo descuento Vacia",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
    }else if(parseInt($('#IDdescuento').val())<=0){
      swal({
        title: 'ERROR',
        text: "No se puede colocar un descuento menor o igual a cero",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
    }else if($('#IDfechaFN').val()<=$('#IDfechaI').val()){
      swal({
        title: 'ERROR',
        text: "No puede colocar una fecha menor menor o igual que la de inicio",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
    }else if($('#IDfechaI').val().trim() == ""){
      swal({
        title: 'ERROR',
        text: "Campo fecha inicio Vacia",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
    }else if($('#IDfechaFN').val().trim() == ""){
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
        text: "Si aceptas, se creará una nueva promocion al producto!",

        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) =>{
      if (willDelete) {
        var FrmData = {
          idProducto: id,
          descuento:$('#IDdescuento').val(),
          stock: $('#IDcantidad1').val(),
          fecha_inicio: $('#IDfechaI').val(),
          fecha_fin: $('#IDfechaFN').val(),

        }
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
            url: servidor+''+'/api/v0/descuentoCantidad_store/'+FrmData, // Url que se envia para la solicitud esta en el web php es la ruta
            method: "POST",             // Tipo de solicitud que se enviará, llamado como método
            data: FrmData,               // Datos enviados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
            success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
            {

              cargartablaDescuento();
              cargar_tablaProductos('');
              limpiar();
              // console.log(data)
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
function limpiar() {
  $('input[type="number"]').val(null);
  $('input[type="date"]').val(null);
}
function cargartablaDescuento() {

	var FrmData=
	{
		idProducto: id,
	}
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $.ajax({
        url: servidor+'/api/v0/descuentoCantidad_filtro/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "GET",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {

          crear_tablaDescuentoCantidad(data);
        	//console.log(data);
        },
        error: function () {
            mensaje = "OCURRIO UN ERROR : Archivo->GestionProducto.js , funcion->cargar_tablaDescuento()";
           	swal(mensaje);
        }
	});
}
function crear_tablaDescuentoCantidad(data) {

  var ancho = '16%';
  var anchos= '5%';
  $('#tablaDescuentoCantidad').html('');
  $('#tablaDescuentoCant').html('');

  $('#tablaDescuentoCantidad').DataTable({
     destroy: true,
    order: [],
    data: data.items,
      'createdRow': function (row, data, dataIndex) {
        //console.log(data);
      },
      'columnDefs': [
          {
             'targets':4,
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
              title: 'Descuento',
              width:ancho,
              data: 'descuento'
          },
          {
              title: 'Cantidad',
              width:ancho,
              data: 'stock'
          },
          {

            title: 'Fecha inicio',
            width:ancho,
            data:null,
            render: function (data, type, row) {
              var html='';
              if(data.estado_del>0)
              {
                   var html = `${data.fecha_inicio}`;
              }else
              {
                   html = `${data.fecha_inicio} `;
              }
                   return `${html}`;


            }

          },

          {
              title: 'Fecha fin',
              width:ancho,
              data: null,
              render: function (data, type, row) {
                var html='';
                if(data.estado_del>0)
                {
                     var html = `${data.fecha_fin}`;
                }else
                {
                     html = ` ${data.fecha_fin}`;
                }
                     return `${html}`;

              }
          }
        //   {
        //     title: 'ACCIONES',
        //     width:ancho,
        //     data: null,
        //     render: function (data, type, row) {
        //       var html='';
        //       if(data.estado_del>0)
        //       {
        //            var html = `<button type="button" class="btn btn-sm btn-danger eliminardesc" value="${data.id}"><i class="fa fa-trash" aria-hidden="true"></i></button>`;
        //       }else
        //       {
        //            html = `
        //        `;
        //       }
        //            return `${html}`;


        //     }
        //  }
      ],

  });
}
$('body').on('click','.eliminardesc',function(){
  EliminarDescuento($(this).val());
  });
function EliminarDescuento(id) {

  var FrmData=
  {
    id: id,
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
        url: servidor+'/api/v0/descuentoCantidad_delete/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "DELETE",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
          swal("ACCION EXITOSA!", "Datos Eliminados", "success");
          //console.log(data);
          cargartablaDescuento();
        },
        error: function (data) {
            mensaje = "OCURRIO UN ERROR: Archivo->GestionUsuarios.js , funcion->usuarios_elimi()"

            swal(mensaje);

        }
      });

    } else {
      swal("Cancelado!");
    }
  });

}

function productos_ver(nome_token) {
  var FrmData=
  {
    idProducto:id_foraneo,
  }
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });

  $.ajax({
    url: '/api/v0/ventas_show/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
    method: "GET",             // Tipo de solicitud que se enviará, llamado como método
    data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
    success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
    {
      console.log(data);
      crear_venta_modal(data.items);
      $(".frmVentas_modal").modal('show');
    },
    error: function () {
        mensaje = "OCURRIO UN ERROR : Archivo->GestionVentas.js, funcion->cargar_tablaVentas()";
        swal(mensaje);
    }
  });

}
function contar_Producto(){


  $.ajax({
    url:servidor+ '/api/v0/contarProducto',// Url que se envia para la solicitud esta en el web php es la ruta
    method: "GET",             // Tipo de solicitud que se enviará, llamado como método
    // data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
    success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
    {

      // console.log(data);
      $('#spanCountProducto').html(data);
    },
    error: function () {
        mensaje = "error";
        swal(mensaje);
    }
  });

}
function crear_producto_modal(data) {
  $("#tabla_infor_venta").html('');
  // $("#tabla_infor_venta_productos").html('');
  var detalle = ``;

  $("#venta_listado_ventas").DataTable({
    /////////////////////////////////////////////////////////////////////////////////////
          destroy: true,
          order: [],
          data: data.detalle,
          'createdRow': function (row, data, dataIndex) {
              // console.log(data);
          },
          'columnDefs': [
              {
                 'targets': 3,
                 'data':'id',
                 'createdCell':  function (td, cellData, rowData, row, col) {
                      // $(td).attr('id','nombreCurso'+row);
                      // $(td).html('');
                      // $(td).append('<label class="switch"><input type="checkbox"><span class="slider round"></span></label>');
                      // $(td).append(`<button type="button" class="btn btn-sm btn-outline-info">ver</button>`);
                      // $(td).append('<button type="button" class="btn btn-sm btn-outline-secondary">Eliminar</button>');
                 },
              }
           ],
          columns: [
              {
                  title: 'COD. BARRA',
                  data: 'producto.cod_barra'
              },
              {
                  title: 'COD. BARRA ALTERNO',
                  data: 'producto.cod_barra_alterno'
              },
              {
                title: 'DESCRIPCIÓN',
                data: 'producto.descripcion'
              },
              {
                title: 'MARCA',
                data: 'producto.marca'
              },
              {
                title: 'CONCENTRACIÓN',
                data: 'producto.concentracion'
              },
              {
                title: 'MEDIDA',
                data: 'producto.medida'
              },
              {
                title: 'CANTIDAD',
                data: 'cantidad'
              },
              {
                title: 'PRECIO U.',
                data: 'precio_u'
              },
              {
                title: 'SUBTOTAL',
                data: 'subtotal'
              }
          ],
    /////////////////////////////////////////////////////////////////////////////////////
  });

  var fila = `
      <div class="col bg-info"><strong>Fecha:</strong></div>           <div class="col">${data.fecha}</div>
      <div class="col  bg-info"><strong>ToTal:</strong></div>           <div class="col">${data.total}</div>
        <div class="w-100"></div>
      <div class="col bg-info"><strong>Usuario :</strong></div>           <div class="col">${data.usuario.name}</div>
      <div class="col bg-info"><strong>Courier :</strong></div>           <div class="col">${data.courier.name}</div>
        <div class="w-100"></div>
        <hr>
      <div class="col"><strong>Listado de Productos :</strong></div>
        <div class="w-100"></div>

    `;
    $('#tabla_infor_venta').html(fila);
}

function GP_agregar_imagen_producto(id_foraneo){
  $('#id_foraneo').val(id_foraneo);
  GP_preview_producto_img(id_foraneo);
  $('#btnGuardarImagenProducto').attr('hidden',true); // se oculta el boton de guargar cuando se abre la modal de la imagen del producto
  $(`#file_producto_img_label`).html(''); //limpia el label del input de la imagen
  $(`#file_producto_img_label`).html('Seleccione una Imagen'); // Agrega un nuevo texto al label del input type="file"
  $('.frmProductos_img_modal').modal('show');
}

//enctype="multipart/form-data"
$('#file_producto_img').change(function (e) {
  archivo = "Seleccione un Archivo";
  if (this.files.length>0) {
    archivo =(this.files[0].name);
    $(`#file_producto_img_label`).html(`${archivo}`);
    //imagen = (e.target.files[0].width=500);
    //e.target.files[0].width = 300;

    $('#iframe_producto_img').attr('src',`${URL.createObjectURL(e.target.files[0])}`);

  }
  $('#btnGuardarImagenProducto').attr('hidden',false);
  //console.log($(this).val());
  //$('#iframe_producto_img').attr('src',$(this).val());
});

function GP_preview_producto_img(id_foraneo) {

  var FrmData = {
    idProducto:id_foraneo
  }
console.log('data',FrmData);
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: '/api/v0/productos_show/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
    method: "GET",             // Tipo de solicitud que se enviará, llamado como método
    data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
    success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
    {
      console.log("result:",data);

      if (data.items.file_name == null) {
        $('#iframe_producto_img').attr('src',`/img/supercito.jpg`);
      }else{
        // $(`#file_producto_img_label`).val();
        $('#iframe_producto_img').attr('src',`/img/items/${data.items.file_name}.${data.items.file_extension}`);
      }
      $('.shrinkToFit').prop('width','10 % !important');
    },
    error: function () {
      $('#iframe_producto_img').attr('src',`/img/supercito.jpg`);

        // mensaje = "OCURRIO UN ERROR: Archivo->GestionProductosJSON.js , funcion->GP_preview_producto_img()";
        // swal(mensaje);
    }
  });


}

$('#frmProductos_img_modificar').on('submit',function (e) {

  e.preventDefault();
  var FrmData = new FormData(this);
  // alert();
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  swal({
    title: "Estas seguro de esto?",
    text: "Si aceptas, se agregara una imagen al producto!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      // debugger
      $.ajax({
        url: '/api/v0/productos_guardar_img/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "POST",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        cache: false,
        contentType: false,
        processData: false,
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
          // debugger
          console.log("respuesta:",data);
          swal("ACCION EXITOSA!", "Datos Guardados", "success");
          // $('#iframe_producto_img').attr('width','100%');
          // $('#iframe_producto_img').attr('height','100%');
          $('#iframe_producto_img').attr('src',`/img/items/${data.items.file_name}.${data.items.file_extension}`);
          // $('#iframe_producto_img').append(`<img height="100%" width="100%" src="/img/items/${data.items.file_name}.${data.items.file_extension}" alt="">`);
          $('#btnGuardarImagenProducto').attr('hidden',true);

        },
        error: function () {
            mensaje = "OCURRIO UN ERROR: Archivo->GestionProductosJSON.js , funcion->frmProductos_img_modificar";
            swal(mensaje);

        }
      });

    } else {
      swal("Cancelado!");
    }
  });

});


////////////////////////////////////////////////////////////////////////////////////
function GP_verModalProductos(id_busqueda) {

  $('#tabla_infor_producto').html('');
  var FrmData = {
    idProducto : id_busqueda,
  };
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: `${servidor}/api/v0/productos_show`,// Url que se envia para la solicitud esta en el web php es la ruta
    method: "GET",             // Tipo de solicitud que se enviará, llamado como método
    data: FrmData,
    success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
    {
      // debugger
      var precio=Number(`${data.items.PRICE}`).toFixed(2);
      console.log("respuesta:",data);
      var fila = `
        <div class="col"><strong>Producto: </strong>${data.items.NAME}</div>         <br>
          <div class="w-100"></div>
        <div class="col"><strong>Precio: </strong>$ ${precio}</div>  <br>
          <div class="w-100"></div>
        <div class="col"><strong>Marca: </strong>${data.items.MARCA}</div> <br>
          <div class="w-100"></div>
        <div class="col"><strong>Peso: </strong>${data.items.PESOITEM}</div> <br>
          <div class="w-100"></div>
        <div class="col"><strong>Disponibles: </strong>${data.items.stock}</div> <br>
          <div class="w-100"></div>


      `;
      $('#tabla_infor_producto').html(fila);
      $(`.frmProductos_modal`).modal('show');
    },
    error: function () {
        mensaje = "OCURRIO UN ERROR: Archivo->GestionProductosJSON.js , funcion->GP_verModalProductos";
        swal(mensaje);

    }
  });


}


//frmImportarProductos

$('#frmImportarProductos').on('submit',function (e) {

  e.preventDefault();
  $('#enespera').show();
  var FrmData = new FormData(this);
  // alert();
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  swal({
    title: "Estas seguro de esto?",
    text: "Si aceptas, se agregara una imagen al producto!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      // debugger
      $.ajax({
        url: '/api/import',// Url que se envia para la solicitud esta en el web php es la ruta
        method: "POST",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        cache: false,
        contentType: false,
        processData: false,
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
          // debugger
          $('#enespera').hide();
          console.log('IMPORTAR DATOS',data);

          $('#spanCountProducto').val(data.items.length);

          cargar_tablaProductos('');
          swal("ACCION EXITOSA!", "Datos Guardados", "success");
        },
        error: function () {
            mensaje = "OCURRIO UN ERROR: Archivo->GestionProductos.js , funcion->frmProductos_img_modificar";
            swal(mensaje);

        }
      });

    } else {
      swal("Cancelado!");
    }
  });

});
