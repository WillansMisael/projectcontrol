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
<h2 style="margin-top: 12px;" class="text-left">Añadir Empleado</a></h2>
<br>
<form action="{{ route('empleadoimg.store') }}" method="POST" name="add_empleadoimg" enctype="multipart/form-data">
@csrf


<div class="col-md-6">
    <div class="form-group">
        <strong>Nombre</strong>
        <input type="text" name="nombre" class="form-control" placeholder="Nombre">
        <span class="text-danger">{{ $errors->first('nombre') }}</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <strong>Apellido</strong>
        <input type="text" name="apellido" class="form-control" placeholder="Apellido">
        <span class="text-danger">{{ $errors->first('apellido') }}</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <strong>Ci</strong>
        <input type="text" name="ci" class="form-control" placeholder="ci">
        <span class="text-danger">{{ $errors->first('ci') }}</span>
    </div>
</div>
<div class="row">
<div class="form-group">
    <label for="exampleFormControlInput1">Estado</label>
    <select id="txtEstado" name="estado" class="custom-select">
            <option value="Activo">Activo</option>
            <option value="Inactivo">Inactivo</option>        
      </select>
</div>
<div class="col-md-3">
    <div class="form-group">
        <strong>Image</strong>
        <input type="file" name="image" class="form-control" placeholder="">
        <span class="text-danger">{{ $errors->first('image') }}</span>
    </div>
</div>
</div>
<div class="col-md-6 text-center">
    <button type="submit" class="btn btn-primary btn-lg">Añadir empleado</button>
</div>
</div>
</form>
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
