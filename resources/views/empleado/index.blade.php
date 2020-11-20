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
<div class="container-fluid">
    <div class="row">

         
        <div class="col-md-3 col-sm-12">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Adicionar empleado</h3>
                </div>
        
            <form id="registro-empleado" >
                <div class="card-body">

            @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nombre</label>
                    <input type="text" class="form-control" id="txtNombre" name="txtNombre">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Apellido</label>
                    <input type="text" class="form-control" id="txtApellido" name="txtApellido">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Ci</label>
                    <input type="text" class="form-control" id="txtCi" name="txtCi">
                </div>
                <img src="" alt="Imagen de perfil" id="avatarImage" >
                <div class="form-group">
                    <input type="file"  id="avatarInput">
                    <label for="exampleFormControlInput1">Foto</label>
                    <input type="text" class="form-control" id="txtFoto" name="txtFoto">
                </div>
                <div class="form-group mb-0">
                    <label>Estado</label>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="rbEstadoActivo" name="rbEstado" value="Activo" checked>
                        <label  for="customRadio1" active>Activo</label> &nbsp; &nbsp; &nbsp;
                        <input type="radio" id="rbEstadoInactivo" name="rbEstado"value="Inactivo">
                        <label  for="customRadio2">Inactivo</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Registrar</button>
            
            </form> 
                                
        </div>
        </div>
        </div>
        <div class="col-md-9 col-sm-12">
                <table id="tabla-empleado" class="table table-hover">
                    <thead>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Apellido</td>
                        <td>Ci</td>
                        <td>Foto</td>
                        <td>Estado</td>
                        <td>Acciones</td>
                    </thead>
                </table>
        </div>
    </div>
    <!--Modal para editar datos-->
    <!-- Modal -->
    <div class="modal fade" id="empleado_edit_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Editar empleado</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <form id="empleado_edit_form">
                <div class="modal-body">
            @csrf
                <input type="hidden" id="txtId2">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nombre</label>
                    <input type="text" class="form-control" id="txtNombre2" name="txtNombre2">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Apellido</label>
                    <input type="text" class="form-control" id="txtApellido2" name="txtApellido2">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Ci</label>
                    <input type="text" class="form-control" id="txtCi2" name="txtCi2">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Foto</label>
                    <input type="text" class="form-control" id="txtFoto2" name="txtFoto2">
                </div>
                <div class="form-group mb-0">
                    <label>Estado</label>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="rbEstadoActivo2" name="rbEstado2" value="Activo" >
                        <label  for="customRadio1" active>Activo</label> &nbsp; &nbsp; &nbsp;
                        <input type="radio" id="rbEstadoInactivo2" name="rbEstado2"value="Inactivo">
                        <label  for="customRadio2">Inactivo</label>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
        </form> 
        </div>
    </div>
    </div>
    <!--fin-->
        <!-- Modal eliminar -->
        <div class="modal fade" id="confirModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
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
</div>
<script>
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
    });
</script>
<script>
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
    });
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
    });
</script>
<script>
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
    }
</script>
<script>
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
    });
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
@endsection