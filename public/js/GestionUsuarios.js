var servidor="http://young-woodland-01238.herokuapp.com";
// var servidor="http://127.0.0.1:8000";
$( document ).ready(function() {

  contar_user();
  //nome_token_user = $('#nome_token_user').val();
  //cargar_cmbTipoUsuario();
  //cargar_tablaUsuarios('');
});

function cargar_cmbTipoUsuario() {
  var FrmData=
  {
    value: '',
  }
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: servidor+'/api/v0/tipo_usuarios_filtro/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "GET",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
            //console.log(data);
            $('#cmb_tipo_u').html('');
            $.each(data.items, function(a, item) { // recorremos cada uno de los datos que retorna el objero json n valores

                var fila ="";
          fila = `<option value="${item.nome_token}">${item.descripcion}</option>`;
                $('#cmb_tipo_u').append(//identificamos ala nota que queremos add esta otra nota
                    fila
                );
               //console.log(item);
           });
        },
        error: function (err) {
            console.log(err);
            mensaje = "OCURRIO UN ERROR: Archivo->GestionUsuarios.js , funcion->cargar_cmbTipoUsuario()";
            swal(mensaje);
        }
  });
}

function cargar_tablaUsuarios(value='') {
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
    url: servidor+'/api/v0/usuarios_filtro/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
    method: "GET",             // Tipo de solicitud que se enviará, llamado como método
    data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
    success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
    {
      //console.log(data);
      // crear_tablaUsuarios(data);
      crear_tablaUsuarios_2(data.items);
    },
    error: function () {
        mensaje = "OCURRIO UN ERROR: Archivo->GestionUsuarios.js , funcion->cargar_tablaUsuarios()";
        swal(mensaje);
    }
  });
}

function crear_tablaUsuarios(data) {
  $('#tablaUsuarios').html('');
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
            <td><input type="hidden" value="${item.direccion}">${item.direccion}</td>
            <td>
               <button type="button" class="btn btn-sm btn-outline-info" onclick="usuarios_ver('${item.nome_token}')" data-toggle="modal" >Modificar</button>
              <button type="button" class="btn btn-sm btn-outline-secondary" onclick="usuarios_eliminar('${item.nome_token}')">Eliminar</button>
            </td>
        </tr>
       `;
         //console.log(item);
        $('#tablaUsuarios').append(fila);

     });

 }
 $(document).ready( function () {
  $('#myTable').DataTable();
} );
function crear_tablaUsuarios_2(data) {
  var ancho = '16%';
  $('#tablaUsuarios_padre').html('');
  $('#tablaUsuarios').html('');
  
  $('#tablaUsuarios_padre').DataTable({
/////////////////////////////////////////////////////////////////////////////////////
      destroy: true,
      order: [],
      data: data,
      'createdRow': function (row, data, dataIndex) {
          // console.log(data);
      },
      'columnDefs': [
          {
             'targets': 3,
             'data':'item.id_item',
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
              title: ' TIPO',
              width:ancho,
              data: 'tipo.descripcion'
          },
          {
              title: 'NOMBRE',
              width:ancho,
              data: 'name'
          },
          {
            title: 'E-MAIL',
            width:ancho,
            data: 'email'
          },
          {
            title: 'CÉDULA',
            width:ancho,
            data: 'cedula'
          },
          {
            title: 'CELULAR',
            width:ancho,
            data: 'celular'
          },
          {
            title: 'DIRECCIÓN',
            width:ancho,
            data: 'direccion'
          },
          {
              title: 'ACCIONES',
              width:ancho,
              data: null,
              render: function (data, type, row) {
                var html = `
                  <button type="button" class="btn btn-sm btn-default" onclick="usuarios_ver('${data.nome_token}')" data-toggle="modal" ><i class="fa fa-pencil" aria-hidden="true"></i></button>
                  <button type="button" class="btn btn-sm btn-danger" onclick="usuarios_eliminar('${data.nome_token}')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                `;

                return `${html}`;
                // return `<button>hola</button>`;

              }
          }
      ],
/////////////////////////////////////////////////////////////////////////////////////
  });
}

function usuarios_eliminar(nome_token) {

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
        url: servidor+'/api/v0/usuarios_delete/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "DELETE",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
          swal("ACCION EXITOSA!", "Datos Eliminados", "success");
          cargar_tablaUsuarios('');
          contar_user();
          
        },
        error: function () {
            mensaje = "OCURRIO UN ERROR: Archivo->GestionUsuarios.js , funcion->usuarios_eliminar()";
            swal(mensaje);

        }
      });

    } else {
      swal("Cancelado!");
    }
  });

}

