@extends('layouts.app')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Administrar Stocks</h1>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="/stocks">Morstar Stocks</a></li>
                        <li><a href="{{ url('stocks/create')}}">Registrar Stock</a></li>
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
                                    <th class="text-right">Precio</th>
                                    <th class="text-center">Cantidad</th>
                                    <th class="text-center">Cantidad Minima</th>
                                    <th class="text-center" style="width: 1px;">Modificar</th>
                                    <th class="text-center" style="width: 1px;">Eliminar</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stocks as $id => $stock)
                                    <tr>
                                        <td>{{$stock['producto']['tipo']['tip_nombre']}}, {{$stock['producto']['pro_nombre']}}</td>
                                        <td class="text-right">{{$stock['stk_precio']}} Bs.</td>
                                        <td class="text-center">{{$stock['stk_cantidad']}}</td>
                                        <td class="text-center">{{$stock['stk_cantmin']}}</td>
                                        <td>
                                            <a href="{{ url('stocks/')}}/{{$stock['id']}}" class="btn btn-warning">Modificar</a>
                                        </td>
                                        <td>
                                            <form action="{{ url('stocks/')}}/{{$stock['id']}}" method="post">
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