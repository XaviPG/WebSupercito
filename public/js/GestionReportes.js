$( document ).ready(function(e) {
  // $("#fechas").hide();
  $("#hasta").hide();
  $("#desde").hide();
  $("#btn_consultarxfecha").hide();
  
  
  // console.log($('#cmb_tipo_reporte').val());
});

$('#cmb_tipo_reporte').change(function (e) {
  console.log($('#cmb_tipo_reporte').val());
  if ($('#cmb_tipo_reporte').val()==='pedidos') {
    crear_estructura_repor_pedidos();
  }
});

function crear_estructura_repor_usuarios() {

  var html = `
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Nombre:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm limpiar" id="txt_nombre_u" placeholder="col-form-label-sm" required>
    </div>
  </div>
  `;

}

function crear_estructura_repor_pedidos() {

  var html = `
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Fecha de Inicio:</label>
    <div class="col-sm-10">
      <input type="date" class="form-control form-control-sm limpiar" value="${$('#fecha_inicio').val()}">
    </div>
  </div>
  <div class="form-group row">
    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Fecha de Fin:</label>
    <div class="col-sm-10">
      <input type="date" class="form-control form-control-sm limpiar" value="${$('#fecha_inicio').val()}">
    </div>
  </div>
  `;
  $('#ReporteContenido').append(html);
}

function generarPDF() {
  console.log('hola');
  var doc = new jsPDF()
  var html = `<p>hola</p>`;
  doc.text(html, 10, 10)
  doc.save('a4.pdf')
}


var doc = new jsPDF();
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};

$('#cmd').on("click",function (e) {

    e.preventDefault();

    doc.fromHTML($('#content').html(), 15, 15, {
        'width': 170,
            'elementHandlers': specialElementHandlers
    });
    doc.save('sample-file.pdf');
});
$("#check_consultar").on("click",function () {

  console.log("ahfkadhfksjdfhs",$("#check_consultar").prop('checked'));

  if($("#check_consultar").prop('checked')==true){
    $("#hasta").show(); 
    $("#desde").show(); 
    $("#btn_consultarxfecha").show();
  
  }else if($("#check_consultar").prop('checked')==false){ 
    $("#hasta").hide();
    $("#desde").hide();
    $("#btn_consultarxfecha").hide();
    cargar_todas_ventas($("#filtroVentas").val());
  }
  // $("#fecha_hasta").attr("hide", false);
});


$("#jqueryPrinf").on("click",function (e) {
  e.preventDefault();
  $("#content").print({
    globalStyles: true,
    mediaPrint: false,
    stylesheet: null,
    noPrintSelector: ".no-print",
    iframe: true,
    append: null,
    prepend: null,
    manuallyCopyFormValues: true,
    deferred: $.Deferred(),
    timeout: 750,
    title: null,
    doctype: '<!doctype html>'
  });
});

$('#btn_consultarxfecha').click(function (e) {
  var fecha1=$('#fecha_desde').val();
  var fecha2=$('#fecha_hasta').val();
  var FrmData=
  {
    fecha_inicio:fecha1,
    fecha_fin:fecha2
    // todos:'1'
    
  }
  //  debugger
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });

  $.ajax({
    url: '/api/v0/todasLasVentas/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
    method: "GET",             // Tipo de solicitud que se enviará, llamado como método
    data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
    success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
    {
        // crear_tablaVentas(data);
        console.log("hola esto es una prueba:", data);
         $('#cardReportes').show();
         $('#contenido_ventas').show();
         $('#tablaReporteVentas').show();
        //  $("#hasta").show(); 
        crear_reportes_tablaVentas(data);
    },
    error: function () {
        mensaje = "OCURRIO UN ERROR: Archivo->GestionReportes.js , funcion->cargar_tablaVentas()";
        swal(mensaje);
    }
  });

});

