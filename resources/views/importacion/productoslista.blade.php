@extends('layouts.app')
@section('content')
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <h1>Administrar Importaciones</h1>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="{{ url('importacions/create')}}">Registrar Importacion</a></li>
                        <li><a href="{{ url('importacions')}}">Morstar Importaciones</a></li>
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
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th width="50%">Producto</th>
                                                    <th class="text-center">Cantidad</th>
                                                    @if ( !Auth::guest())
                                                        <th class="text-center">Cantidad a Importar</th>
                                                    @endif
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($productos as $id => $producto)
                                                    <tr>
                                                        <td width="50%">
                                                            <strong><big>{{$producto['pro_nombre']}}</big></strong><br>
                                                            <strong>Tipo: </strong>{{$producto['tipo']['tip_nombre']}}<br>
                                                            <strong>Descripcion: </strong>{{$producto['pro_descripcion']}}
                                                        </td>
                                                        <td width="25%" class="text-center">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <big><strong>{{$producto['stocks']['stk_cantidad']}}</strong></big><br>
                                                                    Cantidad Actual
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <span class="{{$producto['stocks']['stk_cantidad'] <= $producto['stocks']['stk_cantmin'] ? 'text-danger' : 'text-success'}}">
                                                                        <big><strong>{{ $producto['stocks']['stk_cantmin'] }}</strong></big><br>
                                                                        Cantidad Minima
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @if ( !Auth::guest())
                                                            <td>
                                                                <form class="form-inline" method="POST" role="form" action="{{ url('importacions')}}" style="text-align: right;">
                                                                    {{ csrf_field() }}
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="input-group">
                                                                                <input name="imp_cantidad" type="number" class="form-control" placeholder="Cantidad" min="1">
                                                                                <input type="hidden" name="producto_id" value="{{ $producto['id'] }}">
                                                                                <span class="input-group-btn">
                                                                                    <button class="btn btn-primary" type="submit">Importar</button>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            @if (isset($mensage))
                                                <div class="alert alert-success">
                                                    <strong>¡Agregado! </strong>{{ $mensage }}
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