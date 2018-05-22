<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;

class ReportesController extends Controller
{

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
        $pedidos = json_decode($this->file_post_contents($this->ServerThree.'/reportes/pedido', 'POST', $request->all()),true);
        return view('reporte.pedidos',['pedidos' => $pedidos, 'start_date' => $start_date, 'end_date' => $end_date]);
    }

    public function reportePedidosDetalle($id)
    {
        $detallepedido = json_decode(file_get_contents($this->ServerThree.'/pedidos/detalle/'. $id), true);
        $pedido = json_decode(file_get_contents($this->ServerThree.'/pedidos/'. $id), true);
        return view('reporte.pedidodetalles',['detallepedido' => $detallepedido, 'pedido' => $pedido]);
    }

    public function reporteImportacions(Request $request)
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
        $importaciones = json_decode($this->file_post_contents($this->ServerThree.'/reportes/importacion', 'POST', $request->all()),true);
        return view('reporte.importacions',['productos' => $importaciones, 'start_date' => $start_date, 'end_date' => $end_date]);
    }

    public function reporteStocks(Request $request)
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
        $stocks = json_decode(file_get_contents($this->ServerTwo.'/stocks'), true);
        $stock_moves = json_decode($this->file_post_contents($this->ServerThree.'/reportes/stocks', 'POST', $request->all()),true);
        return view('reporte.stocks',['stocks' => $stocks, 'stock_id' => isset($request['stock_id']) ? $request['stock_id'] : 0, 'stock_moves' => $stock_moves, 'start_date' => $start_date, 'end_date' => $end_date]);
    }

    public function reporteClientes(Request $request)
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
        $clientes = json_decode($this->file_post_contents($this->ServerThree.'/reportes/clientes', 'POST', $request->all()),true);
        return view('reporte.clientes',['clientes' => $clientes, 'start_date' => $start_date, 'end_date' => $end_date]);
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

}
