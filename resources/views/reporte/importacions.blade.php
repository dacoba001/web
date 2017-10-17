@extends('layouts.app')
@section('content')
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <h1>Reportes</h1>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="{{ url('reportes/importacions')}}">Reporte de Importaciones</a></li>
                        <li><a href="{{ url('reportes/pedidos')}}">Reporte de Pedidos</a></li>
                    </ul>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Registrar Cliente
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form class="form-inline" method="POST" action="{{ url('reportes/importacions')}}" style="text-align: right;">
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
                                                    <th>Nombre</th>
                                                    <th>Tipo</th>
                                                    <th>Descripcion del Producto</th>
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
                                                        <td class="text-center">{{date('h:i - d/m/Y', strtotime($producto['imp_fecha']))}}</td>
                                                        <td>{{$producto['producto']['pro_nombre']}}</td>
                                                        <td>{{$producto['producto']['tipo']['tip_nombre']}}</td>
                                                        <td>{{$producto['producto']['pro_descripcion']}}</td>
                                                        <td class="text-center">{{$producto['imp_estado']}}</td>
                                                        <td class="text-center">{{$producto['imp_cantidad']}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            @if (isset($mensage))
                                                <div class="alert alert-success">
                                                    <strong>¡Importado! </strong>{{ $mensage }}
                                                </div>
                                            @endif
                                            @if (isset($delete))
                                                <div class="alert alert-success">
                                                    <strong>¡Borrado! </strong>{{ $delete }}
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
                        <!-- /.col-lg-12 -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
@stop
