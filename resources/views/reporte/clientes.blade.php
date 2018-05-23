@extends('layouts.app')
@section('content')
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <h1>Reporte de Clientes</h1>
                    @include('reporte.fecha_reporte')
                    <ul class="nav nav-tabs hidden-print">
                        <li><a href="{{ url('reportes/importacions')}}">Reporte de Importaciones</a></li>
                        <li><a href="{{ url('reportes/pedidos')}}">Reporte de Pedidos</a></li>
                        <li><a href="{{ url('reportes/stocks')}}">Reporte de Stocks</a></li>
                        <li class="active"><a href="{{ url('reportes/clientes')}}">Reporte de Clientes</a></li>
                    </ul>
                    <br>
                    <?php
                    $varclientes = [];
                    $cantidadproductos = 0;
                    foreach ($clientes as $cliente)
                    {
                        $varclientes[$cliente['id']][0] = $cliente['nombre'] . ' ' . $cliente['apmaterno'] . ' ' . $cliente['appaterno'];
                        $varclientes[$cliente['id']][1] = $cliente['cant_productos'];
                        $cantidadproductos += $cliente['cant_productos'];
                    }
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Clientes
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form class="form-inline hidden-print" method="POST" action="{{ url('reportes/clientes')}}" style="text-align: right;">
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
                                                    <h3>Clientes mas Frecuentes</h3>
                                                    @if(!empty($varclientes))
                                                        <table class="table">
                                                            @foreach ($varclientes as $varcliente)
                                                                @php($varcliente[2] = 100/$cantidadproductos*$varcliente[1])
                                                                <tr>
                                                                    <td width="20%" class="text-right">{{$varcliente[0]}}</td>
                                                                    <td width="10%" class="text-right">{{$varcliente[1]}} u</td>
                                                                    <td><div class="progress" style="margin-bottom: 0px;">
                                                                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:{{$varcliente[2]}}%">
                                                                                {{round($varcliente[2])}}%
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
                                            @if(!empty($clientes))
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th class="text-center">Nº</th>
                                                            <th width="30%">Nombre</th>
                                                            <th class="text-center">Telefono</th>
                                                            <th class="text-center">Cantidad Pedidos</th>
                                                            <th class="text-center">Cantidad Productos</th>
                                                            {{--<th class="text-center hidden-print">Opciones</th>--}}
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $num=1?>
                                                        @foreach ($clientes as $cliente)
                                                            <tr>
                                                                <td class="text-center"><?php echo $num; $num++; ?></td>
                                                                <td>{{$cliente['nombre']}} {{$cliente['apmaterno']}} {{$cliente['appaterno']}}</td>
                                                                <td class="text-center">{{$cliente['telefono']}}</td>
                                                                <td class="text-center">{{$cliente['cant_pedidos']}}</td>
                                                                <td class="text-center">{{$cliente['cant_productos']}}</td>
                                                                {{--<td class="text-center hidden-print">--}}
                                                                    {{--<a href="{{ url('reportes/clientes/')}}/{{$cliente['id']}}" class="btn btn-default btn-xs">Mas Detalles</a>--}}
                                                                {{--</td>--}}
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
@stop
