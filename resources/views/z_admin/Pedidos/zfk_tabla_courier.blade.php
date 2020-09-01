<!--tabla_foranea.blade.php -->
<!-- <strong>Lista de Tranportistas</strong> -->
 {{-- <input type="text" id="filtroUsuarios"> --}}
<div class="table-responsive">
  <table id="tablaCouriers_padre" class="display" style="width: 100%!important;">
    <thead>
      <tr>
        {{-- <th scope="col">#</th> --}}
        <th scope="col">Tipo</th>
        <th scope="col">Nombre</th>
        <th scope="col">Email</th>
        <th scope="col">Cédula</th>
        <th scope="col">Celular</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody id="tablaCouriers">
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>Mark</td>
        <td>Otto</td>
        <td>Mark</td>
        <td>
          <button type="button" class="btn btn-sm btn-outline-info">Asignar</button>  
        </td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>Mark</td>
        <td>Otto</td>
        <td>Mark</td>
        <td>
          <button type="button" class="btn btn-sm btn-outline-info">Asignar</button>  
        </td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>Mark</td>
        <td>Otto</td>
        <td>Mark</td>
        <td>
          <button type="button" class="btn btn-sm btn-outline-info">Asignar</button>   
        </td>
      </tr>
    </tbody>
  </table>
</div>