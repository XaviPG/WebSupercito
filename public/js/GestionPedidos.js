var servidor="http://127.0.0.1:8000";
//GestionPedidos.js
$( document ).ready(function() {

  contar_Orden();
  //saber_si_hay_nuevas_ordenes();
  
  setInterval(() => {
    saber_si_hay_nuevas_ordenes();
  }, 10000);

});


//	Cargar Todos los pedidos
//****************************************************************************************************************************************************************************
function cargar_tablaPedidos(value='') {
  var FrmData=
  {
    value: value,
    value2: 'pedidos',
  }
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });

  $.ajax({
    url: servidor+'/api/v0/SoloPedidos'+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
    method: "GET",             // Tipo de solicitud que se enviará, llamado como método
    data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
    success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
    {

      // console.log(data);
      GP_crearTablaPedidos_2(data.items);
    },
    error: function () {
        mensaje = "OCURRIO UN ERROR : Archivo->GestionPedidos.js, funcion->cargar_tablaPedidos()";
        swal(mensaje);
    }
  });
  
}


function pedidos_eliminar(nome_token) {
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
    text: "Si aceptas, la orden será rechazada!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {

      $.ajax({
        url: servidor+'/api/v0/ordenes_rechazar',// Url que se envia para la solicitud esta en el web php es la ruta
        method: "POST",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
          //  console.log(data);
          swal("ACCION EXITOSA!", "Orden Rechazada", "success");
          cargar_tablaPedidos('');
        },
        error: function () {
            mensaje = "OCURRIO UN ERROR: Archivo->GestionPedidos.js , funcion->Orden_eliminar()";
            swal(mensaje);
            // console.log(FrmData);
        }
      });

    } else {
      swal("Cancelado!");
    }
  });
}

