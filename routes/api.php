<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//ProductosJs
Route::get('/v0/produtosjs', function () {
    // return echo "" . asset('/js/itemsBodega.js');
    echo "hola";// storage_path('app/public');
});
//Contar datos de tablas
Route::get('/v0/contarUser', 'UserController@contar')->name('contarUser');
Route::get('/v0/contarKit/{data}', 'KitController@contar')->name('contarKit');
Route::get('/v0/contarOrden', 'OrdenController@contar')->name('contarOrden');
Route::get('/v0/contarProducto', 'ProductoController@contar')->name('contarProducto');
Route::get('/v0/contarPromocion', 'PromocionDelProductoController@contar')->name('contarPromocion');
Route::get('/v0/contarTipo', 'TipoUsuarioController@contar')->name('contarTipo');
Route::get('/v0/contarCompra', 'CompraController@contar')->name('contarCompra');
//importar archivo excel
// Route::get('importExportView', 'ProductoController@importExportView');
Route::post('import', 'ProductoController@import')->name('import');

//TIPOS DE USUARIOS-----------------------------------------------------------------------------------------------------------------------
// Route::resource('/v0/tipo_usuarios','TipoUsuarioController');
Route::post('/v0/tipo_usuarios_store/{nome_token_user?}/{data?}','TipoUsuarioController@store')->name('api.v0.tipo_usuarios.store');
Route::get('/v0/tipo_usuarios_show/{nome_token_user?}/{data?}','TipoUsuarioController@show')->name('api.v0.tipo_usuarios.show');
Route::put('/v0/tipo_usuarios_update/{nome_token_user?}/{data?}','TipoUsuarioController@update')->name('api.v0.tipo_usuarios.update');
Route::delete('/v0/tipo_usuarios_delete/{nome_token_user?}/{data?}','TipoUsuarioController@destroy')->name('api.v0.tipo_usuarios.delete');
Route::get('/v0/tipo_usuarios_filtro/{nome_token_user?}/{data?}','TipoUsuarioController@Filtro')->name('api.v0.tipo_usuarios.filtro');
Route::get('/v0/tipo_usuarios_count','TipoUsuarioController@count')->name('api.v0.tipo_usuarios.contar');
// USUARIOS--------------------------------------------------------------------------------------------------------------------------------
//Route::resource('/v0/usuarios','UserController');
Route::post('/v0/usuarios_store/{nome_token_user?}/{data?}','UserController@store')->name('api.v0.usuarios.store');
Route::get('/v0/usuarios_show/{nome_token_user?}/{data?}','UserController@show')->name('api.v0.usuarios.show');
//Route::post('/v0/usuarios_update/{nome_token_user?}/{data?}','UserController@update')->name('api.v0.usuarios.update');
Route::put('/v0/usuarios_update/{nome_token_user?}/{data?}','UserController@update')->name('api.v0.usuarios.update');
Route::put('/v0/contrasena_update/{nome_token_user?}/{data?}','UserController@updateContrasena')->name('api.v0.usuarios.updateContrasena');
Route::delete('/v0/usuarios_delete/{nome_token_user?}/{data?}','UserController@destroy')->name('api.v0.usuarios.delete');
Route::get('/v0/usuarios_filtro/{nome_token_user?}/{data?}','UserController@Filtro')->name('api.v0.usuarios.filtro');
Route::get('/v0/todosUsuarios','UserController@todosUsuarios')->name('api.v0.usuarios.todosUsuarios');
// Route::get('/v0/usuarios_filtro/','UserController@Filtro')->name('api.v0.usuarios.filtro');
Route::get('/v0/usuarios_couriers_filtro/{nome_token_user?}/{data?}','UserController@FiltroCourier')->name('api.v0.usuarios_couriers.filtro');

Route::get('/v0/prueba','UserController@prueba')->name('api.v0.prueba.prueba');
Route::get('/v0/login/{data?}','UserController@login')->name('api.v0.usuarios.login');
Route::post('/v0/register/{data?}','UserController@register')->name('api.v0.usuarios.register');

// UBICACION DE USUARIOS--------------------------------------------------------------------------------------------------------------------------------
Route::post('/v0/ubicacion_store/{nome_token_user?}/{data?}','UbicacionController@store')->name('api.v0.ubicacion.store');



