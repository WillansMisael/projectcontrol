<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; //recupera datos de la vista
use DataTables;
use App\Models\Empleadoimg;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $empleados = Empleadoimg::where("estado","=","Activo")->get();
            return DataTables::of($empleados)
            ->addColumn('foto',function ($empleados)
            {
                $foto = '<img src="public/image/'.$empleados->image.'" height="70" width="70"/>';
                return $foto;
            })
            ->addColumn('estado',function ($empleados)
            {if($empleados->estado == "Activo"){
                $estado = '<span class="badge badge-success">Adentro</span>';
            }else {
                $estado = '<span class="badge badge-warning" style="color:white;">Salio</span>';

            }
            
                return $estado;
            })
            ->rawColumns(['foto','estado'])
            ->make(true);
        }
        return view('home');
    }
}
