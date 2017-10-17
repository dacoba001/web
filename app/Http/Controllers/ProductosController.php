<?php

namespace App\Http\Controllers;

use App\Tipo;
use App\Producto;
use Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Session;

class ProductosController extends Controller
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
                    'pro_nombre' => 'required|max:255|unique:productos',
                    'pro_codigo' => 'required|max:255|unique:productos',
                    'tipo_id' => 'required',
            ]);
        }
        if($option == 'update'){
            return Validator::make($data, [
                'pro_nombre' => 'required|max:255',
                'pro_codigo' => 'required|max:255',
            ]);
        }
    }
    public function index()
    {
        $productos = json_decode(file_get_contents('http://localhost:8002/productos'), true);
        return view('producto.productoslista',['productos' => $productos]);
    }

    public function create()
    {
        $tipos = json_decode(file_get_contents('http://localhost:8002/tipos'), true);
        return view('producto.productos',['tipos' => $tipos]);
    }
    public function store(Request $request)
    {
        $fileName="";
        if(Input::hasfile('pro_image_file')){
            $file = Input::file('pro_image_file');
            $fileName = rand(11111, 99999) . '_' .time(). '_' .$file->getClientOriginalName();
            $file->move('assets/images/productos', $fileName);
        }
        $request['pro_image'] = $fileName;
        $validator = $this->validator('create', $request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        print $request;
        $this->file_post_contents('http://localhost:8002/productos', 'POST', $request->all());
        $productos = json_decode(file_get_contents('http://localhost:8002/productos'), true);
        return view('producto.productoslista',['productos' => $productos]);
    }
    public function show($id)
    {
        $producto = json_decode(file_get_contents('http://localhost:8002/productos/'.$id), true);
        $tipos = json_decode(file_get_contents('http://localhost:8002/tipos'), true);
        return view("producto.productosmod", ['tipos' => $tipos, 'producto' => $producto]);
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
        $this->file_post_contents('http://localhost:8002/productos/'.$id, 'PUT', $request->all());
        $productos = json_decode(file_get_contents('http://localhost:8002/productos'), true);
        return view('producto.productoslista',['productos' => $productos]);
    }
    public function destroy($id)
    {
        $this->delete_json('http://localhost:8002/productos/'.$id, 'DELETE');
        $productos = json_decode(file_get_contents('http://localhost:8002/productos'), true);
        return view('producto.productoslista',['productos' => $productos]);
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
