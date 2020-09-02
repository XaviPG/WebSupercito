// // var apiProductos = "http://192.168.137.1:8080/FarmaciaApis/public/"
// var apiProductos = "http://localhost:8080/FarmaciaApis/public/"
var urlApi = "http://localhost:8000/itemsBodega.json";


function GP_cargarTablaProductosBodega_2(last=0,filtro='') {
  var FrmData=
	{
		value: filtro,
	}
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
// debugger
  $.ajax({
      url: urlApi,// Url que se envia para la solicitud esta en el web php es la ruta
      method: "GET",             // Tipo de solicitud que se enviará, llamado como método
      data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
      success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
      {
        //console.log(data);

        GP_crearTablaProductosBodega_v2(data);
      },
      error: function (error) {
        console.log(error);

          mensaje = "OCURRIO UN ERROR : Archivo->GestionProductos.js , funcion->GP_cargarTablaProductosBodega_2()";
          swal(mensaje);
      }
  });

}

var listaProductos = [];
function GP_crearTablaProductosBodega_v2(data) {
  var ancho = '20%';
  $('#tablaProductosForanea').html('');
  $('#tablaProductosForanea_padre').html('');

  // $.get(`${apiProductos}api/v0/itemsBodega/`+last+`/`+filtro,function (data) {

    $('#tablaProductosForanea_padre').DataTable({
/////////////////////////////////////////////////////////////////////////////////////
      destroy: true,
      order: [],
      data: data,
      'createdRow': function (row, data, dataIndex) {
          // console.log(data);
      },
      'columnDefs': [
          {
             'targets': 4,
             'data':'item.id_item',
             'createdCell':  function (td, cellData, rowData, row, col) {
                //$(td).attr('id','fila_p_'+rowData.id_item_bodega);
                //console.log("rowData",rowData);
                // var data = cellData;
                // //checkeds(cellData.id_item_bodega);
                // var data = cellData;
                // var id_foraneo = cellData.id_item_bodega;

                // $(td).html('');
                // var existe = false;

                // $.each(lista_productos,function (a,item) {
                //   // console.log(item);
                //   if (item==id_foraneo) {
                //     existe = true;
                //     //$(td).append(`<p>${id_foraneo}</p>`);
                //     $(td).append(`<label class="col-xs switch"><input id="checkbox_${data.id_item_bodega}" checked="true" onclick="GP_escoger_producto(${data.id_item_bodega})" type="checkbox"><span class="slider round"></span></label>`);
                //     $(td).append(`<button type="button" class="col-xs btn btn-sm btn-outline-info" onclick="GP_verModalProductos(${data.id_item_bodega})"><i class="fa fa-eye" aria-hidden="true"></i></button>`);
                //     $(td).append(`<button id="boton_p_${data.id_item_bodega}" class="col-xs btn btn-sm btn-outline-info" onclick="GP_agregar_imagen_producto(${data.id_item_bodega})"><i class="fa fa-picture-o" aria-hidden="true"></i></button>`);
                  
                //     // debugger
                //   }
                  
                // });

                // if (existe==false) {
                //   $(td).append(`<label class="col-xs switch"><input id="checkbox_${data.id_item_bodega}" onclick="GP_escoger_producto(${data.id_item_bodega})" type="checkbox"><span class="slider round"></span></label>`);
                //   $(td).append(`<button type="button" class="col-xs btn btn-sm btn-outline-info" onclick="GP_verModalProductos(${data.id_item_bodega})"><i class="fa fa-eye" aria-hidden="true"></i></button>`);
                //   $(td).append(`<button id="boton_p_${data.id_item_bodega}" class="col-xs btn btn-sm btn-outline-info" hidden="true" onclick="GP_agregar_imagen_producto(${data.id_item_bodega})"><i class="fa fa-picture-o" aria-hidden="true"></i></button>`);
                  
                // }
                                    
             },
          }
       ],
      columns: [
          {
              title: 'COD. BARRAS',
              width: ancho,
              data: 'item.cod_barra'
              
          },
          {
              title: 'NOMBRE',
              width: '20%',
              data: 'item.descripcion'
          },
          {
              title: 'PRECIO',
              data: null,
              width: ancho,
              render: function ( data, type, row ) {
                return "$ "+data.item.precio;
              }
          },
          {
            title: 'STOCK',
            width: ancho,
            data: 'stock_unidad',
          },
          {
              title: 'ACCIONES',
              width: ancho,
              data: null,
              render: function (data, type, row) {

                var html ="";
                var existe = false;                
                // var html = `

                //   <label class="col-xs switch"><input id="checkbox_${data.id_item_bodega}" onclick="GP_escoger_producto(${data.id_item_bodega})" type="checkbox"><span class="slider round"></span></label>
                //   <button type="button" class="col-xs btn btn-sm btn-outline-info" onclick="GP_verModalProductos(${data.id_item_bodega})"><i class="fa fa-eye" aria-hidden="true"></i></button>
                //   <button id="boton_p_${data.id_item_bodega}" class="col-xs btn btn-sm btn-outline-info" hidden="true" onclick="GP_agregar_imagen_producto(${data.id_item_bodega})"><i class="fa fa-picture-o" aria-hidden="true"></i></button>

                // `;
                
                //checkeds(data.id_item_bodega);

                $.each(lista_productos,function (a,item) {
                  // console.log(item);
                  if (item==data.id_item_bodega) {
                    existe = true;
                    // debugger
                    html = `
                      <label class="col-xs switch"><input id="checkbox_${data.id_item_bodega}" checked="true" onclick="GP_escoger_producto(${data.id_item_bodega})" type="checkbox"><span class="slider round"></span></label>
                      <button type="button" class="col-xs btn btn-sm btn-outline-info" onclick="GP_verModalProductos(${data.id_item_bodega})"><i class="fa fa-eye" aria-hidden="true"></i></button>
                      <button id="boton_p_${data.id_item_bodega}" class="col-xs btn btn-sm btn-outline-info" onclick="GP_agregar_imagen_producto(${data.id_item_bodega})"><i class="fa fa-picture-o" aria-hidden="true"></i></button>
                    `;
                    
                  }
                  
                });

                if (existe==false) {

                  html = `
                    <label class="col-xs switch"><input id="checkbox_${data.id_item_bodega}" onclick="GP_escoger_producto(${data.id_item_bodega})" type="checkbox"><span class="slider round"></span></label>
                    <button type="button" class="col-xs btn btn-sm btn-outline-info" onclick="GP_verModalProductos(${data.id_item_bodega})"><i class="fa fa-eye" aria-hidden="true"></i></button>
                    <button id="boton_p_${data.id_item_bodega}" class="col-xs btn btn-sm btn-outline-info" hidden="true" onclick="GP_agregar_imagen_producto(${data.id_item_bodega})"><i class="fa fa-picture-o" aria-hidden="true"></i></button>
                  `;

                  

                }
                return `${html}`;
                 //return `<button>hola</button>`;
                 
              }
          }
      ],
/////////////////////////////////////////////////////////////////////////////////////
    });
  // });
}



