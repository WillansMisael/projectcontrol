<?php

namespace App\Http\Controllers;
use App\Models\Empleadoimg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Redirect;
use PDF;
use Intervention\Image\ImageManagerStatic as Image;   
use Illuminate\Http\UploadedFile;
class EmpleadoimgController extends Controller
{
    public function index()
    {
    $data['empleadoimg'] = Empleadoimg::orderBy('id','desc')->paginate(10);
    return view('empleadoimg.index',$data);
    }
    public function create()
    {
    return view('empleadoimg.create');
    }
    public function store(Request $request)
    {
       /* $file = $request->hasFile('image');
        $file->move( $file->move(public_path().'\images\\',$empleadoimg->id.'.jpg')); 

        $empleadoimg = new Empleadoimg;
        $empleado->name = $request->get('nombre');
        $empleado->apellido = $request->get('apellido');
        $empleado->ci =  $request->get('ci');
        $empleado->estado =  $request->get('estado');
        $empleado->image = $user->id.'.jpg'; 
        $empleadoimg->save();*/
    /*$request->validate([
    'title' => 'required',
    'product_code' => 'required',
    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    'description' => 'required',
    ]);*//*
        if ($files = $request->file('image')) {
            $destinationPath = public_path().'\image\\'; // upload path
            $profileImage = $files->getClientOriginalName();
          //  $insert['image'] = "$profileImage";
            $insert['image'] = $profileImage;
        }*/
        /*
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name =$file->getClientOriginalName();
            //$destinationPath = 'public/image/'; // upload path
            $file->move(public_path().'\image\\', $name);
            $insert['image'] = "$name";
        }
        */
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
            $image->image='Ci_RomeroJose.jpeg'; 
        }
        $image->save();
        return Redirect::to('empleadoimg');
    /*//$insert['image'] = 'hola';
    $image=$request->file('image')->getClientOriginalExtension();
    $insert['nombre'] = $request->get('nombre');
    $insert['apellido'] = $request->get('apellido');
    $insert['ci'] = $request->get('ci');
    $insert['estado'] = $request->get('estado');
    Empleadoimg::insert($request->all(),$data['image']=$image);
    return Redirect::to('empleadoimg')
    ->with('success','Greate! Product created successfully.');
    */}
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
    /*$request->validate([
    'title' => 'required',
    'product_code' => 'required',
    'description' => 'required',
    ]);*/
    /*$update = [
        'nombre' => $request->nombre,
         'apellido' => $request->apellido,
          'ci' => $request->ci, 
          'estado' => $request->estado
        ];
    if ($files = $request->file('image')) {
    $destinationPath = 'public/image/'; // upload path
    $profileImage =$request->file('image')->getClientOriginalExtension();
    $files->move($destinationPath, $profileImage);
    $image = new Empleadoimg();
    $image->image=$request->file('image')->getClientOriginalName();
    $image->nombre=$request->get('nombre');
    $image->apellido=$request->get('apellido');
    $image->ci=$request->get('ci');
    $image->estado=$request->get('estado');
    $image->update();
    return Redirect::to('empleadoimg');*/

    

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
    //return dd($empleadoimg);
    }
    $empleadoimg->save();
    //$empleadoimg->save();
return redirect::to('empleadoimg');
}
           
    /*empleadoimg::where('id',$id)->update($request->all());
    return Redirect::to('empleadoimg')
    ->with('success','Great! empleadoimg updated successfully');*/

    public function destroy($id)
    {
    Empleadoimg::where('id',$id)->delete();
    return Redirect::to('empleadoimg')->with('success','empleadoimg deleted successfully');
    }
}
