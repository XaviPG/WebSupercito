


function todasLasVentas() {
 
    var FrmData=
    {
      value: '',
      value2: 'ventas',
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: servidor+'/api/v0/todasLasVentas',// Url que se envia para la solicitud esta en el web php es la ruta
        method: "GET",             // Tipo de solicitud que se enviará, llamado como método
        data: FrmData,               // Datos enviaráados al servidor, un conjunto de pares clave / valor (es decir, campos de formulario y valores)
        success: function (data)   // Una función a ser llamada si la solicitud tiene éxito
        {
    
          // console.log(data);
          crear_tabla_ventas(data.items);
        },
        error: function () {
            mensaje = "OCURRIO UN ERROR : Archivo->Gestionventas.js, funcion->cargar_tablaVentas()";
            swal(mensaje);
        }
      });
}

function crear_tabla_ventas(data) {
    // debugger
    var ancho ="25%";
    $('#tablaVentas').html('');
    $('#tablaVentas_padre').html('');
    //$.get(`${apiProductos}api/v0/itemsBodega`,function (data) {
      $('#tablaVentas_padre').DataTable({
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
                title: 'TRANSPORTE',
                width:ancho,
                data: null,
                render: function ( data, type, row ) {
  
                  var html = `
                    <button type="button" class="btn btn-sm btn-outline-success" onclick="ventas_verCouriers('${data.id}')">Asignar </button>
                  `;
  
                  return `${html}`;
  
                }
            },
            {
                title: 'ACCIONES',
                width:ancho,
                data: null,
                render: function (data, type, row) {
  
                  var html = `
                    <button type="button" class="btn btn-sm btn-outline-info" onclick="ventas_ver2('${data.nome_token}')" data-toggle="modal" ><i class="fa fa-eye" aria-hidden="true"></i></button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="ventas_eliminar('${data.nome_token}')"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
 
 