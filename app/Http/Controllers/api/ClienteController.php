<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = DB::table('clientes')
        ->orderBy('nombre_cliente')
        ->get();
        return json_encode(['clientes'=>$clientes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = new Cliente();
        $cliente->nombre_cliente = $request->nombre_cliente;    
        $cliente->apellido = $request->apellido;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->save();
        return json_encode(['cliente'=>$cliente]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);
        if(is_null($cliente)){
            return abort(404);
        }
        return json_encode(['cliente'=>$cliente]);
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
        $cliente = Cliente::find($id);
        $cliente->nombre_cliente = $request->nombre_cliente;    
        $cliente->apellido = $request->apellido;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->save();
        return json_encode(['cliente'=>$cliente]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();
        $clientes = DB::table('clientes')
        ->get();

        return json_encode(['clientes' => $clientes , 'success' => true]);
    }
}
