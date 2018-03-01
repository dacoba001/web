<?php

namespace App\Http\Controllers;

use App\Cliente;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;

class ClientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $minstocks = json_decode(file_get_contents('http://localhost:8002/stocks/min'), true);
        Session::set('variable', $minstocks);
    }

    protected function validator($option, array $data)
    {
        if($option == 'create'){
            return Validator::make($data, [
                'cli_nombre' => 'required|max:255|unique:clientes',
                'cli_direccion' => 'required|max:255',
            ]);
        }
        if($option == 'update'){
            return Validator::make($data, [
                'cli_direccion' => 'required|max:255',
            ]);
        }
    }
    protected function validatorUser(array $data)
    {
        return Validator::make($data, [
            'nombre' => 'required|max:255',
            'nombredeusuario' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }
    public function index()
    {
        $clientes = json_decode(file_get_contents('http://localhost:8001/clientes'), true);
        return view('cliente.clienteslista',['clientes' => $clientes]);
    }
    public function create($user_id = null)
    {
        $users = json_decode(file_get_contents('http://localhost:8001/clientes/users'), true);
        return view("cliente.clientes",['users' => $users, 'user_id' => $user_id]);
    }
    public function users()
    {
        return view("cliente.usuarios");
    }
    public function usersCreate(Request $request)
    {
        $validator = $this->validatorUser($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $usuario = $this->file_post_contents('http://localhost:8001/clientes/users', 'POST', $request->all());
        $usuario = json_decode($usuario);
        return redirect()->action(
            'ClientesController@create', ['user_id' => $usuario->id]
        );
        //return view('cliente.clientes',['users' => $users, 'user_id' => $usuario->id]);
    }
    public function store(Request $request)
    {
        $validator = $this->validator('create', $request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $this->file_post_contents('http://localhost:8001/clientes', 'POST', $request->all());
        $clientes = json_decode(file_get_contents('http://localhost:8001/clientes'), true);
        return view('cliente.clienteslista',['clientes' => $clientes]);
    }
    public function show($id)
    {
        $cliente = json_decode(file_get_contents('http://localhost:8001/clientes/'.$id), true);
        return view("cliente.clientesmod", $cliente);
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
        $this->file_post_contents('http://localhost:8001/clientes/'.$id, 'PUT', $request->all());
        $clientes = json_decode(file_get_contents('http://localhost:8001/clientes'), true);
        return view('cliente.clienteslista',['clientes' => $clientes]);
    }
    public function destroy($id)
    {
        $this->delete_json('http://localhost:8001/clientes/'.$id, 'DELETE');
        $clientes = json_decode(file_get_contents('http://localhost:8001/clientes'), true);
        return view('cliente.clienteslista',['clientes' => $clientes]);
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
