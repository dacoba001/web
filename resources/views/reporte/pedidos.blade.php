@extends('layouts.app')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Reportes</h1>
                <ul class="nav nav-tabs">
                    <li><a href="{{ url('reportes/importacions')}}">Reporte de Importaciones</a></li>
                    <li class="active"><a href="{{ url('reportes/pedidos')}}">Reporte de Pedidos</a></li>
                </ul>
                <br>
                <div class="row">
            <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Pedidos
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Fecah del pedido</th>
                                    <th>Estado</th>
                                    <th>Usuario</th>
                                    <th>Cliente</th>
                                    <th class="text-center" style="width: 1px;">Detalle</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pedidos as $id => $pedido)
                                    <tr>
                                        <td>{{$pedido['ped_fecha_ini']}}</td>
                                        <td>{{$pedido['ped_estado']}}</td>
                                        <td>{{$pedido['user']['appaterno']}} {{$pedido['user']['apmaterno']}}, {{$pedido['user']['nombre']}}</td>
                                        <td>{{$pedido['cliente']['cli_nombre']}} (Zona {{$pedido['cliente']['cli_zona']}})</td>
                                        <td>
                                            <a href="{{ url('reportes/pedidosdetalle/')}}/{{$pedido['id']}}" class="btn btn-primary btn-xs">Detalles</a>
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