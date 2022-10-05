<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { //obtener todos los registros de la tabla empleado
        $datos['empleados']=Empleado::paginate(1);
        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleado.create');
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   //validar los campos para que no esten vacios
        //y que el correo sea unico y que sea un correo valido
        //y que la foto sea obligatoria
        //y que la foto sea de tipo imagen
        //y que la foto no sea mayor a 1000kb
        //y que la foto tenga un nombre unico
        //y que la foto se guarde en la carpeta storage/app/public
        //y que la foto se guarde en la base de datos
        $campos=[
            'nombre'=>'required|string|max:100',
            'Apellido1'=>'required|string|max:100',
            'Apellido2'=>'required|string|max:100',
            'correo'=>'required|email',
            'foto'=>'required|max:10000|mimes:jpeg,png,jpg'
        ];
        //mensaje de error para cada campo que no cumpla con las validaciones
        //y que se muestre en el formulario de creacion de empleado 
        //en el campo que no cumpla con la validacion 
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'foto.required'=>'La foto es requerida'
        ];
        $this->validate($request,$campos,$mensaje);
        $datosEmpleado = request()->except('_token');
        if ($request->hasFile('foto')) {
            $datosEmpleado['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        Empleado :: insert($datosEmpleado);
       // return response()->json($datosEmpleado);
       return redirect('empleado')->with('mensaje', 'Empleado agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //obtener el empleado que se va a editar 
        $empleado = Empleado::findOrFail($id);
        //retornar la vista de editar con el empleado que se va a editar
        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //validar los campos para que no esten vacios
        //y que el correo sea unico y que sea un correo valido
        //y que la foto sea obligatoria
        //y que la foto sea de tipo imagen
        //y que la foto no sea mayor a 1000kb
        //y que la foto tenga un nombre unico
        //y que la foto se guarde en la carpeta storage/app/public
        //y que la foto se guarde en la base de datos
        $campos=[
            'nombre'=>'required|string|max:100',
            'Apellido1'=>'required|string|max:100',
            'Apellido2'=>'required|string|max:100',
            'correo'=>'required|email',
            
        ];
        //mensaje de error para cada campo que no cumpla con las validaciones
        //y que se muestre en el formulario de creacion de empleado 
        //en el campo que no cumpla con la validacion 
        $mensaje=[
            'required'=>'El :attribute es requerido',
            
        ];
        //si el usuario sube una foto entonces se validan los campos de la foto
        //si el usuario no sube una foto entonces no se validan los campos de la foto
        //y se actualiza el empleado sin modificar la foto
        if($request->hasFile('foto')){
            $campos=['foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['foto.required'=>'La foto es requerida'];
        }
        $this->validate($request,$campos,$mensaje);
        //obtener los datos del empleado que se va a editar y actualizar
        //excepto el token y el metodo que se envian por defecto en el request
        //y el id del empleado que se va a editar y actualizar
       $datosEmpleado = request()->except(['_token', '_method']);
        if ($request->hasFile('foto')) {
            $empleado = Empleado::findOrFail($id);
            Storage::delete('public/' . $empleado->foto);
            $datosEmpleado['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        Empleado::where('id', '=', $id)->update($datosEmpleado);
        $empleado = Empleado::findOrFail($id);
        //return view('empleado.edit', compact('empleado'));
        return redirect('empleado')->with('mensaje', 'Empleado modificado con exito'); 
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);
        if (Storage::delete('public/' . $empleado->foto)) {
            Empleado::destroy($id);
        }
        return redirect('empleado')->with('mensaje', 'Empleado eliminado con exito');

    }
 
}