function GP_escoger_producto(id_foraneo) {
    // $(`#checkbox_${id_foraneo}`).change(function(){
        if($(`#checkbox_${id_foraneo}`).prop('checked') != false)
        {
          // console.log("agrear");
          GP_agregar_producto(id_foraneo);
        }else if ($(`#checkbox_${id_foraneo}`).prop('checked') != true) {
          // console.log("eliminar");
          GP_eliminar_producto(id_foraneo);
        }
    // });
}

function GP_agregar_producto(id_foraneo) {

  var FrmData={};

  $.get(`${urlApi}`,function (data) {
    // FrmData = data;
    $.each(data,function(a,item) {
      if (item.id_item_bodega==id_foraneo) {
        FrmData = item;
        // alert(FrmData.id_item_bodega);
      }
    });
  });

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  swal({
    title: "Estas seguro de esto?",
    text: "Si aceptas, se creará un nuevo producto!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      // debugger
      $.ajax({
        url: '/api/v0/productos_store/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "POST",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
          // debugger
          swal("ACCION EXITOSA!", "Datos Guardados", "success");
          $(`#boton_p_${id_foraneo}`).attr('hidden',false);
          // $(`#fila_p_${id_foraneo}`).append(`<button type="button" class="col-xs btn btn-sm btn-outline-info"><i class="fa fa-picture-o" aria-hidden="true"></i></button>`);
          // limpiar();
          // console.log(data);
        },
        error: function () {
            mensaje = "OCURRIO UN ERROR: Archivo->GestionProductos.js , funcion->GP_agregar_producto()";
            swal(mensaje);
            $(`#checkbox_${id_foraneo}`).prop("checked", false );
        }
      });

    } else {
      swal("Cancelado!");
    }
  });

}
//////////////////////////////////////
function GP_eliminar_producto(id_foraneo) {

  var FrmData=
  {
    nome_token:  id_foraneo,
  }

  // console.log(id_foraneo);

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
  .then((willDelete) => {
    if (willDelete) {

      $.ajax({
        url: '/api/v0/productos_delete/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "DELETE",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
          // debugger
          swal("ACCION EXITOSA!", "Datos Guardados", "success");
          // limpiar();
          // console.log(data);
        },
        error: function () {
            mensaje = "OCURRIO UN ERROR: Archivo->GestionProductos.js , funcion->GP_eliminar_producto()";
            swal(mensaje);
            $(`#checkbox_${id_foraneo}`).prop("checked", false );
        }
      });

    } else {
      swal("Cancelado!");
    }
  });

}

