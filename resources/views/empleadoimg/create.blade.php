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
        <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ old('nombre') }}">
        <span class="text-danger">{{ $errors->first('nombre') }}</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <strong>Apellido</strong>
        <input type="text" name="apellido" class="form-control" placeholder="Apellido" value="{{ old('apellido') }}">
        <span class="text-danger">{{ $errors->first('apellido') }}</span>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <strong>Ci</strong>
        <input type="text" name="ci" class="form-control" placeholder="ci" value="{{ old('ci') }}">
        <span class="text-danger">{{ $errors->first('ci') }}</span>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        
        <div class="form-group">
            <label for="exampleFormControlInput1">Estado</label>
            <select id="txtEstado" name="estado" class="custom-select">
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>        
            </select>
        </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <strong>Foto del empleado</strong>
        <input type="file" name="image" class="form-control" placeholder="">
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
