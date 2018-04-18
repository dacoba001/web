@extends('layouts.app')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Administrar Pedidos</h1>
                    <ul class="nav nav-tabs">
                        <li @if(isset($pendiente) and $pendiente) class="active" @endif><a href="/pedidos">Morstar Pedidos Pendientes</a></li>
                        <li @if(isset($entregado) and $entregado) class="active" @endif><a href="/pedidoss/estado/1">Morstar Pedidos Entregados</a></li>
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
                                    <th class="text-right">Fecha del pedido</th>
                                    <th>Estado</th>
                                    <th>Cliente</th>
                                    <th class="text-center" style="width: 1px;">Detalle</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pedidos as $id => $pedido)
                                    <tr>
                                        <td class="text-right">{{ date("h:sa - d/m/Y", strtotime($pedido['ped_fecha_ini'])) }}</td>
                                        <td>{{ $pedido['ped_estado'] }}</td>
                                        <td>
                                            {{ $pedido['user']['appaterno'] }} {{ $pedido['user']['apmaterno'] }}, {{ $pedido['user']['nombre'] }}
                                            <br><strong>Ferreteria: </strong>{{ $pedido['cliente']['cli_nombre'] }}
                                            <br><strong>Zona: </strong>Zona {{ $pedido['cliente']['cli_zona'] }}
                                        </td>
                                        <td>
                                            <a href="{{ url('pedidos/')}}/{{$pedido['id']}}" class="btn btn-primary btn-sm">Detalles</a>
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