//ESTADO VENTA
Route::post('/v0/estado_ventas_store/{nome_token_user?}/{data?}','EstadoVentaController@store')->name('api.v0.estado_ventas.store');
// Route::get('/v0/estado_ventas_show/{nome_token_user?}/{data?}','EstadoVentaController@show')->name('api.v0.estado_ventas.show');
Route::put('/v0/estado_ventas_update/{nome_token_user?}/{data?}','EstadoVentaController@update')->name('api.v0.estado_ventas.update');
Route::delete('/v0/estado_ventas_delete/{nome_token_user?}/{data?}','EstadoVentaController@destroy')->name('api.v0.estado_ventas.delete');
Route::get('/v0/estado_ventas_filtro/{nome_token_user?}/{data?}','EstadoVentaController@Filtro')->name('api.v0.estado_ventas.filtro');
//VENTA
Route::post('/v0/ventas_store/{nome_token_user?}/{data?}','VentaController@store')->name('api.v0.ventas.store'); //paso uno de la venta
Route::get('/v0/ventas_show/{nome_token_user?}/{data?}','VentaController@show')->name('api.v0.ventas.show');
Route::put('/v0/ventas_update/{nome_token_user?}/{data?}','VentaController@update')->name('api.v0.ventas.update');
Route::delete('/v0/ventas_delete/{nome_token_user?}/{data?}','VentaController@destroy')->name('api.v0.ventas.delete');
Route::get('/v0/ventas_filtro/{nome_token_user?}/{data?}','VentaController@Filtro')->name('api.v0.ventas.filtro');
Route::put('/v0/ventas_asignar_courier/{nome_token_user?}/{data?}','VentaController@asignar_courier')->name('api.v0.ventas.asignar_courier'); //paso dos de la venta
Route::put('/v0/ventas_generar_pedido/{nome_token_user?}/{data?}','VentaController@generar_pedido')->name('api.v0.ventas.generar_pedido'); //paso dos de la venta
Route::get('/v0/ventas_mi_historial_pediodos/{nome_token_user?}/{data?}','VentaController@mi_historial_pediodos')->name('api.v0.ventas.mi_historial_pedidos');
Route::get('/v0/ventas_mi_historial_entregas/{nome_token_user?}/{data?}','VentaController@mi_historial_entregas')->name('api.v0.ventas.mi_historial_entregas');
Route::put('/v0/ventas_rechazar_entrega/{nome_token_user?}/{data?}','VentaController@rechazar_entrega')->name('api.v0.ventas.rechazar_entrega'); //paso dos de la venta
Route::put('/v0/vemtas_finalizar_venta/{nome_token_user?}/{data?}','VentaController@finalizar_venta')->name('api.v0.ventas.finalizar_venta'); //paso dos de la venta

