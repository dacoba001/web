<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::guest()){
            $productos = json_decode(file_get_contents('http://localhost:8002/productos/'), true);
            return view('home',['productos' => $productos,'carr_cant' => 0]);
        }
        $carrito = json_decode(file_get_contents('http://localhost:8002/carritos/cliente/'. Auth::user()->id), true);
        $productos = json_decode(file_get_contents('http://localhost:8002/productos/carrito/'. Auth::user()->id), true);
        return view('home',['productos' => $productos,'carr_cant' => count($carrito)]);
    }
}