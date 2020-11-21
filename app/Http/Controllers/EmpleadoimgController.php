<?php

namespace App\Http\Controllers;
use App\Models\Empleadoimg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Redirect;
use DataTables; 
use Intervention\Image\ImageManagerStatic as Image;   
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;

class EmpleadoimgController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if($request->ajax()){
            $empleados = DB::select('exec listar_empleado');
            return DataTables::of($empleados)
            ->addColumn('acciones', function($empleados){
                $acciones = "<a href='empleadoimg/edit/$empleados->id' class='btn btn-info btn-sm'> Editar <a/>";
                $acciones .= "&nbsp;<button type='button' name='delete' id='$empleados->id' class= 'delete btn btn-danger btn-sm'> Eliminar </a> ";
                
                // $acciones .= "<a href='empleadoimg/$empleados->id'  method='post' class='btn btn-danger btn-sm'> Eliminar <a/>";
               // $acciones .= '&nbsp;<button type="button" name="delete" id="'.$empleados->id.'" class="delete btn btn-danger btn-sm"> Eliminar </a> ';
               /* $acciones .= "<form action='{{ route('empleadoimg.destroy', $empleados->id)}}' method='post'>
                                <button type='button' name='delete' id=$empleados->id class='delete btn btn-danger btn-sm'> Eliminar </a>
                            </form>";
                */
               return $acciones;
            })
            ->addColumn('foto',function ($empleados)
            {
                $foto = '<img src="public/image/'.$empleados->image.'" height="70" width="70"/>';
                return $foto;
            })
            ->addColumn('estado',function ($empleados)
            {if($empleados->estado == "Activo"){
                $estado = '<span class="badge badge-success">'.$empleados->estado.'</span>';
            }else {
                $estado = '<span class="badge badge-warning" style="color:white;">'.$empleados->estado.'</span>';

            }
                return $estado;
            })
            ->rawColumns(['foto','estado','acciones'])
            ->make(true);
        }
        return view('empleadoimg.index');
    }
    public function create()
    {
    return view('empleadoimg.create');
    }
    public function store(Request $request)
    {
    $rules = [
        'nombre' => 'required',
        'apellido' => 'required',
        'ci' => 'required',
        'estado' => 'required',
    ];
    $customMessages = [
        'required' => 'El campo :attribute no se puede dejar vacío',
    ];
    $validatedData = $request->validate($rules, $customMessages);
        $image = new Empleadoimg();
        $image->nombre=$request->get('nombre');
        $image->apellido=$request->get('apellido');
        $image->ci=$request->get('ci');
        $image->estado=$request->get('estado');
        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $ruta=$request->get('ci').'.'.$extension; 
            Image::make($request->file('image'))->save('public/image/'.$ruta);
            $image->image=$request->get('ci').'.'.$extension; 
        }
        else{
            $image->image='defecto.jpeg'; 
        }
        $image->save();
        return Redirect::to('empleadoimg');
    }
    public function show(Request $request)
    {
    }
    public function edit($id)
    {   
    $where = array('id' => $id);
    $data['empleadoimg_info'] = Empleadoimg::where($where)->first();
    return view('empleadoimg.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'nombre2' => 'required',
            'apellido2' => 'required',
            'ci2' => 'required',
            'estado2' => 'required',
        ];
        $customMessages = [
            'required' => 'El campo :attribute no se puede dejar vacío',
        ];
    

    $empleadoimg = Empleadoimg::find($id);
    $empleadoimg->nombre = $request->input('nombre');
    $empleadoimg->apellido = $request->input('apellido');
    $empleadoimg->ci = $request->input('ci');
    $empleadoimg->estado = $request->input('estado');
    if ($request->hasFile('image')) {
        if (Storage::exists('public/image/'.$empleadoimg->image))
        {
             Storage::delete('public/image/'.$empleadoimg->image);
        }
        $file = $request->file('image');
        $ruta=$request->file('image')->getClientOriginalName();
        Image::make($request->file('image'))->save('public/image/'.$ruta);
        $empleadoimg->image = $ruta;
    }
    $empleadoimg->save();
    return redirect::to('empleadoimg');
}
public function eliminar($id){
    $empleadoimg = DB::statement("exec elimianar_empleado $id");
    return back();
}

}
