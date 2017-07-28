<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Tipo;
use App\Producto;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;

class StocksController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'producto_id' => 'required',
            'stk_cantmin' => 'required|max:255',
            ]);
    }

    public function index()
    {
        $stocks = json_decode(file_get_contents('http://localhost:8002/stocks'), true);
        return view('stock.stockslista',['stocks' => $stocks]);
    }

    public function create()
    {
        $productos = json_decode(file_get_contents('http://localhost:8002/productos'), true);
        return view('stock.stocks',['productos' => $productos]);
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
                );
        }
        $this->file_post_contents('http://localhost:8002/stocks', 'POST', $request->all());
        $stocks = json_decode(file_get_contents('http://localhost:8002/stocks'), true);
        return view('stock.stockslista',['stocks' => $stocks]);
    }

    public function show($id)
    {
        $stock = json_decode(file_get_contents('http://localhost:8002/stocks/'.$id), true);
        return view("stock.stocksmod", ['stock' => $stock]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
                );
        }
        $this->file_post_contents('http://localhost:8002/stocks/'.$id, 'PUT', $request->all());
        $stocks = json_decode(file_get_contents('http://localhost:8002/stocks'), true);
        return view('stock.stockslista',['stocks' => $stocks]);
    }

    public function destroy($id)
    {
        $this->delete_json('http://localhost:8002/stocks/'.$id, 'DELETE');
        $stocks = json_decode(file_get_contents('http://localhost:8002/stocks'), true);
        return view('stock.stockslista',['stocks' => $stocks]);
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
