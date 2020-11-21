@extends('adminlte::page')
@section('title', 'empleados')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>
@endsection
@section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
@endsection
@section('content')
<a href="{{ route('empleadoimg.create') }}" class="btn btn-success mb-2">Añadir Empleado</a> 
<br>

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
                        <td>Acciones</td>
                    </thead>
                </table>
        </div>
    </div>
</div>


 <!-- Modal eliminar -->
 <div class="modal fade" id="confirModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirmacion</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Quiere eliminar el registro?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
            <button type="button" id="btnEliminar" name="btnEliminar" class="btn btn-danger">Eliminar</button>
        </div>
        </div>
    </div>
    </div>


<script>
       $(document).ready(function(){
        var tablaempleado = $('#tabla-empleado-activo').DataTable({

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
                {data: 'estado', orderable: false},
                {data: 'foto', orderable: false},
                {data: 'acciones', orderable: false}
            ]
        });
       });
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
<script>
//eliminar un registro
    var id;
    $(document).on('click','.delete', function(){
        id = $(this).attr('id');

        //modal
        $('#confirModal').modal('show');
    });
    $('#btnEliminar').click(function(){
        $.ajax({
            url: "empleadoimg/eliminar/"+id,
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
    });
</script>
    @endsection  
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
