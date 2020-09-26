ventas_ver//GestionVentas.js
$( document ).ready(function() {
	//cargar_tablaVentas('');
});
$( document ).ready(function() {

  contar_Venta();
  
});

function contar_Venta(){


  $.ajax({
    url:servidor+ '/api/v0/contarCompra',// Url que se envia para la solicitud esta en el web php es la ruta
    method: "GET",             // Tipo de solicitud que se enviará, llamado como método
    // data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
    success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
    {

      // console.log(data);
      $('#spanCountVenta').html(data);
    },
    error: function () {
        mensaje = "error";
        swal(mensaje);
    }
  });

}

function cargar_tablaVentas(value='') {
  //swal('cargar_tablaVentas');
  var FrmData=
  {
    value: value,
    value2: 'ventas',
  }
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });

  $.ajax({
    url: '/api/v0/todasLasVentas',// Url que se envia para la solicitud esta en el web php es la ruta
    method: "GET",             // Tipo de solicitud que se enviará, llamado como método
    data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
    success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
    {

        //  crear_tablaVentas(data);
        // console.log(data);
         crear_tablaVentas_v2(data.items);
    },
    error: function () {
        mensaje = "OCURRIO UN ERROR: Archivo->GestionVentas.js , funcion->cargar_tablaVentas()";
        swal(mensaje);
    }
  });
}

function crear_tablaVentas(data) {
	//swal('hola');
  	$('#tablaVentas_reporte').html('');


	$.each(data.items, function(a, item) { // recorremos cada uno de los datos que retorna el objero json n valores
    var total=Number(`${item.total}`).toFixed(2);
	  var fila="";
	  fila=`
	    <tr class="fila_${item.nome_token}">
	        <th scope="row">${a+1}</th>
					<td><input type="hidden" value="${item.fecha}">${item.fecha}</td>
	        // <td><input type="hidden" value="${item.usuario.name}">${item.usuario.name}</td>
	        // <td><input type="hidden" value="${item.courier.name}">${item.courier.name}</td>
	        // <td><input type="hidden" value="${item.total}">$ ${total}</td>
	        // <td><input type="hidden" value="${item.estado.descripcion}">${item.estado.descripcion}</td>
	        <td>
	          <button type="button" class="btn btn-sm btn-outline-info" onclick="ventas_ver_modal('${item.nome_token}')" data-toggle="modal" >Modificar</button>
	          <button type="button" class="btn btn-sm btn-outline-secondary" onclick="ventas_eliminar('${item.id}')">Eliminar</button>
	        </td>
	    </tr>
	  `;

	    $('#tablaVentas_reporte').append(fila);

	});

}

function crear_tablaVentas_v2(data) {
    // debugger
    var ancho = "16%";
    $('#tablaVentas').html('');
    $('#tablaVentas_padre').html('');
    //$.get(`${apiProductos}api/v0/itemsBodega`,function (data) {
      $('#tablaVentas_padre').DataTable({
  /////////////////////////////////////////////////////////////////////////////////////
        destroy: true,
        order: [],
        data: data,
        'createdRow': function (row, data, dataIndex) {
            //
        },
        'columnDefs': [
            {
               'targets': 5,
               'data':'id',
               'createdCell':  function (td, cellData, rowData, row, col) {
                  console.log(rowData);

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
              title: 'FECHA',
              width:ancho,
              data: 'fechaOrden'
            },
            {
              title: 'CLIENTE',
              width:ancho,
              data: 'usuarios.name'
            },
            {
              title: 'TRANSPORTISTA',
              width:ancho,
              data: null,
              render: function ( data, type, row ) {
                if (data.idcourier===null) {
                  // color=`info`;
                  // descripcion = `En Proceso`;
                  var html = `
                  <th ><i style="color:black;" id="descrip" aria-hidden="true">Indefinido</i></th>
                  `;
                  // $('#btn_ver').attr('disabled',true);
                }else{
                  var html = `${data.courier.name}`;
                 
                }
                return `${html}`;
              }

            },
            {
              title: 'TOTAL',
              width:ancho,
              data: null,
              render:function (data, type, row) {
                // var html =  `${data.total}`;
                var html =  Number(`${data.total}`).toFixed(2);
                // var html = Number((`${data.total}`).toFixed(2));
                // parseFloat(Math.round(278.6 * 100) / 100).toFixed(2);

                  return `$ ${html}`;
              }
            },
            {
              title: 'ESTADO',
              width:ancho,
              data: null,
              render: function (data, type, row) {
                var descripcion = ``;
                var color=``;
                console.log(data);
                if (data.estado.cod===`002`) {
                  // color=`info`;
                  // descripcion = `En Proceso`;
                  var html = `
                  <th ><i style="color:green;" id="descrip" aria-hidden="true">En proceso</i></th>
                  `;
                }
                if (data.estado.cod===`003`) {
                  //  color=`secondary`;
                  // descripcion = `Finalizado`;
                  var html = `
                  <th ><i style="color:blue;" id="descrip" aria-hidden="true">Finalizada</i></th>
                  `;
                }
                if (data.estado.cod===`004`) {
                  //  color=`secondary`;
                  // descripcion = `Finalizado`;
                  var html = `
                  <th ><i style="color:red;" id="descrip" aria-hidden="true">Rechazada</i></th>
                  `;
                }
                
                return `${html}`;
                // return `<button>hola</button>`;

              }
            },
            {
                title: 'ACCIONES',
                width:ancho,
                data: null,
                render: function (data, type, row) {
                  var finalizar ='';
                  if (data.finalizado=='1') {
                    finalizar = `<button  disabled type="button" class="col-4 btn btn-sm btn-outline-secondary"><i class="fa fa-circle-thin" aria-hidden="true"></i></button>`;
                   
                  }else if(data.finalizado=='0'){
                    finalizar = `<button  type="button" class="col-4 btn btn-sm btn-outline-secondary" onclick="ventas_finalizar('${data.id}')"><i class="fa fa-circle-thin" aria-hidden="true"></i></button>`;
                  }
                 var rechazar='';
                  if( data.rechazado=='1'){
                    rechazar = ` <button disabled type="button" id="btn_ver" class="col-4 btn btn-sm btn-outline-info"  data-toggle="modal" ><i class="fa fa-eye" aria-hidden="true"></i></button>
                    `
                  }else if(data.rechazado=='0'||data.rechazado==null){
                    rechazar= ` <button type="button" id="btn_ver" class="col-4 btn btn-sm btn-outline-info" onclick="ventas_ver('${data.id}')" data-toggle="modal" ><i class="fa fa-eye" aria-hidden="true"></i></button>
                    `
                  }
                  var html = `
                    <div class='row'>
                    ${rechazar}
                    <button type="button" class="col-4 btn btn-sm btn-outline-secondary" onclick="ventas_eliminar('${data.id}')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    ${finalizar}
                    </div>
                    `;

                  return `${html}`;
                  // return `<button>hola</button>`;

                }
            }
        ],
  /////////////////////////////////////////////////////////////////////////////////////
      });
    //});
}

//filtro de ventas
$("#filtroVentas").keyup(function (e) {
	cargar_tablaVentas($("#filtroVentas").val());
});

function ventas_eliminar(nome_token) {

  var FrmData=
  {
    nome_token:  nome_token,
  }
  console.log(FrmData);
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
        url: '/api/v0/orden_delete/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "DELETE",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
          swal("ACCION EXITOSA!", "Datos Eliminados", "success");
          cargar_tablaVentas('');
          contar_Tipo();
        },
        error: function () {
            mensaje = "OCURRIO UN ERROR: Archivo->GestionVentas.js , funcion->ventas_eliminar()";
            swal(mensaje);

        }
      });

    } else {
      swal("Cancelado!");
    }
  });

}

