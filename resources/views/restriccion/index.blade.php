@extends('adminlte::page')
@section('title', 'Restricciones')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>
@endsection
@section('js')
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <h3>Adicionar restricción</h3>
            <form id="registro-restriccion">
            @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nombre</label>
                    <input type="text" class="form-control" id="txtNombre" name="txtNombre">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Descripción</label>
                    <textarea type="text" class="form-control" id="txtDescripcion" name="txtNombre"></textarea>
                </div>
                <div class="form-group mb-0">
                    <label>Estado</label>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="rbEstadoActivo" name="rbEstado" value="Activo" checked>
                        <label  for="customRadio1" active>Activo</label> &nbsp; &nbsp; &nbsp;
                        <input type="radio" id="rbEstadoInactivo" name="rbEstado"value="Inactivo">
                        <label  for="customRadio2">Inactivo</label>
                    </div>
                <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form> 
        </div>
        <div class="col-9">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <table id="tabla-restriccion" class="table table-hover">
                    <thead>
                        <td>ID</td>
                        <td>Nombre</td>
                        <td>Descripción</td>
                        <td>Estado</td>
                        <td>Acciones</td>
                    </thead>
                </table>
            </div>
        </div>    
    </div> 
    <!--Modal para editar datos-->
    <!-- Modal -->
    <div class="modal fade" id="restriccion_edit_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Editar restriccion</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <form id="restriccion_edit_form">
                <div class="modal-body">
            @csrf
                <input type="hidden" id="txtId2">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nombre</label>
                    <input type="text" class="form-control" id="txtNombre2" name="txtNombre2">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Descripción</label>
                    <textarea type="text" class="form-control" id="txtDescripcion2" name="txtDescripcion2"></textarea>
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
</div>
<script>
    //listar registros con datatable
    $(document).ready(function(){
        var tablarestriccion = $('#tabla-restriccion').DataTable({
            processing:true,
            serverSide:true,
            ajax:{
                url: "{{ route('restriccion.index') }}",
            },
            columns:[
                {data: 'id_restriccion'},
                {data: 'nombre'},
                {data: 'descripcion'},
                {data: 'estado'},
                {data: 'action', orderable: false}
            ]
        });
    });
</script>
<script>
    //Registrar nuevo restriccion
    $('#registro-restriccion').submit(function(e){
        e.preventDefault();
        var nombre = $('#txtNombre').val();
        var descripcion = $('#txtDescripcion').val();
        var estado = $("input[name='rbEstado']:checked").val(); //solo para checkbox
        var _token = $("input[name=_token]").val();

        $.ajax({
            url: "{{ route('restriccion.registrar') }}",
            type: "POST",
            data:{
                nombre: nombre,
                descripcion: descripcion,
                estado: estado,
                _token: _token
            },
            success:function(response){
                if(response){
                    $('#registro-restriccion')[0].reset();
                    toastr.success('El registro se ingreso correctamente.','Nuevo Registro',{timeOut:3000});
                    $('#tabla-restriccion').DataTable().ajax.reload();
                }
            }
        });
    });
</script>
<script>
//eliminar un registro
    var l_id_restriccion;
    $(document).on('click','.delete', function(){
        l_id_restriccion = $(this).attr('id');

        //modal
        $('#confirModal').modal('show');
    });
    $('#btnEliminar').click(function(){
        $.ajax({
            url: "restriccion/eliminar/"+l_id_restriccion,
            beforeSend:function(){
                $('#btnEliminar').text('Eliminando...');
            },
            success:function(data){
                setTimeout(function(){
                    $('#confirModal').modal('hide');
                    toastr.warning('El registro fue eliminado correctamente.','Eliminar Registro',{timeOut:3000});
                    $('#tabla-restriccion').DataTable().ajax.reload();
                },2000);
                $('#btnEliminar').text('Eliminar');
            }
        });
    });
</script>
<script>
// editar un registro
    function editarRestriccion(id){
        //recuperamos datos
        $.get('restriccion/editar/'+id, function(restriccion){
            //asignar los datos recuperados a la ventana modal\
            $('#txtId2').val(restriccion[0].id_restriccion);
            $('#txtNombre2').val(restriccion[0].nombre);
            $('#txtDescripcion2').val(restriccion[0].descripcion);
            if(restriccion[0].estado == "Activo"){
                $('input[name=rbEstado2][value="Activo"]').prop('checked',true);
            }
            if(restriccion[0].estado == "Inactivo"){
                $('input[name=rbEstado2][value="Inactivo"]').prop('checked',true);
            }
            $("input[name=_token]").val();
            $('#restriccion_edit_modal').modal('toggle');
        });
    }
</script>
<script>
//actualizar registro
    $('#restriccion_edit_form').submit(function(e){
        e.preventDefault();
        var id2 = $('#txtId2').val();
        var nombre2 = $('#txtNombre2').val();
        var descripcion2 = $('#txtDescripcion2').val();
        var estado2 = $("input[name='rbEstado2']:checked").val(); //solo para checkbox
        var _token = $("input[name=_token]").val();
        
        $.ajax({
            url: "{{ route('restriccion.actualizar') }}",
            type: "POST",
            data: {
                id_restriccion:id2,
                nombre: nombre2,
                descripcion: descripcion2,
                estado: estado2,
                _token:_token
            },
        success:function(response){
            if(response){
                $('#restriccion_edit_modal').modal('hide');
                toastr.info('El registro fue actualizado correctamente.','Actualizar Registro',{timeOut:3000});
                    $('#tabla-restriccion').DataTable().ajax.reload();
            }
        }
        });
    });
</script>
@endsection