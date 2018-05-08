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
                    <li><a href="{{ url('reportes/stocks')}}">Reporte de Stocks</a></li>
                </ul>
                <br>
                <?php
                $varproductos = [];
                $cantidadimportados = 0;
                foreach ($pedidos as $pedido){
                    foreach ($pedido['productos'] as $item){
                        $item_id = $item['producto']['id'];
                        if(!isset($varproductos[$item_id])){
                            $varproductos[$item_id][0] = $item['producto']['pro_nombre'];
                            $varproductos[$item_id][1] = $item['ped_cantidad'];
                        }else{
                            $varproductos[$item_id][1] += $item['ped_cantidad'];
                        }
                        $cantidadimportados += $item['ped_cantidad'];
                    }
                }
                ?>
                <div class="row col-lg-12">
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
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <h3>Productos mas Pedidos</h3>
                                            @if(!empty($varproductos))
                                                <table class="table">
                                                    @foreach ($varproductos as $varproducto)
                                                        @php($varproducto[2] = 100/$cantidadimportados*$varproducto[1])
                                                        <tr>
                                                            <td width="20%" class="text-right">{{$varproducto[0]}}</td>
                                                            <td width="10%" class="text-right" >{{$varproducto[1]}} u</td>
                                                            <td><div class="progress" style="margin-bottom: 0px;">
                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{$varproducto[2]}}%">
                                                                        {{round($varproducto[2])}}%
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            @else
                                                <div style="margin-bottom: 20px">No hay datos disponibles</div>
                                            @endif
                                        </div>
                                    </div>
                                    @if(!empty($pedidos))
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                  <tr>
                                                    <th class="text-center">Nº</th>
                                                    <th class="text-center">Fecha</th>
                                                    <th>Cliente</th>
                                                    <th>Pedido</th>
                                                    <th class="text-center" style="width: 1px;">Detalle</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $num=1?>
                                                    @foreach ($pedidos as $id => $pedido)
                                                    <tr>
                                                        <td class="text-center"><?php echo $num; $num++; ?></td>
                                                        <td class="text-center">{{date('h:i a - d/m/Y', strtotime($pedido['ped_fecha_ini']))}}</td>
                                                        <td>{{$pedido['user']['appaterno']}} {{$pedido['user']['apmaterno']}}, {{$pedido['user']['nombre']}}<br>{{$pedido['cliente']['cli_nombre']}} (Zona {{$pedido['cliente']['cli_zona']}})</td>
                                                        <td class="text-right">
                                                            <big><strong>{{number_format((float)$pedido['total_precio'], 2, '.', '')}} Bs.</strong></big>
                                                            <hr style="margin:0">
                                                            <span class="text-left pull-left">
                                                            <strong>Productos: </strong>{{$pedido['total_productos']}}<br>
                                                            <strong>Estado: </strong>{{$pedido['ped_estado']}}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('reportes/pedidosdetalle/')}}/{{$pedido['id']}}" class="btn btn-primary btn-xs">Detalles</a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop