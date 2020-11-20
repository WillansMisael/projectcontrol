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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postNewImage(Request $request)
    {
        $this->validate($request,[
            'photo' => 'required|image'
        ]);
     
    }
    public function index(Request $request)
    {
        //
        if($request->ajax()){
            $empleados = DB::select('call listar_empleado');
            return DataTables::of($empleados)
                    ->addColumn('action', function($empleados){
                        $acciones = '<a href="javascript:void(0)" onclick="editarEmpleado('.$empleados->id.')" class="btn btn-info btn-sm"> Editar <a/>';
                        $acciones .= '&nbsp;<button type="button" name="delete" id="'.$empleados->id.'" class="delete btn btn-danger btn-sm"> Eliminar </a> ';
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('empleado.index');
    }
    public function registrar(Request $request){

        $nombre = $request->file('AvtarInput')->getClientOriginalName();
        $ruta = storage_path().'\app\public\images/'.$nombre;
        
        //llamar al procedimiento de almacenado
        $empleados = DB::select('CALL registrar_empleado(?,?,?,?,?)',
            [$request->nombre, $request->apellido,$ruta, $request->estado, $request->ci]);
        return back();
    }
    public function editar($id){
        $empleado = DB::select('CALL editar_empleado(?)',[$id]);
        return response()->json($empleado);
    }
    public function actualizar(Request $request){
        $empleado = DB::select('CALL actualizar_empleado(?,?,?,?,?,?)',
        [$request->id, $request->nombre, $request->apellido,$request->foto, $request->estado, $request->ci]);
        return back();
    } 
    public function eliminar($id){
        $empleado = DB::select('CALL eliminar_empleado(?)',[$id]);
        return back();
    }

}
