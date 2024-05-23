<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = DB::table('menus')
        ->orderBy('nombre_menu')
        ->get();
        return json_encode(['menus'=>$menus]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu = new Menu();
        $menu->nombre_menu = $request->nombre_menu;    
        $menu->descripcion = $request->descripcion;
        $menu->precio = $request->precio;
        $menu->save();
        return json_encode(['menu'=>$menu]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = Menu::find($id);
        if(is_null($menu)){
            return abort(404);
        }
        return json_encode(['menu'=>$menu]);
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
        $menu = Menu::find($id);
        $menu->nombre_menu = $request->nombre_menu;    
        $menu->descripcion = $request->descripcion;
        $menu->precio = $request->precio;
        $menu->save();
        return json_encode(['menu'=>$menu]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();

        $menus = DB::table('menus')
        ->get();

        return json_encode(['menus'=> $menus,'success' => true]);
    }
}
