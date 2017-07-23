@extends('layouts.app')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Administrar usuarios</h1>
                <ul class="nav nav-tabs">
                    <li class="active"><a href="">Morstar usuarios</a></li>
                    <li><a href="{{route('reg_usuarios')}}">Registrar usuario</a></li>
                </ul>
                <br>
                <div class="row">
            <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Registrar usuario
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Nombre de usuario</th>
                                    <th>Tipo de cuenta</th>
                                    <th>Nombre</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>Correo electronico</th>
                                    <th>Telefono</th>
                                    <th class="text-center">Modificar</th>
                                    <th class="text-center">Eliminar</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usuarios as $id => $usuario)
                                    <tr>
                                        <td>{{$usuario['nombredeusuario']}}</td>
                                        <td>{{$usuario['tipo_cuenta']}}</td>
                                        <td>{{$usuario['nombre']}}</td>
                                        <td>{{$usuario['appaterno']}}</td>
                                        <td>{{$usuario['apmaterno']}}</td>
                                        <td>{{$usuario['fecha_nac']}}</td>
                                        <td>{{$usuario['email']}}</td>
                                        <td>{{$usuario['telefono']}}</td>
                                        <td>
                                            <a href="{{ url('usuarios/')}}/{{$usuario['id']}}" class="btn btn-warning">Modificar</a>
                                        </td>
                                        <td>
                                            <form action="{{ url('usuarios/')}}/{{$usuario['id']}}" method="post">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="DELETE" >
                                                <input class="btn btn-danger" type="submit" value="Eliminar" >
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>
<!-- /#page-content-wrapper -->
@stop