Route::get('/v0/ventas_prueba','VentaController@prueba')->name('api.v0.ventas.prueba'); //paso dos de la venta
//DETALLE DE VENTAS
Route::post('/v0/detalle_ventas_store/{nome_token_user?}/{data?}','DetalleVentaController@store')->name('api.v0.detalle_ventas.store');
Route::get('/v0/detalle_ventas_show/{nome_token_user?}/{data?}','DetalleVentaController@show')->name('api.v0.detalle_ventas.show');
Route::put('/v0/detalle_ventas_update/{nome_token_user?}/{data?}','DetalleVentaController@update')->name('api.v0.detalle_ventas.update');
Route::delete('/v0/detalle_ventas_delete/{nome_token_user?}/{data?}','DetalleVentaController@destroy')->name('api.v0.detalle_ventas.delete');
Route::get('/v0/detalle_ventas_filtro/{nome_token_user?}/{data?}','DetalleVentaController@Filtro')->name('api.v0.detalle_ventas.filtro');
// Route::post('/v0/detalle_ventas_asignar_venta/{nome_token_user?}/{data?}','DetalleVentaController@asignar_venta')->name('api.v0.detalle_ventas.asignar_venta');
//PRODUCTOS
Route::post('/v0/productos_store/{nome_token_user?}/{data?}','ProductoController@store')->name('api.v0.productos.store');
Route::get('/v0/productos_show/{data?}','ProductoController@show')->name('api.v0.productos.show');
// Route::get('/v0/productos_show_con_f/{nome_token_user?}/{data?}','ProductoController@show_con_f')->name('api.v0.productos_ventas.show_con_f');
// Route::get('/v0/productos_show_con_f2/{data?}','ProductoController@show_con_f2')->name('api.v0.productos_ventas.show_con_f2');
Route::put('/v0/productos_update/{nome_token_user?}/{data?}','ProductoController@update')->name('api.v0.productos.update');
Route::delete('/v0/productos_delete/{nome_token_user?}/{data?}','ProductoController@destroy')->name('api.v0.productos.delete');
Route::get('/v0/productos_filtro/{nome_token_user?}/{data?}','ProductoController@Filtro')->name('api.v0.productos.filtro');
//Route::post('/v0/productos_guardar_img/{nome_token_user?}/{data?}','ProductoController@guardar_img')->name('api.v0.productos.guardar_img');
Route::post('/v0/productos_guardar_img/{data?}','ProductoController@guardar_img')->name('api.v0.productos.guardar_img');
Route::get('/v0/FiltroProductoPro/{nome_token_user?}/{data?}','ProductoController@FiltroProductoPro')->name('api.v0.productos.FiltroProductoPro');
Route::get('/v0/productos_Buscar/{nome_token_user?}/{data?}','ProductoController@Buscar')->name('api.v0.productos.Buscar');
//TIPO DE PROMOCIONES
Route::post('/v0/tipo_promociones_store/{nome_token_user?}/{data?}','TipoPromocionController@store')->name('api.v0.tipo_promociones.store');
Route::get('/v0/tipo_promociones_show/{nome_token_user?}/{data?}','TipoPromocionController@show')->name('api.v0.tipo_promociones.show');
Route::put('/v0/tipo_promociones_update/{nome_token_user?}/{data?}','TipoPromocionController@update')->name('api.v0.tipo_promociones.update');
Route::delete('/v0/tipo_promociones_delete/{nome_token_user?}/{data?}','TipoPromocionController@destroy')->name('api.v0.tipo_promociones.delete');
Route::get('/v0/tipo_promociones_Buscar/{nome_token_user?}/{data?}','TipoPromocionController@Buscar')->name('api.v0.tipo_promociones.Buscar');
Route::get('/v0/tipo_ObtenerTipoRelacionado/{data?}','TipoPromocionController@ObtenerTipoRelacionado')->name('api.v0.tipo_ObtenerTipoRelacionado.ObtenerTipoRelacionado');
Route::get('/v0/tipo_ConsultarTipoPromocionesPorRegistrosActivos/{data?}','TipoPromocionController@ConsultarTipoPromocionesPorRegistrosActivos')->name('api.v0.tipo.ConsultarTipoPromocionesPorRegistrosActivos');
//Route::get('/v0/tipo_ConsultarTipoPromocionesPorRegistrosActivosPorid/{data?}','TipoPromocionController@ConsultarTipoPromocionesPorRegistrosActivosPorid')->name('api.v0.tipo.ConsultarTipoPromocionesPorRegistrosActivosPorid');

//EL REGISTRO DE PROMOCIONES
Route::post('/v0/RegistroPromociones_store/{data?}','RegistroPromocionesController@store')->name('api.v0.RegistroPromociones.store');
Route::get('/v0/RegistroPromociones_filtro/{data?}','RegistroPromocionesController@filtro')->name('api.v0.RegistroPromociones.filtro');
Route::delete('/v0/RegistroPromociones_delete/{data?}','RegistroPromocionesController@destroy')->name('api.v0.RegistroPromociones.delete');
Route::get('/v0/RegistroPromociones_buscar/{data?}','RegistroPromocionesController@BuscarPromocion')->name('api.v0.RegistroPromociones.BuscarPromocion');
Route::put('/v0/RegistroPromociones_publicidad/{data?}','RegistroPromocionesController@publicidad')->name('api.v0.RegistroPromociones.publicidad');
Route::get('/v0/RegistroPromociones_filtroRegistro/{data?}','RegistroPromocionesController@filtroRegistro')->name('api.v0.RegistroPromociones.filtroRegistro');
// PROMOCIONES POR KIT
Route::post('/v0/kit_store/{data?}','KitController@store')->name('api.v0.kit.store');
Route::get('/v0/kit_filtro/{data?}','KitController@filtro')->name('api.v0.kit.filtro');
Route::delete('/v0/kit_delete/{data?}','KitController@destroy')->name('api.v0.kit.delete');
Route::put('/v0/kit_update/{data?}','KitController@update')->name('api.v0.kit.update');

