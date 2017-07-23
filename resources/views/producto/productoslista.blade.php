@extends('layouts.app')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Administrar Productos</h1>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="/productos">Morstar Productos</a></li>
                        <li><a href="{{ url('productos/create')}}">Registrar Producto</a></li>
                    </ul>
                <br>
                <div class="row">
            <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Productos Registrados
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Descripcion del Producto</th>
                                    <th>Codigo</th>
                                    <th class="text-center" style="width: 1px;">Modificar</th>
                                    <th class="text-center" style="width: 1px;">Eliminar</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $id => $producto)
                                    <tr>
                                        <td>{{$producto['pro_nombre']}}</td>
                                        <td>{{$producto['tipo']['tip_nombre']}}</td>
                                        <td>{{$producto['pro_descripcion']}}</td>
                                        <td>{{$producto['pro_codigo']}}</td>
                                        <td>
                                            <a href="{{ url('productos/')}}/{{$producto['id']}}" class="btn btn-warning">Modificar</a>
                                        </td>
                                        <td>
                                            <form action="{{ url('productos/')}}/{{$producto['id']}}" method="post">
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