function GP_crearTablaPedidos_2(data) {
  // debugger
  var ancho ="16%";
  $('#tablaPedidos').html('');
  $('#tablaPedidos_padre').html('');
  //$.get(`${apiProductos}api/v0/itemsBodega`,function (data) {
    $('#tablaPedidos_padre').DataTable({
/////////////////////////////////////////////////////////////////////////////////////
      destroy: true,
      order: [],
      data: data,
      'createdRow': function (row, data, dataIndex) {
           console.log(data);
      },
      'columnDefs': [
          {
             'targets': 3,
             'data':'id',
             'createdCell':  function (td, cellData, rowData, row, col) {
               //console.log(rowData);

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
            title: 'PAGO',
            width:ancho,
            data: null,
            render: function (data, type, row) {
            if (data.tipo_pago.identificador===1) {
          
              var html = `
              <th ><i style="color:blue;" id="descrip" aria-hidden="true">Transfirió</i></th>
              `;
            }
            if (data.tipo_pago.identificador===2) {
          
              var html = `
              <th ><i style="color:green;" id="descrip" aria-hidden="true">Efectivo</i></th>
              `;
            }
            return `${html}`;
          } 
        },
          {
              title: 'TRANSPORTE',
              width:ancho,
              data: null,
              render: function ( data, type, row ) {

                var html = `
                  <button type="button" class="btn btn-sm btn-outline-success" onclick="pedidos_verCouriers('${data.id}')"><strong>ASIGNAR</strong></button>
                `;

                return `${html}`;

              }
          },
          {
              title: 'ACCIONES',
              width:ancho,
              data: null,
              render: function (data, type, row) {
                var img_comprobante ='';
                if (data.idTipoPago=='2') {
                  img_comprobante = `<button disabled type="button" class="btn btn-sm btn-outline-secondary"><i class="fa fa-picture-o" aria-hidden="true"></i></button>`;
                 
                }else if(data.idTipoPago=='1'){
                  img_comprobante = `<button type="button" class="btn btn-sm btn-outline-secondary" onclick="GP_preview_comprobante_img(${data.id})"><i class="fa fa-picture-o" aria-hidden="true"></i></button>
                  `;
                }
                var html = `
                  <button type="button" class="btn btn-sm btn-outline-info" onclick="pedidos_ver('${data.id}')" data-toggle="modal" ><i class="fa fa-eye" aria-hidden="true"></i></button>
                  <button type="button" class="btn btn-sm btn-outline-secondary" onclick="pedidos_eliminar('${data.id}')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                  ${img_comprobante}
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

function pedidos_ver(nome_token) {

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
    url: servidor+'/api/v0/ordenes_show',// Url que se envia para la solicitud esta en el web php es la ruta
    method: "GET",             // Tipo de solicitud que se enviará, llamado como método
    data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
    success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
    {
      console.log('ORDEN:',data);
      crear_pedido_modal(data.items);
      $(".frmPedidos_modal").modal('show');
    },
    error: function () {
        mensaje = "OCURRIO UN ERROR : Archivo->GestionPedidos.js, funcion->cargar_tablaPedidos()";
        swal(mensaje);
    }
  });


}

function crear_pedido_modal(data) {
  $("#tabla_infor_pedido").html('');
  //$("#tabla_infor_pedido_productos").html('');
  var detalle = ``;

  $("#pedido_listado_productos").DataTable({
    /////////////////////////////////////////////////////////////////////////////////////
          destroy: true,
          order: [],
          data: data.detalle,
          'createdRow': function (row, data, dataIndex) {
              // console.log(data);
              $(row).attr('id','row'+data.id);
          },
          'columnDefs': [
              {
                 'targets': 3,
                 'data':'id',
                 'createdCell':  function (td, cellData, rowData, row, col) {
                    //$(td).attr('id','filaPM'+row);
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
              },
              {
                title: 'ACCIONES',
                data: null,
                render: function ( data, type, row ) {
                  var html = "";
                  html = `<button type="button" class='btn btn-block' onclick="sacar_objeto_dela_orden(${data.id},${data.idOrdenar})">Quitar</button>`;
                  return html;
                }
              }
          ],
    /////////////////////////////////////////////////////////////////////////////////////
  });
  var total=Number(`${data.total}`).toFixed(2);
  var fila = `
      <div class="col bg-warning"><strong>Fecha del pedido:</strong></div>           <div class="col">${data.fechaOrden}</div>
      <div class="col  bg-warning"><strong>Total a pagar:</strong></div>           <div class="col">$ ${total}</div>
        <div class="w-100"></div>
      <div class="col-3 bg-warning"><strong>Cliente solicitante :</strong></div>           <div class="col">${data.cliente.name}</div>
        <div class="w-100"></div>
        <div class="col-3 bg-warning"><strong>Listado de productos Solicitados:</strong></div>        <br>
        

    `;
    $('#tabla_infor_pedido').html(fila);
}
////////////////////sacar de la orden////////////////////////////////////////
function sacar_objeto_dela_orden(idCompra,idOrdenar) {
  // console.log(idCompra,idOrdenar);  
  var FrmData=
  {
    idorden: idOrdenar,
    idcompra: idCompra,
  }
  // console.log(idCompra);
  // $(`#row${idCompra}`).hide();

  swal({
		title: "Estas seguro de esto?",
		text: "Si aceptas, los datos seran removidos!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        url: servidor+'/api/v0/ordenes_sacar_de_la_orden',// Url que se envia para la solicitud esta en el web php es la ruta
        method: "POST",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
          //console.log(data);
            // crear_tablaCouriers(data);
            console.log(data);
            cargar_tablaPedidos('');
            
            if (data.items == 0) {
              $(".frmPedidos_modal").modal('hide');
            }else{
              var total=Number(`${data.total}`).toFixed(2);
              var fila = `
                  <div class="col bg-warning"><strong>Fecha del pedido:</strong></div>           <div class="col">${data.fechaOrden}</div>
                  <div class="col  bg-warning"><strong>Total a pagar:</strong></div>           <div class="col">$ ${total}</div>
                    <div class="w-100"></div>
                  <div class="col-3 bg-warning"><strong>Cliente solicitante :</strong></div>           <div class="col">${data.cliente.name}</div>
                    <div class="w-100"></div>
                    <div class="col-3 bg-warning"><strong>Listado de productos Solicitados:</strong></div>        <br>
                    
  
                `;
                $('#tabla_infor_pedido').html(fila);
            }

           
            

            $(`#row${idCompra}`).hide();
        },
        error: function (err) {
            mensaje = err;
            // mensaje = "OCURRIO UN ERROR: archivo->GestionPedidos.js , función->sacar_objeto_dela_orden()";
            swal(mensaje);
        }
      });

		} else {
			swal("Cancelado!");
		}
	});

  
}
///////////////////////////////////////////////////////////////

//Cargar todos los Couriers
//****************************************************************************************************************************************************************************

function pedidos_verCouriers(idOrden) {
  //swal('oh');
  
	$("#pedido_nome_token").val(idOrden);
  cargar_tablaCouriers('');
	$(".frmCourier_modal").modal("show");
}


function cargar_tablaCouriers(value='') {
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
    url: servidor+'/api/v0/usuarios_couriers_filtro/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
    method: "GET",             // Tipo de solicitud que se enviará, llamado como método
    data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
    success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
    {
      //console.log(data);
        // crear_tablaCouriers(data);
        crear_tablaCouriers_v2(data.items);
    },
    error: function () {
        mensaje = "OCURRIO UN ERROR: archivo->GestionPedidos.js , función->cargar_tablaCouriers()";
        swal(mensaje);
    }
  });
}

function crear_tablaCouriers(data) {
  $('#tablaCouriers').html('');
    //console.log(data);
    $.each(data.items, function(a, item) { // recorremos cada uno de los datos que retorna el objero json n valores

      var fila="";

      fila=`
        <tr class="fila_${item.nome_token}">
            <th scope="row">${a+1}</th>
            <td><input type="hidden" value="${item.tipo.descripcion}">${item.tipo.descripcion}</td>
            <td><input type="hidden" value="${item.name}">${item.name}</td>
            <td><input type="hidden" value="${item.email}">${item.email}</td>
            <td><input type="hidden" value="${item.cedula}">${item.cedula}</td>
            <td><input type="hidden" value="${item.celular}">${item.celular}</td>
            <td>
              <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" onclick="pedidos_asignarCourier('${item.id}')"><strong>ASIGNAR</strong></button>
            </td>
        </tr>
      `;
        //console.log(item);
        $('#tablaCouriers').append(fila);

    });

}

