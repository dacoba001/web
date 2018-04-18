<?php

namespace App\Http\Controllers;

use App\Tipo;
use Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
//use \Input as Input;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use Session;

class TiposController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $minstocks = json_decode(file_get_contents($this->ServerTwo.'/stocks/min'), true);
        Session::set('variable', $minstocks);
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
        $tipos = json_decode(file_get_contents($this->ServerTwo.'/tipos'), true);
        return view('tipo.tiposlista',['tipos' => $tipos]);
    }
    public function create()
    {
        return view("tipo.tipos");
    }
    public function store(Request $request)
    {
        $fileName="";
        if(Input::hasfile('tip_image_file')){
            $file = Input::file('tip_image_file');
            $fileName = rand(11111, 99999) . '_' .time(). '_' .$file->getClientOriginalName();
            $file->move('assets/images/tipos', $fileName);
        }
        $request['tip_image'] = $fileName;
        $validator = $this->validator('create', $request->all());
        if ($validator->fails()) {
               $this->throwValidationException(
                $request, $validator
            );
        }
        $this->file_post_contents($this->ServerTwo.'/tipos', 'POST', $request->all());
        $tipos = json_decode(file_get_contents($this->ServerTwo.'/tipos'), true);
        return view('tipo.tiposlista',['tipos' => $tipos]);
    }
    public function show($id)
    {
        $tipo = json_decode(file_get_contents($this->ServerTwo.'/tipos/'.$id), true);
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
        $this->file_post_contents($this->ServerTwo.'/tipos/'.$id, 'PUT', $request->all());
        $tipos = json_decode(file_get_contents($this->ServerTwo.'/tipos'), true);
        return view('tipo.tiposlista',['tipos' => $tipos]);
    }
    public function destroy($id)
    {
        $variable = $this->delete_json($this->ServerTwo.'/tipos/'.$id, 'DELETE');
        $tipos = json_decode(file_get_contents($this->ServerTwo.'/tipos'), true);
        if($variable == '"nodelete"'){
            $tipo = json_decode(file_get_contents($this->ServerTwo.'/tipos/'.$id), true);
            $error = "El tipo \"".$tipo['tip_nombre']."\" no se puede eliminar";
            return view('tipo.tiposlista',['tipos' => $tipos, 'error' => $error]);
        }
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
