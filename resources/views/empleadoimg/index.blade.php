@extends('adminlte::page')
@section('title', 'empleados')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/datatables.min.css"/>
@endsection
@section('js')
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/r-2.2.6/datatables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
@endsection
@section('content')
<a href="{{ route('empleadoimg.create') }}" class="btn btn-success mb-2">Añadir Empleado</a> 
<br>

<div class="card">
    <div class="card-header">
      <h3 class="card-title">Lista de Empleados</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length" aria-controls="example1" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="example1_filter" class="dataTables_filter"><label>Buscar:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
        <thead>
            <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>CI</th>
            <th>Foto</th>
            <th>Estado</th>
            <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($empleadoimg as $e)
            <tr>
            <td>{{ $e->id }}</td>
            <td>{{ $e->nombre }}</td>
            <td>{{ $e->apellido }}</td>
            <td>{{ $e->ci }}</td>
            <td><img id="original" src="{{ url('public/image/'.$e->image) }}" height="70" width="70"></td>
            
            @if ($e->estado == "Activo")
            <td><span class="badge badge-success">{{ $e->estado }}</span></td>
            @else
            <td><span class="badge badge-warning">{{ $e->estado }}</span></td>
            @endif
                <td>    
            <form action="{{ route('empleadoimg.destroy', $e->id)}}" method="post">
            {{ csrf_field() }}
            @method('DELETE')
            <a href="{{ route('empleadoimg.edit',$e->id)}}" class="btn btn-primary">Editar</a>
            <button class="btn btn-danger" type="submit">Delete</button>
            </form>
            </td>
            </tr>
            @endforeach
            </tbody>
{!! $empleadoimg->links() !!}

    </div>
    <!-- /.card-body -->
  </div>
@endsection  
<script>/*
       $(document).ready(function(){
    $('#tabla-empleado').DataTable({
            processing:true,
            serverSide:true,
            ajax:{
                url: "{{ route('empleadoimg.index') }}",
            },
            columns:[
                {data: 'id'},
                {data: 'nombre'},
                {data: 'apellido'},
                {data: 'ci'},
                {
                    data: 'image',
                    name: 'image',
                    render: function (data, type, full, meta) {
                        return "<img src= {{ URL::to('/') }}/images/"
                        + data + "with='70' class='img-thumbnail '/>"
                    },
                    orderable: false
                },
                {data: 'estado'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
    });
    });*/
</script>
<script>/*
    //listar registros con datatable
    $(document).ready(function(){
        var tablaempleado = $('#tabla-empleado').DataTable({

            processing:true,
            serverSide:true,
            ajax:{
                url: "{{ route('empleado.index') }}",
            },
            columns:[
                {data: 'id'},
                {data: 'nombre'},
                {data: 'apellido'},
                {data: 'ci'},
                {data: 'foto'},
                {data: 'estado'},
                {data: 'action', orderable: false}
            ]
        });
    });*/
</script>
<script>/*
    //Registrar nuevo empleado
    $('#registro-empleado').submit(function(e){
        e.preventDefault();
        var nombre = $('#txtNombre').val();
        var apellido = $('#txtApellido').val();
        var ci = $('#txtCi').val();
        //var foto = $('#txtFoto').val();
        var estado = $("input[name='rbEstado']:checked").val(); //solo para checkbox
        var _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{ route('empleado.registrar') }}",
            type: "POST",
            enctype:"multipart/form-data",
            data:{
                nombre: nombre,
                apellido: apellido,
                ci: ci,
                //foto: foto,
                estado: estado,
                _token: _token
            },
            success:function(response){
                if(response){
                    $('#registro-empleado')[0].reset();
                    toastr.success('El registro se ingreso correctamente.','Nuevo Registro',{timeOut:3000});
                    $('#tabla-empleado').DataTable().ajax.reload();
                }
            }
        });
    });*/
</script>
<script>/*
//eliminar un registro
    var id;
    $(document).on('click','.delete', function(){
        id = $(this).attr('id');

        //modal
        $('#confirModal').modal('show');
    });
    $('#btnEliminar').click(function(){
        $.ajax({
            url: "empleado/eliminar/"+id,
            beforeSend:function(){
                $('#btnEliminar').text('Eliminando...');
            },
            success:function(data){
                setTimeout(function(){
                    $('#confirModal').modal('hide');
                    toastr.warning('El registro fue eliminado correctamente.','Eliminar Registro',{timeOut:3000});
                    $('#tabla-empleado').DataTable().ajax.reload();
                },2000);
                $('#btnEliminar').text('Eliminar');
            }
        });
    });*/
</script>
<script>/*
// editar un registro
    function editarEmpleado(id){
        //recuperamos datos
        $.get('empleado/editar/'+id, function(empleado){
            //asignar los datos recuperados a la ventana modal\
            $('#txtId2').val(empleado[0].id);
            $('#txtNombre2').val(empleado[0].nombre);
            $('#txtApellido2').val(empleado[0].apellido);
            $('#txtFoto2').val(empleado[0].foto);
            $('#txtCi2').val(empleado[0].ci);
            if(empleado[0].estado == "Activo"){
                $('input[name=rbEstado2][value="Activo"]').prop('checked',true);
            }
            if(empleado[0].estado == "Inactivo"){
                $('input[name=rbEstado2][value="Inactivo"]').prop('checked',true);
            }
            $("input[name=_token]").val();
            $('#empleado_edit_modal').modal('toggle');
        });
    }*/
</script>
<script>/*
//actualizar registro
    $('#empleado_edit_form').submit(function(e){
        e.preventDefault();
        var id2 = $('#txtId2').val();
        var nombre2 = $('#txtNombre2').val();
        var apellido2 = $('#txtApellido2').val();
        var ci2 = $('#txtCi2').val();
        var foto2 = $('#txtFoto2').val();
        var estado2 = $("input[name='rbEstado2']:checked").val(); //solo para checkbox
        var _token = $("input[name=_token]").val();
        
        $.ajax({
            url: "{{ route('empleado.actualizar') }}",
            type: "POST",
            data: {
                id :id2,
                nombre :nombre2,
                apellido: apellido2,
                ci: ci2,
                foto: foto2,
                estado: estado2,
                _token:_token
            },
        success:function(response){
            if(response){
                $('#empleado_edit_modal').modal('hide');
                toastr.info('El registro fue actualizado correctamente.','Actualizar Registro',{timeOut:3000});
                    $('#tabla-empleado').DataTable().ajax.reload();
            }
        }
        });
    });*/
</script>
<script>/*
    var $avatarInput, $avatarImage;
    $(function () {
        $avatarInput = $('#avatarInput');
        $avatarImage = $('#avatarImage');

        $avatarImage.on('click', function () {
            $avatarInput.click();
        });

        $avatarInput.on('change', function (){
            alert('image');
        });
    });*/
</script>
