<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;

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

    public function reporteImportacions()
    {
        $importaciones = json_decode(file_get_contents('http://localhost:8003/importacions/'), true);
        return view('reporte.importacions',['productos' => $importaciones]);
    }
}
