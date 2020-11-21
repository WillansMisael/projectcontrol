<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; //recupera datos de la vista
use DataTables;
use Intevention\Image\Facades\Image;
class EmpleadoController extends Controller
{
    
    public function eliminar($id){
        $empleadoimg = DB::statement("exec eliiminar_empleado $id");

        return back();
    }

}
