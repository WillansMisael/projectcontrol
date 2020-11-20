@extends('adminlte::page')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/datatables.min.css"/>
@endsection
@section('js')
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/datatables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-md-9 col-sm-12">
                <table id="tabla-empleado-activo" class="table table-hover">
                    <thead>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Apellido</td>
                        <td>Ci</td>
                        <td>Estado</td>
                        <td>Foto</td>
                    </thead>
                </table>
        </div>
    </div>
</div>
<script>
    //listar registros con datatable
    $(document).ready(function(){
        var tablaempleado = $('#tabla-empleado-activo').DataTable({

            processing:true,
            serverSide:true,
            ajax:{
                url: "{{ route('home') }}",
            },
            columns:[
                {data: 'id'},
                {data: 'nombre'},
                {data: 'apellido'},
                {data: 'ci'},
                {data: 'estado', orderable: false},
                {data: 'foto', orderable: false}

            ]
        });
        
    setInterval(() => {
        //console.log(1);
        $('#tabla-empleado-activo').DataTable().ajax.reload(); 
    }, 2000);
    });
</script>
@endsection
