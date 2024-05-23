<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = DB::table('pedidos')
        ->join('reservas', 'pedidos.id_reserva', '=','reservas.id_reserva')
        ->join('menus', 'pedidos.id_menu', '=','menus.id_menu')
        ->select('pedidos.*',"reservas.id_reserva","menus.nombre_menu")
        ->get();
        return json_encode(['pedidos'=>$pedidos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pedido = new Pedido();
        $pedido->id_reserva = $request->id_reserva;    
        $pedido->id_menu = $request->id_menu;
        $pedido->cantidad = $request->cantidad;
        $pedido->precio_total = $request->precio_total;
        $pedido->estado = $request->estado;
        $pedido->save();
        return json_encode(['pedido'=>$pedido]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pedido = Pedido::find($id);
        if(is_null($pedido)){
            return abort(404);
        }
        $reservas = DB::table('reservas')
        ->orderBy('id_reserva')
        ->get();
        $menus = DB::table('menus')
        ->orderBy('nombre_menu')
        ->get();
        return json_encode(['pedido'=>$pedido, 'reservas'=> $reservas, 'menus'=>$menus]);
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
        $pedido = Pedido::find($id);
        $pedido->id_reserva = $request->id_reserva;    
        $pedido->id_menu = $request->id_menu;
        $pedido->cantidad = $request->cantidad;
        $pedido->precio_total = $request->precio_total;
        $pedido->estado = $request->estado;
        $pedido->save();
        return json_encode(['pedido'=>$pedido]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pedido = Pedido::find($id);
        $pedido->delete();
        $pedidos = DB::table('pedidos')
        ->join('reservas', 'pedidos.id_reserva', '=','reservas.id_reserva')
        ->join('menus', 'pedidos.id_menu', '=','menus.id_menu')
        ->select('pedidos.*',"reservas.id_reserva","menus.nombre_menu")
        ->get();
        return json_encode(['pedidos' => $pedidos, 'success' => true]);
    }
}
