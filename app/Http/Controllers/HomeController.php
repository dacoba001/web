<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class HomeController extends Controller
{
    public function index()
    {
        $minstocks = json_decode(file_get_contents('http://localhost:8002/stocks/min'), true);
        Session::set('variable', $minstocks);
        if (Auth::guest()){
            $productos = json_decode(file_get_contents('http://localhost:8002/productos/'), true);
            return view('home',['productos' => $productos,'carr_cant' => 0]);
        }
        $carrito = json_decode(file_get_contents('http://localhost:8002/carritos/cliente/'. Auth::user()->id), true);
        $productos = json_decode(file_get_contents('http://localhost:8002/productos/carrito/'. Auth::user()->id), true);
        return view('home',['productos' => $productos,'carr_cant' => count($carrito)]);
    }
    public function getProductos($tipo_id)
    {
        $minstocks = json_decode(file_get_contents('http://localhost:8002/stocks/min'), true);
        Session::set('variable', $minstocks);
        if (Auth::guest()){
            $productos = json_decode(file_get_contents('http://localhost:8002/productos/tipos/'.$tipo_id), true);
            return view('home',['productos' => $productos,'carr_cant' => 0]);
        }
        $carrito = json_decode(file_get_contents('http://localhost:8002/carritos/cliente/'. Auth::user()->id), true);
        $items = [];
        foreach ($carrito as $item) {
            $items[] = $item['producto_id'];
        }
//        $productos = json_decode(file_get_contents('http://localhost:8002/productos/carrito/'. Auth::user()->id), true);
        $productos = json_decode(file_get_contents('http://localhost:8002/productos/tipos/'.$tipo_id), true);
        return view('home',['productos' => $productos,'carr_cant' => count($carrito), 'items' => $items]);
    }
    public function getTipos()
    {
        $minstocks = json_decode(file_get_contents('http://localhost:8002/stocks/min'), true);
        Session::set('variable', $minstocks);
        $tipos = json_decode(file_get_contents('http://localhost:8002/tipos'), true);
        if (Auth::guest()){
            return view('hometipos',['tipos' => $tipos,'carr_cant' => 0]);
        }
        $carrito = json_decode(file_get_contents('http://localhost:8002/carritos/cliente/'. Auth::user()->id), true);
        $productos = json_decode(file_get_contents('http://localhost:8002/productos/carrito/'. Auth::user()->id), true);
        return view('hometipos',['tipos' => $tipos, 'productos' => $productos,'carr_cant' => count($carrito)]);
    }
}
