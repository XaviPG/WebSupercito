//var nome_token_user;
var urlServidor="http://young-woodland-01238.herokuapp.com";
// var servidor="http://127.0.0.1:8000";
$( document ).ready(function() {
	//nome_token_user = $('#nome_token_user').val();
	//cargar_tablaTipoUsuarios('');
});


function cargar_tablaTipoUsuarios(value='') {
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
        url: urlServidor+'/api/v0/tipo_usuarios_filtro/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "GET",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
        	//console.log(data);
           	crear_tablaTipoUsuarios(data);
        },
        error: function () {
            mensaje = "OCURRIO UN ERROR : Archivo->GestionTipoUsuarios.js , funcion->cargar_tablaTipoUsuarios()";
           	swal(mensaje);
        }
	});
}

function crear_tablaTipoUsuarios(data) {
	$('#tablaTipoUsuarios').html('');
   	//console.log(data);
   	$.each(data.items, function(a, item) { // recorremos cada uno de los datos que retorna el objero json n valores

   		var fila="";
   		fila=`
	   		<tr class="fila_${item.nome_token}">
		        <th scope="row">${a+1}</th>
		      	<td><input type="hidden" value="${item.descripcion}">${item.descripcion}</td>
		      	<td>
			        <button type="button" class="btn btn-sm btn-outline-info" onclick="tipo_usuarios_ver('${item.nome_token}')" data-toggle="modal" >Modificar</button>
			        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="tipo_usuarios_eliminar('${item.nome_token}')">Eliminar</button>
		      	</td>
		    </tr>
   		`;
       	//console.log(item);
       	$('#tablaTipoUsuarios').append(fila);

   	});

}

function tipo_usuarios_ver(nome_token) {

  //var descripcion = $(`.fila_${nome_token}`).find("td").eq(0).text();
  var descripcion = $(`.fila_${nome_token}`).find("td:eq(0) input[type='hidden']").val();

  $('#nome_token_tipo_u_modal').val(nome_token);
  $('#txt_descripcion_t_u_modal').val(descripcion);
  $('.frmTipoUsuarios_modal').modal('show');
  // debugger
}

function tipo_usuarios_eliminar(nome_token) {
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
    text: "Si aceptas, los datos seran eliminados!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {

      $.ajax({
        url: urlServidor+'/api/v0/tipo_usuarios_delete/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "DELETE",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
          swal("ACCION EXITOSA!", "Datos Eliminados", "success");
          cargar_tablaTipoUsuarios('');
        },
        error: function () {
            mensaje = "OCURRIO UN ERROR : Archivo->GestionTipoUsuarios.js , funcion->tipo_usuarios_eliminar()";
            swal(mensaje);

        }
      });

    } else {
      swal("Cancelado!");
    }
  });
}
//midificar Tipo Usuario
$('#frmTipoUsuarios_modificar').on('submit',function (e) {
  e.preventDefault();
  //swal('Listo!');

  var FrmData=
  {
    nome_token:  $('#nome_token_tipo_u_modal').val(),
    descripcion: $('#txt_descripcion_t_u_modal').val(),
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
        url: urlServidor+'/api/v0/tipo_usuarios_update/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "PUT",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
          swal("ACCION EXITOSA!", "Datos Modificados", "success");
          cargar_tablaTipoUsuarios('');
          $('.frmTipoUsuarios_modal').modal('hide');
        },
        error: function () {
            mensaje = "OCURRIO UN ERROR : Archivo->GestionTipoUsuarios.js , funcion->frmTipoUsuarios_modificar()";
            swal(mensaje);

        }
      });

    } else {
      swal("Cancelado!");
    }
  });

});
// Crear un tipo de usuario
$('#frmTipoUsuarios').on('submit',function (e) {
  e.preventDefault();
  //swal('Listo!');

  var FrmData=
  {
    descripcion: $('#txt_descripcion_t_u').val(),
  }

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  swal({
    title: "Estas seguro de esto?",
    text: "Si aceptas, se creará un nuevo Rol!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {

      $.ajax({
        url: urlServidor+'/api/v0/tipo_usuarios_store/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "POST",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
          swal("ACCION EXITOSA!", "Datos Guardados", "success");
          cargar_tablaTipoUsuarios('');
          limpiar();
        },
        error: function () {
            mensaje = "OCURRIO UN ERROR : Archivo->GestionTipoUsuarios.js , funcion->: Archivo->GestionTipoUsuarios.js , funcion->frmTipoUsuarios_modificar()";
            swal(mensaje);
        }
      });

    } else {
      swal("Cancelado!");
    }
  });

});
