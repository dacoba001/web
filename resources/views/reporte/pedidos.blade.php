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
                            <form class="form-inline" method="POST" action="{{ url('reportes/pedidos')}}" style="text-align: right;">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="start_date">Reporte Del: </label>
                                    <input type="date" class="form-control" name="start_date" id="start_date" value="{{ $start_date or old('start_date')}}">
                                </div>
                                <div class="form-group">
                                    <label for="end_date"> Al: </label>
                                    <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $end_date or old('end_date')}}">
                                </div>
                                <button type="submit" class="btn btn-default">Enviar</button>
                            </form>
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th class="text-center">Nº</th>
                                    <th class="text-center">Fecha</th>
                                    <th>Usuario</th>
                                    <th>Cliente</th>
                                    <th>Estado</th>
                                    <th class="text-center" style="width: 1px;">Detalle</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php $num=1?>
                                    @foreach ($pedidos as $id => $pedido)
                                    <tr>
                                        <td class="text-center"><?php echo $num; $num++; ?></td>
                                        <td class="text-center">{{date('h:i - d/m/Y', strtotime($pedido['ped_fecha_ini']))}}</td>
                                        <td>{{$pedido['user']['appaterno']}} {{$pedido['user']['apmaterno']}}, {{$pedido['user']['nombre']}}</td>
                                        <td>{{$pedido['cliente']['cli_nombre']}} (Zona {{$pedido['cliente']['cli_zona']}})</td>
                                        <td>{{$pedido['ped_estado']}}</td>
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