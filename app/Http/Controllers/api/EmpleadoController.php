<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empleado;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = DB::table('empleados')
        ->get();
        return json_encode(['empleados'=>$empleados]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empleado = new Empleado();
        $empleado->nombre_empleado = $request->nombre_empleado;    
        $empleado->apellido = $request->apellido;
        $empleado->cargo_empleado = $request->cargo_empleado;
        $empleado->salario = $request->salario;
        $empleado->save();
        return json_encode(['empleado'=>$empleado]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = Empleado::find($id);
        if(is_null($empleado)){
            return abort(404);
        }
        return json_encode(['empleado'=>$empleado]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $empleado = Empleado::find($id);
        $empleado->nombre_empleado = $request->nombre_empleado;    
        $empleado->apellido = $request->apellido;
        $empleado->cargo_empleado = $request->cargo_empleado;
        $empleado->salario = $request->salario;
        $empleado->save();
        return json_encode(['empleado'=>$empleado]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Empleado::find($id);
        $empleado->delete();

        $empleados = DB::table('empleados')
        ->get();

        return json_encode(['empleados'=>$empleados,'success' => true]);
    }
}
