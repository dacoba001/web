@extends('layouts.app')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Reporte de Impotaciones</h1>
                @include('reporte.fecha_reporte')
                <ul class="nav nav-tabs hidden-print">
                    <li class="active"><a href="{{ url('reportes/importacions')}}">Reporte de Importaciones</a></li>
                    <li><a href="{{ url('reportes/pedidos')}}">Reporte de Pedidos</a></li>
                    <li><a href="{{ url('reportes/stocks')}}">Reporte de Stcok</a></li>
                    <li><a href="{{ url('reportes/clientes')}}">Reporte de Clientes</a></li>
                </ul>
                <br>
                <?php
                    $varproductos = [];
                    $cantidadimportados = 0;
                    foreach ($productos as $producto){
                        $idproducto = $producto['producto']['id'];
                        if(!isset($varproductos[$idproducto])){
                            $varproductos[$idproducto][0] = $producto['producto']['pro_nombre'];
                            $varproductos[$idproducto][1] = $producto['imp_cantidad'];
                        }else{
                            $varproductos[$idproducto][1] += $producto['imp_cantidad'];
                        }
                        $cantidadimportados += $producto['imp_cantidad'];
                    }
                ?>

                <div class="row col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Importaciones
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form class="form-inline hidden-print" method="POST" action="{{ url('reportes/importacions')}}" style="text-align: right;">
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
                                        <button class="btn btn-default hidden-print pull-right margin-left-xs" onclick="window.print()"><i class="fa fa-print" aria-hidden="true"></i> Imprimir</button>
                                    </form>
                                    <div class="row hidden-print">
                                        <div class="col-lg-12 text-center">
                                            <h3>Productos mas Importados</h3>
                                            @if(!empty($varproductos))
                                            <table class="table">
                                                @foreach ($varproductos as $varproducto)
                                                    @php($varproducto[2] = 100/$cantidadimportados*$varproducto[1])
                                                    <tr>
                                                        <td width="20%" class="text-right">{{$varproducto[0]}}</td>
                                                        <td width="10%" class="text-right">{{$varproducto[1]}} u</td>
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
                                    @if(!empty($productos))
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">Nº</th>
                                                    <th class="text-center">Fecha</th>
                                                    <th>Producto</th>
                                                    <th class="text-center">Estado</th>
                                                    @if ( !Auth::guest())
                                                        <th class="text-center">Cantidad</th>
                                                    @endif
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $num=1?>
                                                @foreach ($productos as $producto)
                                                    <tr>
                                                        <td class="text-center"><?php echo $num; $num++; ?></td>
                                                        <td class="text-center">{{date('h:i a - d/m/Y', strtotime($producto['imp_fecha']))}}</td>
                                                        <td width="50%">
                                                            <strong><big>{{$producto['producto']['pro_nombre']}}</big></strong><br>
                                                            <strong>Tipo: </strong>{{$producto['producto']['tipo']['tip_nombre']}}<br>
                                                            <strong>Descripcion: </strong>{{$producto['producto']['pro_descripcion']}}
                                                        </td>
                                                        <td class="text-center">{{$producto['imp_estado']}}</td>
                                                        <td class="text-center">{{$producto['imp_cantidad']}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
        </div>
    </div>
</div>
@stop