function ventas_ver(nome_token) {
  var FrmData=
  {
    nome_token: nome_token,
  }
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });

  $.ajax({
    url: '/api/v0/ordenes_show',// Url que se envia para la solicitud esta en el web php es la ruta
    method: "GET",             // Tipo de solicitud que se enviará, llamado como método
    data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
    success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
    {
      console.log('data detalle',data);
      crear_venta_modal(data.items);
      $(".frmVentas_modal").modal('show');
    },
    error: function () {
        mensaje = "OCURRIO UN ERROR : Archivo->GestionVentas.js, funcion->cargar_tablaVentas()";
        swal(mensaje);
    }
  });

}

function crear_venta_modal(data) {
  
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
              title: 'DESCRIPCIÓN',
              data: 'producto.NAME'
            },
            {
              title: 'MARCA',
              data: 'producto.MARCA'
            },
            {
              title: 'PRECIO',
              data: 'producto.PRICE'
            },
            {
              title: 'CANTIDAD',
              data: 'cantidad'
            },
            {
              title: 'SUBTOTAL',
              data: null,
              render: function ( data, type, row ) {
                return '';
              }
            }
          ],
    /////////////////////////////////////////////////////////////////////////////////////
  });
  var total=Number(`${data.total}`).toFixed(2);
  var fila = `
      <div class="col bg-warning"><strong>Fecha de venta:</strong></div>           <div class="col">${data.fechaOrden}</div>
      <div class="col  bg-warning"><strong>Total:</strong></div>           <div class="col">$ ${total}</div>
        <div class="w-100"></div>
      <div class="col bg-warning"><strong>Nombre del cliente :</strong></div>           <div class="col">${data.cliente.name}</div>
      <div class="col bg-warning"><strong>Transportista :</strong></div>           <div class="col">${data.courier.name}</div>
        
      <div class="col bg-warning"><strong>Listado de Productos vendidos :</strong></div>
        <div class="w-100"></div>
<br>
    `;
    $('#tabla_infor_venta').html(fila);
}

function ventas_finalizar(nome_token){

  var FrmData=
  {
    nome_token:  nome_token,
  }

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });



  swal({
    title: "Estas seguro de esto?",
    text: "Si aceptas, la venta se finalizará!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: '/api/v0/ordenes_finalizar',// Url que se envia para la solicitud esta en el web php es la ruta
        method: "POST",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
          swal("ACCION EXITOSA!", "Venta Finalizada", "success");
          cargar_tablaVentas('');
          contar_Venta();
        },
        error: function () {
            mensaje = "OCURRIO UN ERROR: Archivo->GestionVentas.js , funcion->ventas_finalizar()";
            swal(mensaje);

        }
      });
    }else{

    }
  });
}
