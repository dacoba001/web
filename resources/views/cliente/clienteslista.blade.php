@extends('layouts.app')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Administrar Clientes</h1>
                <ul class="nav nav-tabs">
                    <li class="active"><a href="/clientes">Morstar Clientes</a></li>
                    <li><a href="{{ url('clientes/create')}}">Registrar Cliente</a></li>
                </ul>
                <br>
                <div class="row">
            <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Clientes Registrados
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Cliente</th>
                                    <th>Nombre de la Ferreteria</th>
                                    <th>Direccion de la Ferreteria</th>
                                    <th>Zona</th>
                                    <th class="text-center" style="width: 1px;">Modificar</th>
                                    <th class="text-center" style="width: 1px;">Eliminar</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clientes as $id => $cliente)
                                    <tr>
                                        <td>{{$cliente['user']['appaterno']}} {{$cliente['user']['apmaterno']}}, {{$cliente['user']['nombre']}}</td>
                                        <td>{{$cliente['cli_nombre']}}</td>
                                        <td>{{$cliente['cli_direccion']}}</td>
                                        <td>{{$cliente['cli_zona']}}</td>
                                        <td>
                                            <a href="{{ url('clientes/')}}/{{$cliente['id']}}" class="btn btn-warning">Modificar</a>
                                        </td>
                                        <td>
                                            <form action="{{ url('clientes/')}}/{{$cliente['id']}}" method="post">
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