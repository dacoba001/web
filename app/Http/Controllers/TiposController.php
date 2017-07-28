<?php

namespace App\Http\Controllers;

use App\Tipo;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;

class TiposController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    protected function validator($option, array $data)
    {
        if($option == 'create'){
            return Validator::make($data, [
                'tip_nombre' => 'required|max:255|unique:tipos',
            ]);
        }
        if($option == 'update'){
            return Validator::make($data, [
                'tip_nombre' => 'required|max:255',
            ]);
        }
    }
    public function index()
    {
        $tipos = json_decode(file_get_contents('http://localhost:8002/tipos'), true);
        return view('tipo.tiposlista',['tipos' => $tipos]);
    }
    public function create()
    {
        return view("tipo.tipos");
    }
    public function store(Request $request)
    {
        $validator = $this->validator('create', $request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $this->file_post_contents('http://localhost:8002/tipos', 'POST', $request->all());
        $tipos = json_decode(file_get_contents('http://localhost:8002/tipos'), true);
        return view('tipo.tiposlista',['tipos' => $tipos]);
    }
    public function show($id)
    {
        $tipo = json_decode(file_get_contents('http://localhost:8002/tipos/'.$id), true);
        return view("tipo.tiposmod", $tipo);
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        $validator = $this->validator('update', $request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $this->file_post_contents('http://localhost:8002/tipos/'.$id, 'PUT', $request->all());
        $tipos = json_decode(file_get_contents('http://localhost:8002/tipos'), true);
        return view('tipo.tiposlista',['tipos' => $tipos]);
    }
    public function destroy($id)
    {
        echo $this->delete_json('http://localhost:8002/tipos/'.$id, 'DELETE');
        $tipos = json_decode(file_get_contents('http://localhost:8002/tipos'), true);
        return view('tipo.tiposlista',['tipos' => $tipos]);
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