function crear_tablaCouriers_v2(data) {
    // debugger
    $('#tablaCouriers').html('');
    $('#tablaCouriers_padre').html('');
    //$.get(`${apiProductos}api/v0/itemsBodega`,function (data) {
      $('#tablaCouriers_padre').DataTable({
  /////////////////////////////////////////////////////////////////////////////////////
        destroy: true,
        order: [],
        data: data,
        'createdRow': function (row, data, dataIndex) {
            //  console.log(data);
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
                title: 'TIPO',
                data: 'tipo.descripcion'
            },
            {
                title: 'NOMBRE',
                data: 'name'
            },
            {
              title: 'E-MAIL',
              data: 'email'
            },
            {
              title: 'CÉDULA',
              data: 'cedula'
            },
            {
              title: 'CELULAR',
              data: 'celular'
            },
            {
                title: 'ACCIONES',
                data: null,
                render: function (data, type, row) {

                  var html = `
                    <button type="button" class="btn btn-sm btn-outline-info" data-toggle="modal" onclick="pedidos_asignarCourier('${data.id}')"><strong>ASIGNAR</strong></button>
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
function contar_Orden(){
 

  $.ajax({
    url:servidor+ '/api/v0/contarOrden',// Url que se envia para la solicitud esta en el web php es la ruta
    method: "GET",             // Tipo de solicitud que se enviará, llamado como método
    // data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
    success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
    {

      // console.log(data);
      $('#spanCountOrden').html(data);
    },
    error: function () {
        mensaje = "error";
        swal(mensaje);
    }
  });

}

function pedidos_asignarCourier(idCourier) {
  //swal(nome_token);
	$("#fk_courier_nome_token").val(idCourier);

	var FrmData=
  {
    idOrden: $("#pedido_nome_token").val(),
		nome_token_courier: idCourier,
  }
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });

	//swal("nome_token_venta :"+FrmData.nome_token_venta+" -- nome_token_courier: "+FrmData.nome_token_courier);

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
		    url: servidor+'/api/v0/AsignarCourier/'+ FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
		    method: "PUT",             // Tipo de solicitud que se enviará, llamado como método
		    data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
		    success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
		    {
					//swal(data);
          // console.log(data);


		    	cargar_tablaPedidos('');
          $(".frmCourier_modal").modal("hide");
          contar_Orden();
          contar_Venta();
		    },
		    error: function () {
		        mensaje = "OCURRIO UN ERROR: archivo->GestionPedidos.js , función->pedidos_asignarCourier()";
		        swal(mensaje);
		    }
		  });

		} else {
			swal("Cancelado!");
		}
	});


}

//****************************************************************************************************************************************************************************

$('#filtroPedidos').keyup(function (e) {
  cargar_tablaPedidos($('#filtroPedidos').val());
});


function saber_si_hay_nuevas_ordenes() {

  // alert($('#spanCountOrden').html());

  var FrmData=
    {
      conteo: $('#spanCountOrden').html(),
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: servidor+'/api/v0/saber_si_hay_un_nuevo_pedido',// Url que se envia para la solicitud esta en el web php es la ruta
        method: "GET",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
    
          console.log('la diferencia',data);

          if (data.code=='200') {
            if (data.items != 0) {
              $('#spanCountOrden').attr('style','background:red');
              // $('#spanCountOrden').html(data);
              contar_Orden();

            } else {
              
            }
          } 

          
        },
        error: function () {
            mensaje = "OCURRIO UN ERROR : Archivo->GestionOrden.js, funcion->saber_si_hay_nuevas_ordenes()";
            swal(mensaje);
        }
      });
 }
 //
 function GP_preview_comprobante_img(id) {

  var FrmData = {
    idorden:id
  }
console.log('data:',FrmData);
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax({
    url: servidor+'/api/v0/mostrar_comprobante',// Url que se envia para la solicitud esta en el web php es la ruta
    method: "GET",             // Tipo de solicitud que se enviará, llamado como método
    data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
    success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
    {
      console.log("result:-->",data);

      if (data.items.comprobante == null) {
        $('#iframe_comprobante_img').attr('src',`/img/supercito.jpg`);
      }else{
       
        $('#iframe_comprobante_img').attr('src',`/uploads/`+data.items.nombre_img);
      }
      $('.shrinkToFit').prop('width','10 % !important');
     // showmodal escribele  el codifo para  mistraral la moodal
     $('.modal_combrobante').modal('show'); //breo que era asi
    },
    error: function () {
      $('#iframe_comprobante_img').attr('src',`/img/supercito.jpg`);

        // mensaje = "OCURRIO UN ERROR: Archivo->GestionProductosJSON.js , funcion->GP_preview_producto_img()";
        // swal(mensaje);
    }
  });


}
