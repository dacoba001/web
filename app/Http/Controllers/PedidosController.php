<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use Carbon\Carbon;
use Session;

class PedidosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $minstocks = json_decode(file_get_contents('http://localhost:8002/stocks/min'), true);
        Session::set('variable', $minstocks);
    }
    public function index()
    {
        $pedidos = json_decode(file_get_contents('http://localhost:8003/pedidos'), true);
        if(Auth::user()->tipo_cuenta == 'Cliente')
            $pedidos = json_decode(file_get_contents('http://localhost:8003/pedidos/cliente/'. Auth::user()->id), true);
        return view('pedido.pedidoslista',['pedidos' => $pedidos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->file_post_contents('http://localhost:8003/pedidos', 'POST', $request->all());
        return redirect()->action(
            'HomeController@getTipos'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detallepedido = json_decode(file_get_contents('http://localhost:8003/pedidos/detalle/'. $id), true);
        $pedido = json_decode(file_get_contents('http://localhost:8003/pedidos/'. $id), true);
        return view('pedido.detalleslista',['detallepedido' => $detallepedido, 'pedido' => $pedido]);
    }
    public function getPedidos($user_id)
    {
        $pedidos = json_decode(file_get_contents('http://localhost:8003/pedidos/cliente/'. $user_id), true);
        return view('pedido.pedidoslista',['pedidos' => $pedidos]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $response = $this->file_post_contents('http://localhost:8003/pedidos/validar/'.$id, 'PUT', $request->all());
        if($response == '"Error"'){
            $detallepedido = json_decode(file_get_contents('http://localhost:8003/pedidos/detalle/'. $id), true);
            $pedido = json_decode(file_get_contents('http://localhost:8003/pedidos/'. $id), true);
            return view('pedido.detalleslista',['detallepedido' => $detallepedido, 'pedido' => $pedido, 'error' => $response]);
        }
        $pedidos = json_decode(file_get_contents('http://localhost:8003/pedidos'), true);
        $minstocks = json_decode(file_get_contents('http://localhost:8002/stocks/min'), true);
        Session::set('variable', $minstocks);
        return view('pedido.pedidoslista',['pedidos' => $pedidos]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function reportePedidos(Request $request)
    {
        if($request['start_date']){
            $start_date = $request['start_date'];
            $end_date = $request['end_date'];
        }else{
            $start_date = new Carbon('first day of this month');
            $start_date = $start_date->format("Y-m-d");
            $end_date = new Carbon('last day of this month');
            $end_date = $end_date->format("Y-m-d");
            $request['start_date'] = $start_date;
            $request['end_date'] = $end_date;
        }
        $pedidos = json_decode($this->file_post_contents('http://localhost:8003/pedidos/filter', 'POST', $request->all()),true);
        return view('reporte.pedidos',['pedidos' => $pedidos, 'start_date' => $start_date, 'end_date' => $end_date]);
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

    public function reportePedidosDetalle($id)
    {
        $detallepedido = json_decode(file_get_contents('http://localhost:8003/pedidos/detalle/'. $id), true);
        $pedido = json_decode(file_get_contents('http://localhost:8003/pedidos/'. $id), true);
        return view('reporte.pedidodetalles',['detallepedido' => $detallepedido, 'pedido' => $pedido]);
    }
}
