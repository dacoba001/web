<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

class CarritosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

    }

    public function productos()
    {
        $carrito = json_decode(file_get_contents('http://localhost:8003/carritos/cliente/'. Auth::user()->id), true);
        $listadecliente = json_decode(file_get_contents('http://localhost:8001/clientes/users/'. Auth::user()->id), true);
        return view('carrito.productos_cliente',['productos' => $carrito, 'listadecliente' => $listadecliente]);
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $this->file_post_contents('http://localhost:8003/carritos', 'POST', $request->all());
        return redirect()->action(
            'HomeController@index'
        );
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        $this->delete_json('http://localhost:8003/carritos/'.$id, 'DELETE');
        $carrito = json_decode(file_get_contents('http://localhost:8003/carritos/cliente/'. Auth::user()->id), true);
        $listadecliente = json_decode(file_get_contents('http://localhost:8001/clientes/users/'. Auth::user()->id), true);
        return view('carrito.productos_cliente',['productos' => $carrito, 'listadecliente' => $listadecliente]);
    }
    function file_post_contents($url, $method, $data, $username = null, $password = null)
    {
        $postdata = http_build_query($data);
        $opts = array('http' =>
            array(
                'method'  => $method,
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        if($username && $password)
        {
            $opts['http']['header'] = ("Authorization: Basic " . base64_encode("$username:$password"));
        }
        $context = stream_context_create($opts);
        return file_get_contents($url, false, $context);
    }
    function delete_json($url, $method, $username = null, $password = null)
    {
        $opts = array('http' =>
            array(
                'method'  => $method,
                'header'  => 'Content-type: application/x-www-form-urlencoded'
            )
        );
        if($username && $password)
        {
            $opts['http']['header'] = ("Authorization: Basic " . base64_encode("$username:$password"));
        }
        $context = stream_context_create($opts);
        return file_get_contents($url, false, $context);
    }
}
