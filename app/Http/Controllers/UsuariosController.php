<?php

namespace App\Http\Controllers;
//namespace App;

use App\User;
use App\Usuario;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;


class UsuariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $minstocks = json_decode(file_get_contents('http://localhost:8002/stocks/min'), true);
        Session::set('variable', $minstocks);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuario.usuarioslista',['usuarios' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("usuario.usuarios");
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => 'required|max:255',
            'nombredeusuario' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }
    protected function validator2(array $data)
    {
        return Validator::make($data, [
            'nombre' => 'required|max:255',
        ]);
    }
    public function postCreate(Request $request)
    {
        /*
        $usuario = new Usuario;
        $usuario->nombre = $request->name;
        $usuario->save();
        */
        //$usuario = Usuario::create($request->all());
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $usuario = Usuario::create([
            'nombre' => $request['nombre'],
            'nombredeusuario' => $request['nombredeusuario'],
            'appaterno' => $request['appaterno'],
            'apmaterno' => $request['apmaterno'],
            'fecha_nac' => $request['fecha_nac'],
            'telefono' => $request['telefono'],
            'tipo_cuenta' => $request['tipo_cuenta'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
        
        $usuarios = Usuario::all();
        return view('usuario.usuarioslista',['usuarios' => $usuarios]);
        //return view("usuario");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = Usuario::find($id);
        //print_r($usuario);
        return view("usuario.usuariosmod", $usuario);
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
        
        $validator = $this->validator2($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
        $usuario = Usuario::where('id', $id)
        ->update([
            'nombre' => $request['nombre'],
            'appaterno' => $request['appaterno'],
            'apmaterno' => $request['apmaterno'],
            'fecha_nac' => $request['fecha_nac'],
            'telefono' => $request['telefono'],
        ]);
        
        $usuarios = Usuario::all();
        return view('usuario.usuarioslista',['usuarios' => $usuarios]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = Usuario::destroy($id);
        $usuarios = Usuario::all();
        return view('usuario.usuarioslista',['usuarios' => $usuarios]);
    }
}