////////////////////////////////////////////////////////////////////////////////////
var lista_productos =[];

function GP_cargar_lista_productos(nome_token) {

  var FrmData=
  {
    nome_token:  nome_token,
  }

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: '/api/v0/productos_filtro/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
    method: "GET",             // Tipo de solicitud que se enviará, llamado como método
    data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
    success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
    {
      lista_productos.length=0;
      // GP_llenar_lista_productos(data.items);
      $.each(data.items,function(a,item) {
        lista_productos.push(item.id_foraneo);
      });
      console.log(lista_productos);
      
    },
    error: function () {
        mensaje = "OCURRIO UN ERROR: Archivo->GestionProductos.js , funcion->GP_cargar_lista_productos()";
        swal(mensaje);
    }
  });

}

function checkeds(id_foraneo) {
  $.each(lista_productos,function (a,item) {
    // console.log(item);
    if (item==id_foraneo) {
      

      // console.log(id_foraneo);
      // var checkbox = document.getElementById(`checkbox_${id_foraneo}`);
      // checkbox.checked = true;
      $(`#checkbox_${id_foraneo}`).prop('checked',true);
      $(`#boton_p_${id_foraneo}`).attr('hidden',false);
      // debugger
      // $(`#fila_p_${id_foraneo}`).append(`<button type="button" class="col-xs btn btn-sm btn-outline-info"><i class="fa fa-picture-o" aria-hidden="true"></i></button>`);
      // $(`#checkbox_${id_foraneo}`).prop('checked');
    }
  });
}
////////////////////////////////////////////////////////////////////////////////////
function GP_verModalProductos(id_foraneo) {
  $('#tabla_infor_producto').html('');

  var data={};

  $.get(`${urlApi}`,function (_data) {
    // FrmData = data;
    
    $.each(_data,function(a,item) {
      if (item.id_item_bodega==id_foraneo) {
        data = item;
        // alert(FrmData.id_item_bodega);
        var fila = `
          <div class="col"><strong>Código de Barra:</strong></div>           <div class="col">${data.item.cod_barra}</div>
            <div class="w-100"></div>
          <div class="col"><strong>Código de Barra Alterno :</strong></div>  <div class="col">${data.item.cod_barra_alterno}</div>
            <div class="w-100"></div>
          <div class="col"><strong>Código de Barra Alterno 1:</strong></div> <div class="col">${data.item.codigo_alterno_1}</div>
            <div class="w-100"></div>
          <div class="col"><strong>Código de Barra Alterno 2:</strong></div> <div class="col">${data.item.codigo_alterno_2}</div>
            <div class="w-100"></div>
          <div class="col"><strong>Descripcipción:</strong></div>            <div class="col">${data.item.descripcion}</div>
            <div class="w-100"></div>
          <div class="col"><strong>Descripcipción Larga:</strong></div>      <div class="col">${data.item.descripcion_larga}</div>
            <div class="w-100"></div>
          <div class="col"><strong>Precio:</strong></div>                    <div class="col">${data.item.precio}</div>
            <div class="w-100"></div>
          <div class="col"><strong>Observación:</strong></div>               <div class="col">${data.item.observacion}</div>
            <div class="w-100"></div>
          <div class="col"><strong>Marca:</strong></div>                     <div class="col">${data.item.marca.descripcion}</div>
            <div class="w-100"></div>
          <div class="col"><strong>Presentación:</strong></div>      <div class="col">${data.item.producto.presentacion}</div>
            <div class="w-100"></div>
          <div class="col"><strong>Medida:</strong></div>      <div class="col">${data.item.producto.medida}</div>
            <div class="w-100"></div>
          <div class="col"><strong>Concentración:</strong></div>      <div class="col">${data.item.producto.consentracion}</div>
            <div class="w-100"></div>
          <div class="col"><strong>Stock Unidad:</strong></div>      <div class="col">${data.item.producto.stock_unidad}</div>
            <div class="w-100"></div>
          <div class="col"><strong>Stock Fracción:</strong></div>      <div class="col">${data.item.producto.stock_fraccion}</div>
            <div class="w-100"></div>
          <div class="col"><strong># de Fracciones:</strong></div>      <div class="col">${data.item.producto.num_fraccion}</div>
            <div class="w-100"></div>
          <div class="col"><strong>Estado del Producto:</strong></div>      <div class="col">${data.estado_item_bodega.descripcion}</div>
            <div class="w-100"></div>
        `;
      $('#tabla_infor_producto').html(fila);
      //$('#txt_descripcion_producto_modal').val(console.log(data));
      }
    });
  });
  $(`.frmProductos_modal`).modal('show');

}
////////////////////////////////////////////////////////////////////////////////////////////////////
function GP_agregar_imagen_producto(id_foraneo){
  $('#id_foraneo').val(id_foraneo);
  GP_preview_producto_img(id_foraneo);
  $('.frmProductos_img_modal').modal('show');
}

