<?php

namespace App\Http\Controllers;

use App\Models\Restriccion;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; //recupera datos de la vista
use DataTables;


class RestriccionController extends Controller
{
    public function index(Request $request){

        if($request->ajax()){
            $restricciones = DB::select('exec listar_restriccion');
            return DataTables::of($restricciones)
                    ->addColumn('action', function($restricciones){
                        $acciones = '<a href="javascript:void(0)" onclick="editarRestriccion('.$restricciones->id_restriccion.')" class="btn btn-info btn-sm"> Editar <a/>';
                        $acciones .= '&nbsp;<button type="button" name="delete" id="'.$restricciones->id_restriccion.'" class="delete btn btn-danger btn-sm"> Eliminar </a> ';
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('restriccion.index');
    }

    public function registrar(Request $request){
        //llamar al procedimiento de almacenado
        $restricciones = DB::statement("exec registrar_restriccion '$request->nombre','$request->descripcion','$request->estado'");
        return back();
    }

    public function eliminar($id){
        $restriccion = DB::statement("exec eliminar_restriccion $id");
        return back();
    }

    public function editar($id){
        $restriccion = DB::select("exec editar_restriccion $id");
        return response()->json($restriccion);
    }

    public function actualizar(Request $request){
        $restriccion = DB::statement("exec actualizar_restriccion '$request->id_restriccion', '$request->nombre', '$request->descripcion', '$request->estado'");
        return back();
    } 
}