$('#cmbTipoReporte').change(function (e) {

  if ($('#cmbTipoReporte').val()=="ventas") {
    cargar_todas_ventas($("#filtroVentas").val());
  }
  // else if($('#cmbTipoReporte').val()=="usuarios") {
  //   var FrmData=
  //   {
  //     value: "",
  //     value2: 'usuarios',
  //   }
  //   $.ajaxSetup({
  //         headers: {
  //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //         }
  //   });
 
  //   $.ajax({
  //     url: '/api/v0/todosUsuarios',// Url que se envia para la solicitud esta en el web php es la ruta
  //     method: "GET",             // Tipo de solicitud que se enviará, llamado como método
  //     //data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
  //     success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
  //     {
  //         // crear_tablaVentas(data);
  //         crear_reportes_tablaUsuario(data);
  //     },
  //     error: function () {
  //         mensaje = "OCURRIO UN ERROR: Archivo->GestionReportes.js , funcion->cargar_tablaVentas()";
  //         swal(mensaje);
  //     }
  //   });
  // }
});
// $('#cmbTipoReporte').change(function (e) {

//   if ($('#cmbTipoReporte').val()=="usuarios") {
//     var FrmData=
//     {
//       value: "",
//       value1: 'usuarios',
//     }
//     $.ajaxSetup({
//           headers: {
//               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//           }
//     });
 
//     $.ajax({
//       url: '/api/v0/todosUsuarios',// Url que se envia para la solicitud esta en el web php es la ruta
//       method: "GET",             // Tipo de solicitud que se enviará, llamado como método
//       //data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
//       success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
//       {
//           // crear_tablaVentas(data);
//           crear_reportes_tablaUsuario(data);
//       },
//       error: function () {
//           mensaje = "OCURRIO UN ERROR: Archivo->GestionReportes.js , funcion->cargar_tablaVentas()";
//           swal(mensaje);
//       }
//     });
//   }
// });


function cargar_todas_ventas(value='') {
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
        crear_reportes_tablaVentas(data);
        $('#cardReportes').show();
         $('#contenido_ventas').show();
         $('#tablaReporteVentas').show()
    },
    error: function () {
        mensaje = "OCURRIO UN ERROR: Archivo->GestionVentas.js , funcion->cargar_tablaVentas()";
        swal(mensaje);
    }
  });
}

function crear_reportes_tablaVentas(data) {
  $('#tablaVentas_reporte').html('');

  $.each(data.items, function(a, item) { // recorremos cada uno de los datos que retorna el objero json n valores
    var total=Number(`${item.total}`).toFixed(2);
    var courier ='';
                  if (item.idcourier==null) {
                    courier = `<td><input type="hidden" value="">Indefinido</td>`;
                   
                  }else {
                    courier = `<td><input type="hidden" value="${item.courier.name}">${item.courier.name}</td>`;
                  }
    var fila="";
    fila=`
      <tr class="fila_${item.nome_token}">
          <th scope="row">${a+1}</th>
          <td><input type="hidden" value="${item.fechaOrden}">${item.fechaOrden}</td>
          <td><input type="hidden" value="${item.usuarios.name}">${item.usuarios.name}</td>
          ${courier}
          <td><input type="hidden" value="${item.tipo_pago.descricion}">${item.tipo_pago.descricion}</td>
          <td><input type="hidden" value="${item.estado.descripcion}">${item.estado.descripcion}</td>
          <td><input type="hidden" value="${item.total}">$ ${total}</td>
         
      </tr>
    `;

      $('#tablaVentas_reporte').append(fila);

  });

}

function crear_reportes_tablaUsuario(data) {
  $('#tablaUsuario_reporte').html('');

  $.each(data.items, function(a, item) { // recorremos cada uno de los datos que retorna el objero json n valores

    var fila="";
    fila=`
      <tr class="fila_${item.nome_token}">
          <th scope="row">${a+1}</th>
          <td><input type="hidden" value="${item.name}">${item.name}</td>
          <td><input type="hidden" value="${item.email}">${item.usuarios.email}</td>
         
         
      </tr>
    `;
    console.log(data);

      $('#tablaUsuario_reporte').append(fila);

  });

}