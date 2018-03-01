<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use Carbon\Carbon;

class ImportacionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $minstocks = json_decode(file_get_contents('http://localhost:8002/stocks/min'), true);
        Session::set('variable', $minstocks);
    }
    public function index()
    {
        $importaciones = json_decode(file_get_contents('http://localhost:8003/importacions/'), true);
        return view('importacion.importacionslista',['productos' => $importaciones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = json_decode(file_get_contents('http://localhost:8002/productos/'), true);
        return view('importacion.productoslista',['productos' => $productos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->file_post_contents('http://localhost:8003/importacions', 'POST', $request->all());
        $productos = json_decode(file_get_contents('http://localhost:8002/productos/'), true);
        $mensage = "Producto añadido exitosamente";
        $minstocks = json_decode(file_get_contents('http://localhost:8002/stocks/min'), true);
        Session::set('variable', $minstocks);
        return view('importacion.productoslista',['productos' => $productos, 'mensage' => $mensage]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $this->file_post_contents('http://localhost:8003/importacions/'.$id, 'PUT', $request->all());
        $mensage = "Producto importado exitosamente";
        $importaciones = json_decode(file_get_contents('http://localhost:8003/importacions/'), true);
        return view('importacion.importacionslista',['productos' => $importaciones, 'mensage' => $mensage]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->delete_json('http://localhost:8003/importacions/'.$id, 'DELETE');
        $delete = "Producto eliminado de la importacion";
        $importaciones = json_decode(file_get_contents('http://localhost:8003/importacions/'), true);
        return view('importacion.importacionslista',['productos' => $importaciones, 'delete' => $delete]);
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
        $importaciones = json_decode($this->file_post_contents('http://localhost:8003/importacions/filter', 'POST', $request->all()),true);
        return view('reporte.importacions',['productos' => $importaciones, 'start_date' => $start_date, 'end_date' => $end_date]);
    }
    public function reporteImportacionsFiter(Request $request)
    {
        echo $request['start_date'];
        if(isset($request['start_date'])){
            echo "hola";
            $start_date = $request['start_date'];
            $end_date = $request['end_date'];
            $importaciones = json_decode($this->file_post_contents('http://localhost:8003/importacions/filter', 'POST', $request->all()));
            return view('reporte.importacions',['productos' => $importaciones, 'start_date' => $start_date, 'end_date' => $end_date]);
        }
        $start_date = new Carbon('first day of last month');
        $end_date = new Carbon('last day of last month');
        $importaciones = json_decode(file_get_contents('http://localhost:8003/importacions/'), true);
        return view('reporte.importacions',['productos' => $importaciones, 'start_date' => $start_date, 'end_date' => $end_date]);
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
