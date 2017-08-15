@extends('layouts.app')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Administrar Stocks</h1>
                    <ul class="nav nav-tabs">
                        <li><a href="/stocks">Morstar Stocks</a></li>
                        <li><a href="{{ url('stocks/create')}}">Registrar Stock</a></li>
                        <li class="active"><a href="{{ url('stocks/create')}}">Stock Con Cantidad Minima</a></li>
                    </ul>
                <br>
                <div class="row">
            <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Stocks Registrados
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Cantidad Minima</th>
                                    <th class="text-center" style="width: 1px;">Opciones</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stocks as $id => $stock)
                                    <tr>
                                        <td>{{$stock['producto']['tipo']['tip_nombre']}}, {{$stock['producto']['pro_nombre']}}</td>
                                        <td>{{$stock['stk_cantidad']}}</td>
                                        <td>{{$stock['stk_precio']}}</td>
                                        <td>{{$stock['stk_cantmin']}}</td>
                                        <td>
                                            <a href="{{ url('stocks/')}}/{{$stock['id']}}" class="btn btn-success">Incrementar</a>
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