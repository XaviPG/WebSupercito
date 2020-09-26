//Declaracion de variables globales...
//-----------------------------------------------------------------------------------------
// var apiProductos = "http://192.168.137.1:8080/FarmaciaApis/public/"
var apiProductos = "http://localhost:8080/FarmaciaApis/public/"
//-----------------------------------------------------------------------------------------
$( document ).ready(function() {
    // $('#btnVerFrmTipoUsuarios').hide();
    // $('#btnVerFrmUsuarios').hide();
    // $('#btnVerFrmVentas').hide();
    ocultar();
    $('#fondo').show();
	$('.form-control').attr('placeholder','');
	$('input[type=submit]').val(`Guardar`);
	$('#btnGuardarImagenProducto').attr('hidden',true);
  // $('.col-form-label').append(`<strong>${$('.col-form-label').val()}</strong>`);

});

// function popover(nome_token){
//   $(`popover_${nome_token}`).popover({
//     trigger: 'focus'
//   });
// }

$('.popover-dismiss').popover({
  trigger: 'focus'
});

function ocultar(argument) {
	$('#fondo').hide();
  $('#cardTipoUsuarios').hide();
  $('#cardUsuarios').hide();
  $('#cardProductos').hide();
  $('#cardIngreso').hide();
  $('#cardregistrokit').hide();
  $('#cardPedidos').hide();
  $('#cardVentas').hide();
  $('#cardReportes').hide();
  $('#cardUbicacion').hide()
  

}
// function contar(){
// 	var FrmData=
// 	{

// 	}
// 	$.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });

//     $.ajax({
//         url: '/api/v0/tipo_usuarios_count',// Url que se envia para la solicitud esta en el web php es la ruta
//         method: "GET",             // Tipo de solicitud que se enviará, llamado como método
//         data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
//         success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
//         {

// 			$('#spanCount').val();
//         },
//         error: function () {
//             mensaje = "ERROR";
//            	swal(mensaje);
//         }
// 	});
// }

// //spamcount
// $('#spanCount').click(function (e) {
// 	contar();
// });

function mostrar(argument) {
	$('#fondo').hide();
  $('#cardTipoUsuarios').show();
  $('#cardUsuarios').show();
  $('#cardProductos').show();
  $('#cardPedidos').show();
  $('#cardVentas').show();
//   $('#cardReportes').show();
  $('#cardIngreso').show();
  $('#cardregistrokit').show();


}

function limpiar() {
	$('input[type="text"]').val(null);
	$('input[type="email"]').val(null);
	$('input[type="password"]').val(null);
	// $('.password').attr('type','text');

}
function comboReporte() {
if ($("#cmbTipoReporte").html()=="Escoger...");
$("#tablaReporteVentas").hide();

}
function cargarMenu() {
	var menu = ['Roles','Usuarios','Ventas'];
	// $.each(menu, function( index, value ) {

	// });
	$( "#menuOpciones" ).html('');
	$.each(menu, function( index, item ) {
	  	$("#menuOpciones").append(
	  		`<button class="btn btn-secondary btn-lg btn-block">
	  			<div class="row fa fa-users"></div>
	  			<div class="row"><div class="col-md-12">${item}</div>
	  		</button>`
	   	);
	});
}


//Botones Principales
//****************************************************************************************************************************************************************************

//boton TipoUsuarios
$('#btnVerFrmTipoUsuarios').click(function (e) {
	ocultar();
	limpiar();
	$("#menuPanel").html("Panel de Control / Roles de Usuario");
  cargar_tablaTipoUsuarios('');
	$('#cardTipoUsuarios').show();
	
	//cargar_frm_tipo_usuarios();
});

//boton Usuarios
$('#btnVerFrmUsuarios').click(function (e) {
	ocultar();
	limpiar();
  cargar_cmbTipoUsuario();
  cargar_tablaUsuarios('');
	$('#cardUsuarios').show();
	$("#menuPanel").html("Panel de Control / Usuarios");
	//cargar_frm_usuarios();
});

//boton Ventas
$('#btnVerFrmVentas').click(function (e) {
	ocultar();
  cargar_tablaVentas('');
	$('#cardVentas').show();
	$("#menuPanel").html("Panel de Control / Ventas");
	//cargar_frm_ventas();
});

//boton Pedidos
$('#btnVerFrmPedidos').click(function (e) {
	ocultar();
	$('#spanCountOrden').attr('style','background:gray');
	$("#menuPanel").html("Panel de Control / Ordenes");
  cargar_tablaPedidos('');
	$('#cardPedidos').show();
	//cargar_frm_ventas();
});

//boton Productos
$('#btnVerFrmProductos').click(function (e) {
	ocultar();
	limpiar();
	cargar_tablaProductos('');
	$("#menuPanel").html("Panel de Control / Productos");
	$('#cardProductos').show();

});
//boton Promocion
$('#btnVerFrmPromocion').click(function (e) {
	ocultar();
	limpiar();
	cargar_tablaRegistro();
	$("#menuPanel").html("Panel de Control / Promociones");
	$('#cardIngreso').show();

});
$('#btnVerFrmkits').click(function (e) {
	ocultar();
	limpiar();
	comboReporte();
	$('#cardregistrokit').show();
	$("#menuPanel").html("Panel de Control / Kits");

});


$('#btnVerFrmReportes').click(function (e) {
  ocultar();
  $("#menuPanel").html("Panel de Control / Reportes");
  $('#cardReportes').show();
  $('#contenido_ventas').hide();
  $('#tablaReporteVentas').hide();
  
  

//   $('#cardReportes').show();
  
  $("#cmbTipoReporte").val("0");
 

});



$('#btnVerFrmUbicacion').click(function (e) {
  ocultar();
  $("#menuPanel").html("Panel de Control / Ubicación de Couries");
  // iniciarMap();
  $('#cardUbicacion').show();
});

//*****************************************************************************************************************************************************************************

$('.ver_password').mousedown(function (e) {
	$('.password').attr('type','text');
});

$('.ver_password').mouseup(function (e) {
	$('.password').attr('type','password');
});

$('.password').keyup(function (e) {

	$('.password').attr('type','password');
});
