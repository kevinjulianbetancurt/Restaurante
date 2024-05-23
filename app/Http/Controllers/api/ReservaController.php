<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserva;
use Illuminate\Support\Facades\DB;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservas = DB::table('reservas')
        ->join('clientes', 'reservas.id_cliente', '=','clientes.id_cliente')
        ->select('reservas.*',"clientes.nombre_cliente")
        ->get();
    return json_encode(['reservas'=>$reservas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reserva = new Reserva();
        $reserva->id_cliente = $request->id_cliente;    
        $reserva->fecha_hora = $request->fecha_hora;
        $reserva->cantidad_personas = $request->cantidad_personas;
        $reserva->estado = $request->estado;
        $reserva->save();
        return json_encode(['reserva'=>$reserva]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reserva = Reserva::find($id);
        if(is_null($reserva)){
            return abort(404);
        }
        $clientes = DB::table('clientes')
        ->orderBy('nombre_cliente')
        ->get();
        return json_encode(['reserva'=>$reserva, 'clientes'=> $clientes]);
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
        $reserva = Reserva::find($id);
        $reserva->id_cliente = $request->id_cliente;    
        $reserva->fecha_hora = $request->fecha_hora;
        $reserva->cantidad_personas = $request->cantidad_personas;
        $reserva->estado = $request->estado;
        $reserva->save();
        return json_encode(['reserva'=>$reserva]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reserva = Reserva::find($id);
        $reserva->delete();
        $reservas = DB::table('reservas')
        ->join('clientes', 'reservas.id_cliente', '=','clientes.id_cliente')
        ->select('reservas.*',"clientes.nombre_cliente")
        ->get();
        return json_encode(['reservas' => $reservas, 'success' => true]);
    }
}
