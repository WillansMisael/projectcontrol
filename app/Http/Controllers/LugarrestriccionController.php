<?php

namespace App\Http\Controllers;

use App\Models\Lugarrestriccion;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; //recupera datos de la vista
use DataTables;

class LugarrestriccionController extends Controller
{
    public function index(Request $request){

        $lugar = DB::select('exec listar_lugar');
        $restriccion = DB::select('exec listar_restriccion');
        if($request->ajax()){
            $lugarrestriccion = DB::select('exec listar_lugar_restriccion');
            return DataTables::of($lugarrestriccion)
                ->addColumn('action', function($lugarrestriccion){
                $acciones = '&nbsp;<button type="button" name="delete" id="'.$lugarrestriccion->id.'" class="delete btn btn-danger btn-sm"> Eliminar </a> ';
                return $acciones;
            })
            ->rawColumns(['action'])
                    
                    ->make(true);
        }
        return view('lugarrestriccion.index')->with(['restriccion'=>$restriccion,'lugar'=>$lugar]);
    }
    public function registrar(Request $request){
        //llamar al procedimiento de almacenado
        $lugarrestriccion = DB::statement("exec registrar_lugar_restriccion '$request->lugar', '$request->restriccion'");
        return back();
    }
    public function eliminar($id){
        $lugarrestriccion = DB::statement("exec eliminar_lugar_restriccion $id");
        return back();
    }
}