//enctype="multipart/form-data"
$('#file_producto_img').change(function (e) {
  //console.log($(this).val());
  //$('#iframe_producto_img').attr('src',$(this).val());
});

function GP_preview_producto_img(id_foraneo) {

  var FrmData = {
    nome_token:id_foraneo
  }

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: '/api/v0/productos_show/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
    method: "GET",             // Tipo de solicitud que se enviará, llamado como método
    data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
    success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
    {
      console.log(data);
      
      if (data.items.file_name == null) {
        $('#iframe_producto_img').attr('src',`/img/fondo3.jpg`); 
      }else{
        // $(`#file_producto_img_label`).val();
        $('#iframe_producto_img').attr('src',`/img/items/${data.items.file_name}.${data.items.file_extension}`); 
      }
    },
    error: function () {
      $('#iframe_producto_img').attr('src',`/img/fondo3.jpg`); 

        // mensaje = "OCURRIO UN ERROR: Archivo->GestionProductos.js , funcion->GP_preview_producto_img()";
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
        url: '/api/v0/productos_guardar_img/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "POST",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        cache: false,
        contentType: false,
        processData: false,
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
          // debugger
          swal("ACCION EXITOSA!", "Datos Guardados", "success");
          // $('#iframe_producto_img').attr('width','100%');
          // $('#iframe_producto_img').attr('height','100%');
          $('#iframe_producto_img').attr('src',`/img/items/${data.items.file_name}.${data.items.file_extension}`);
          // $('#iframe_producto_img').append(`<img height="100%" width="100%" src="/img/items/${data.items.file_name}.${data.items.file_extension}" alt="">`);
          
        
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

