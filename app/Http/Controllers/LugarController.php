<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; //recupera datos de la vista
use DataTables;

class LugarController extends Controller
{
    public function index(Request $request){

        if($request->ajax()){
            $lugares = DB::select('exec listar_lugar');
            return DataTables::of($lugares)
                    ->addColumn('action', function($lugares){
                        $acciones = '<a href="javascript:void(0)" onclick="editarLugar('.$lugares->id_lugar.')" class="btn btn-info btn-sm"> Editar <a/>';
                        $acciones .= '&nbsp;<button type="button" name="delete" id="'.$lugares->id_lugar.'" class="delete btn btn-danger btn-sm"> Eliminar </a> ';
                        return $acciones;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('lugar.index');
    }

    public function registrar(Request $request){
        //llamar al procedimiento de almacenado
        $lugares = DB::statement("exec registrar_lugar '$request->nombre','$request->descripcion','$request->estado'");
        return back();
    }

    public function eliminar($id){
        $lugar = DB::statement("exec eliminar_lugar $id");
        return back();
    }

    public function editar($id){
        $lugar = DB::select("exec editar_lugar $id");
        return response()->json($lugar);
    }

    public function actualizar(Request $request){
        $lugar = DB::statement("exec actualizar_lugar '$request->id_lugar', '$request->nombre', '$request->descripcion', '$request->estado'");
        return back();
    } 
}