function contar_user(){
 

  $.ajax({
    url:servidor+ '/api/v0/contarUser',// Url que se envia para la solicitud esta en el web php es la ruta
    method: "GET",             // Tipo de solicitud que se enviará, llamado como método
    // data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
    success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
    {

      // console.log(data);
      $('#spanCountUser').html(data);
    },
    error: function () {
        mensaje = "error";
        swal(mensaje);
    }
  });

}
function usuarios_ver(nome_token) {

  $('#nome_token_u_modal').val(nome_token);
  $("#cmb_tipo_u_modal").html($("#cmb_tipo_u").html());
  // $('#txt_nombre_u_modal').val();

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
    url:servidor+'/api/v0/usuarios_show/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
    method: "GET",             // Tipo de solicitud que se enviará, llamado como método
    data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
    success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
    {
        //console.log(data);
        $('.frmUsuarios_modal').modal('show');
        $('#cmb_tipo_u_modal').val(data.items.tipo.nome_token);
        $('#txt_nombre_u_modal').val(data.items.name);
        $('#txt_email_u_modal').val(data.items.email);
        $('#txt_cedula_u_modal').val(data.items.cedula);
        $('#txt_celular_u_modal').val(data.items.celular);
        $('#txt_direccion_u_modal').val(data.items.direccion);
        $('#txt_referencia_u_modal').val(data.items.referencia);
        $('#txt_password_u_modal').val(data.items.password2);
    },
    error: function () {
        mensaje = "OCURRIO UN ERROR: Archivo->GestionUsuarios.js , funcion->usuarios_ver()";
        swal(mensaje);
    }
  });

}

// Crear un tipo de usuario
$('#frmUsuarios').on('submit',function (e) {
  e.preventDefault();
  //swal('Listo!');

  var FrmData=
  {
    nome_token_tipo: $('#cmb_tipo_u').val(),
    name: $('#txt_nombre_u').val(),
    email:$('#txt_email_u').val(),
    cedula: $('#txt_cedula_u').val(),
    celular: $('#txt_celular_u').val(),
    direccion: $('#txt_direccion_u').val(),
    referencia: $('#txt_referencia_u').val(),
    password: $('#txt_password_u').val(),
    password2: $('#txt_password_u').val(),
  }

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  // swal( " nome_token_tipo: "+FrmData.nome_token_tipo+
  //       " name: "+FrmData.name+
  //       " email: "+FrmData.email+
  //       " cedula: "+FrmData.cedula+
  //       " celular: "+FrmData.celular+
  //       " password: "+FrmData.password+
  //       " password2: "+FrmData.password2);

  swal({
    title: "Estas seguro de esto?",
    text: "Si aceptas, se creará un nuevo usuario!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {

      $.ajax({
        url: '/api/v0/usuarios_store/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "POST",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
          swal("ACCION EXITOSA!", "Datos Guardados", "success");
          cargar_tablaUsuarios('');
          limpiar();
          contar_user();
        },
        error: function () {
            mensaje = "OCURRIO UN ERROR: Archivo->GestionUsuarios.js , funcion->frmUsuarios()";
            swal(mensaje);

        }
      });

    } else {
      swal("Cancelado!");
    }
  });
});

//filtro de usuarios
$('#filtroUsuarios').keyup(function (e) {
  cargar_tablaUsuarios($('#filtroUsuarios').val());
});

//--------modal---------------------------------------------------------------

// modificar usuarios
$('#frmUsuarios_modificar').on('submit',function (e) {
  e.preventDefault();
  //swal('Listo!');

  var FrmData=
  {
    nome_token_tipo: $('#cmb_tipo_u_modal').val(),
    name: $('#txt_nombre_u_modal').val(),
    email:$('#txt_email_u_modal').val(),
    cedula: $('#txt_cedula_u_modal').val(),
    celular: $('#txt_celular_u_modal').val(),
    direccion: $('#txt_direccion_u_modal').val(),
    referencia: $('#txt_referencia_u_modal').val(),
    password: $('#txt_password_u_modal').val(),
    password2: $('#txt_password_u_modal').val(),
    nome_token:  $('#nome_token_u_modal').val(),
  }

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  console.log(FrmData);
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
        url:servidor+'/api/v0/usuarios_update/'+$('#nome_token_user').val()+'/'+FrmData,// Url que se envia para la solicitud esta en el web php es la ruta
        method: "PUT",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
          swal("ACCION EXITOSA!", "Datos Modificados", "success");
          cargar_tablaUsuarios('');
          $('.frmUsuarios_modal').modal('hide');
          //console.log(data);
        },
        error: function () {
            mensaje = "OCURRIO UN ERROR : Archivo->GestionUsuarios.js , funcion->frmUsuarios_modificar()";
            swal(mensaje);

        }
      });

    } else {
      swal("Cancelado!");
    }
  });
});


//ver password
$('#btnVerPassword').mousedown(function (e) {
  //e.preventDefault();
  $('#txt_password_u_modal').attr('type','text');
});
$('#btnVerPassword').mouseup(function (e) {
  //e.preventDefault();
  $('#txt_password_u_modal').attr('type','password');
});

//-----fin de la modal------------------------------------------------------------------------