//PROMOCIONES POR UN PRODUCTO
Route::post('/v0/descuentoCantidad_store/{data?}','PromocionDelProductoController@store')->name('api.v0.descuentoCantidad.store');
Route::get('/v0/descuentoCantidad_filtro/{data?}','PromocionDelProductoController@Filtro')->name('api.v0.descuentoCantidad.filtro');
Route::delete('/v0/descuentoCantidad_delete/{data?}','PromocionDelProductoController@destroy')->name('api.v0.descuentoCantidad.delete');
Route::get('/v0/ProductosActivas/{data?}','PromocionDelProductoController@ProductosActivas')->name('api.v0.promociones.ProductosActivas');
Route::get('/v0/ProductosPorid/{data?}','PromocionDelProductoController@ProductosPorid')->name('api.v0.promociones.ProductosPorid');

//compra
Route::post('/v0/ComprarProducto/{data?}','CompraController@ComprarProducto')->name('api.v0.compras.ComprarProducto');
Route::post('/v0/DesactivarNotificaciones/{data?}','NotificacionController@desactivarNotificacion')->name('api.v0.notificacion.DesactivarNotificacion');
Route::post('/v0/OrdenesCompradas/{data?}','OrdenController@ConsultarComprasHechas')->name('api.v0.compras.OrdenesPorUsuario');
Route::get('/v0/SoloPedidos/{data?}','OrdenController@SoloPedidos');
Route::put('/v0/AsignarCourier/{data?}','OrdenController@AsignarCourier');
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/v0/Filtro/{data?}','TipoPagoController@Filtro')->name('api.v0.tipoPago.Filtro');

//TRASPORTISTA
Route::get('/v0/FiltroOrdenes/{data?}','OrdenController@FiltroOrdenes')->name('api.v0.ordenes.FiltroOrdenes');
Route::get('/v0/PosicionTrasnportista/{data?}','PosiciontrasnportistaController@PosicionTrasnportista')->name('api.v0.lugar.PosicionTrasnportista');
Route::post('/v0/PosicionTrasnportista/{data?}','PosiciontrasnportistaController@store')->name('api.v0.lugar.PosicionTrasnportista');
Route::get('/v0/obtenerPosicionTrasnportista/{data?}','PosiciontrasnportistaController@PosicionTrasnportista')->name('api.v0.lugar.PosicionTrasnportista');

//DPF
Route::get('/v0/pdf', function () {
    $pdf = PDF::loadView('z_reportes.a_cuerpo');
  // $pdf = PDF::loadHtml("pdf");
   return $pdf->stream();
//    return $pdf->download();
});

//Route::post('/v0/guardarDocumentoTransaccion/{data?}','ComprobanteController@guardarDocumentoTransaccion');

Route::get('/v0/todasLasVentas/{data?}','OrdenController@todasLasVentas');

Route::get('/v0/mostrar_comprobante/{data?}','OrdenController@ImgComprobante');

Route::get('/v0/consultar_ubicacion_courier/{data?}','UserController@consultar_ubicacion_courier');

//////////orden/////////////////////////
Route::get('/v0/ordenes_show/{data?}','OrdenController@show');
Route::post('/v0/ordenes_finalizar/{data?}','OrdenController@finalizarOrden');
Route::post('/v0/ordenes_rechazar/{data?}','OrdenController@RechazarOrden');
Route::get('/v0/contar_registros','KitController@contar');

Route::get('/v0/saber_si_hay_un_nuevo_pedido/{data?}','OrdenController@saber_si_hay_un_nuevo_pedido');
Route::delete('/v0/orden_delete/{nome_token_user?}/{data?}','OrdenController@destroy');
Route::get('/v0/notificaciones_ordenes/{data?}','NotificacionController@filtro');
Route::post('/v0/guardarDocumentoTransaccion/{token}/{idTipoPago}/{total}/{latitud}/{longitud}/{promociones}/{productos}','ComprobanteController@guardarDocumentoTransaccion');
Route::post('/v0/guardarImagenUsuario/{token}','UserController@setImagenUsuario');
Route::post('/v0/ordenes_sacar_de_la_orden/{data?}','OrdenController@sacar_de_la_orden');
//donde esta el api de verComprobante?