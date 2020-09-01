@extends('z_reportes.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4 text-primary"><img width="100px" src="<?php echo asset('')?>img/logo3.png" alt=""> Farmacias Cruz Azul</h1>
                   
                </div>
            </div>

            <div class="card">
                <table class="table table-sm">
                    <thead class="">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
