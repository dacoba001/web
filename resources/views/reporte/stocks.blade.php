@extends('layouts.app')
@section('content')
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <h1>Reportes</h1>
                    <ul class="nav nav-tabs">
                        <li><a href="{{ url('reportes/importacions')}}">Reporte de Importaciones</a></li>
                        <li><a href="{{ url('reportes/pedidos')}}">Reporte de Pedidos</a></li>
                        <li class="active"><a href="{{ url('reportes/stocks')}}">Reporte de Stocks</a></li>
                        <li><a href="{{ url('reportes/clientes')}}">Reporte de Clientes</a></li>
                    </ul>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Importaciones
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form class="form-inline" method="POST" action="{{ url('reportes/stocks')}}" style="text-align: right;">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label for="start_date">Producto: </label>
                                                    <select name="stock_id" class="form-control">
                                                        <option value="0">Todos</option>
                                                        @foreach ( $stocks as $stock )
                                                            <option value="{{$stock['id']}}" @if (isset($stock_id) and $stock_id == $stock['id']) selected @endif >{{$stock['producto']['pro_nombre']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
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
                                            <br>
                                            @if(!empty($stock_moves))
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th class="text-center">Nº</th>
                                                            <th class="text-center">Fecha</th>
                                                            <th width="30%">Nombre</th>
                                                            <th>Tipo de Movimiento</th>
                                                            <th class="text-center">Cantidad Move</th>
                                                            <th class="text-center">Cantidad Stock</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $num=1?>
                                                        @foreach ($stock_moves as $stock_move)
                                                            <tr>
                                                                <td class="text-center"><?php echo $num; $num++; ?></td>
                                                                <td class="text-center">{{date('h:i a - d/m/Y', strtotime($stock_move['created_at']))}}</td>
                                                                <td>{{$stock_move['stock']['producto']['pro_nombre']}}
                                                                    <a data-toggle="collapse" href="#collapseStock{{$stock_move['id']}}" role="button" aria-expanded="false" aria-controls="#collapseStock{{$stock_move['id']}}">
                                                                        ...
                                                                    </a>
                                                                    <div class="collapse" id="collapseStock{{$stock_move['id']}}">
                                                                        <strong>Descripcion:</strong>
                                                                        {{$stock_move['stock']['producto']['pro_descripcion']}}
                                                                    </div>
                                                                </td>
                                                                <td>{{$stock_move['tipo']}}</td>
                                                                <td class="text-center">{{$stock_move['cantidad_move']}}</td>
                                                                <td class="text-center">{{$stock_move['cantidad_stock']}}
                                                                    @if($stock_move['tipo'] == 'Importacion')
                                                                        <i class="text-success glyphicon glyphicon-chevron-up"></i>
                                                                    @elseif($stock_move['tipo'] == 'Entrega')
                                                                        <i class="text-danger glyphicon glyphicon-chevron-down"></i>
                                                                    @elseif($stock_move['tipo'] == 'Manual')
                                                                        <i class="text-primary glyphicon glyphicon-retweet"></i>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                <div class="text-center" style="margin-bottom: 20px">No hay datos disponibles</div>
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
