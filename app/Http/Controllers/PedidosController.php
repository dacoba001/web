<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use Carbon\Carbon;
use Session;
use Validator;

class PedidosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $minstocks = json_decode(file_get_contents($this->ServerTwo.'/stocks/min'), true);
        Session::set('variable', $minstocks);
    }
    protected function validatorPedidosActions(array $data)
    {
        return Validator::make($data, [
            'proCantidadPrcesar' => 'required',
        ]);
    }
    public function index()
    {
        $pedidos = json_decode(file_get_contents($this->ServerThree.'/pedidos/estado/pendiente'), true);
        if(Auth::user()->tipo_cuenta == 'Cliente')
            $pedidos = json_decode(file_get_contents($this->ServerThree.'/pedidos/cliente/pendiente/'.Auth::user()->id), true);
        return view('pedido.pedidoslista',['pedidos' => $pedidos, 'pendiente' => True]);
    }

    public function indexEntregados()
    {
        $pedidos = json_decode(file_get_contents($this->ServerThree.'/pedidos/estado/Entregado'), true);
        if(Auth::user()->tipo_cuenta == 'Cliente')
            $pedidos = json_decode(file_get_contents($this->ServerThree.'/pedidos/cliente/entregado/'.Auth::user()->id), true);
        return view('pedido.pedidoslista',['pedidos' => $pedidos, 'entregado' => True]);
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
        $this->file_post_contents($this->ServerThree.'/pedidos', 'POST', $request->all());
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
        $detallepedido = json_decode(file_get_contents($this->ServerThree.'/pedidos/detalle/'. $id), true);
        $pedido = json_decode(file_get_contents($this->ServerThree.'/pedidos/'. $id), true);
        return view('pedido.detalleslista',['detallepedido' => $detallepedido, 'pedido' => $pedido]);
    }
    public function getPedidos($user_id)
    {
        $pedidos = json_decode(file_get_contents($this->ServerThree.'/pedidos/cliente/'. $user_id), true);
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
        //
    }
    public function postEntregarTodo(Request $request)
    {
        $id = $request['pedido_id'];
        $response = (array)json_decode($this->file_post_contents($this->ServerThree.'/pedidos/validar/'.$id, 'PUT', $request->all()));
        $minstocks = json_decode(file_get_contents($this->ServerTwo.'/stocks/min'), true);
        Session::set('variable', $minstocks);
        $pedido = json_decode(file_get_contents($this->ServerThree.'/pedidos/'. $id), true);
        $detallepedido = json_decode(file_get_contents($this->ServerThree.'/pedidos/detalle/'. $id), true);
        if($response['status'] == "failed"){
            $error = "No se puede entregar los productos";
            return view('pedido.detalleslista',['detallepedido' => $detallepedido, 'pedido' => $pedido, 'error' => $error]);
        }elseif ($response['status'] == "success"){
            $success = "Los siguientes productos fueron enteegados entregados:";
            return view('pedido.detalleslista',['detallepedido' => $detallepedido, 'pedido' => $pedido, 'success' => $success, 'message' => $response['message']]);
        }
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
        $pedidos = json_decode($this->file_post_contents($this->ServerThree.'/pedidos/filter', 'POST', $request->all()),true);
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
        $detallepedido = json_decode(file_get_contents($this->ServerThree.'/pedidos/detalle/'. $id), true);
        $pedido = json_decode(file_get_contents($this->ServerThree.'/pedidos/'. $id), true);
        return view('reporte.pedidodetalles',['detallepedido' => $detallepedido, 'pedido' => $pedido]);
    }

    public function postEntregar(Request $request, $id){
        $detallepedido = json_decode(file_get_contents($this->ServerThree.'/detallepedido/'. $id), true);
        $pedido_id = $detallepedido['pedido_id'];
        $Restante = $detallepedido['ped_cantidad'] - $detallepedido['ped_cantidad_entregado'];
        if($request['proCantidadPrcesar'] <= $detallepedido['producto']['stocks']['stk_cantidad'] and $request['proCantidadPrcesar'] <= $Restante){
            $this->file_post_contents($this->ServerThree.'/detallepedido/entregar/'.$id, 'PUT', $request->all());
            $detallepedido = json_decode(file_get_contents($this->ServerThree.'/pedidos/detalle/'. $pedido_id), true);
            $pedido = json_decode(file_get_contents($this->ServerThree.'/pedidos/'. $pedido_id), true);
            return view('pedido.detalleslista',['detallepedido' => $detallepedido, 'pedido' => $pedido]);
        }
        $error = "No se puede procesar esa cantidad";
        $detallepedido = json_decode(file_get_contents($this->ServerThree.'/pedidos/detalle/'. $pedido_id), true);
        $pedido = json_decode(file_get_contents($this->ServerThree.'/pedidos/'. $pedido_id), true);
        return view('pedido.detalleslista',['detallepedido' => $detallepedido, 'pedido' => $pedido, 'error' => $error]);
    }
    public function postDevolver(Request $request, $id){
        $detallepedido = json_decode(file_get_contents($this->ServerThree.'/detallepedido/'. $id), true);
        $pedido_id = $detallepedido['pedido_id'];
        $Posible = $detallepedido['ped_cantidad_entregado'] - $detallepedido['ped_cantidad_devuelto'];
        if($request['proCantidadPrcesar'] <= $Posible){
            $this->file_post_contents($this->ServerThree.'/detallepedido/devolver/'.$id, 'PUT', $request->all());
            $detallepedido = json_decode(file_get_contents($this->ServerThree.'/pedidos/detalle/'. $pedido_id), true);
            $pedido = json_decode(file_get_contents($this->ServerThree.'/pedidos/'. $pedido_id), true);
            return view('pedido.detalleslista',['detallepedido' => $detallepedido, 'pedido' => $pedido]);
        }
        $error = "No se puede procesar esa cantidad";
        $detallepedido = json_decode(file_get_contents($this->ServerThree.'/pedidos/detalle/'. $pedido_id), true);
        $pedido = json_decode(file_get_contents($this->ServerThree.'/pedidos/'. $pedido_id), true);
        return view('pedido.detalleslista',['detallepedido' => $detallepedido, 'pedido' => $pedido, 'error' => $error]);
    }
}
