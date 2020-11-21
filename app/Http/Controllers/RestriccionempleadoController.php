<?php

namespace App\Http\Controllers;

use App\Models\Restriccionempleado;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; //recupera datos de la vista
use DataTables;

class RestriccionempleadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request){

        $empleado = DB::select('exec listar_empleado');
        $restriccion = DB::select('exec listar_restriccion');
        if($request->ajax()){
            $empleadorestriccion = DB::select('exec listar_empleado_restriccion');
            return DataTables::of($empleadorestriccion)
                ->addColumn('action', function($empleadorestriccion){
                $acciones = '&nbsp;<button type="button" name="delete" id="'.$empleadorestriccion->id.'" class="delete btn btn-danger btn-sm"> Eliminar </a> ';
                return $acciones;
            })
            ->rawColumns(['action'])
                    
                    ->make(true);
        }
        return view('restriccionempleado.index')->with(['restriccion'=>$restriccion,'empleado'=>$empleado]);
    }
    public function registrar(Request $request){
        //llamar al procedimiento de almacenado
        $empleadorestriccion = DB::statement("exec registrar_empleado_restriccion '$request->empleado', '$request->restriccion'");
        return back();
    }
    public function eliminar($id){
        $empleadorestriccion = DB::statement("exec  eliminar_empleado_restriccion $id");
        return back();
    }
}
