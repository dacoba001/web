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
                                                    <th>Nombre</th>
                                                    <th>Tipo</th>
                                                    <th>Descripcion del Producto</th>
                                                    <th class="text-center">Cantidad Actual</th>
                                                    @if ( !Auth::guest())
                                                        <th>Cantidad</th>
                                                        <th class="text-center" style="width: 1px;">Opcion</th>
                                                    @endif
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($productos as $id => $producto)
                                                    <tr>
                                                        <td>{{$producto['pro_nombre']}}</td>
                                                        <td>{{$producto['tipo']['tip_nombre']}}</td>
                                                        <td>{{$producto['pro_descripcion']}}</td>
                                                        <td class="text-center" @if ($producto['stocks']['stk_cantidad'] <= $producto['stocks']['stk_cantmin']) title="Cantidad minima: {{ $producto['stocks']['stk_cantmin'] }}" @endif>{{$producto['stocks']['stk_cantidad']}}
                                                            @if ($producto['stocks']['stk_cantidad'] <= $producto['stocks']['stk_cantmin'])
                                                                <i class="fa fa-exclamation-circle" aria-hidden="true" style="color:#af1b1b;cursor: pointer;" ></i>
                                                            @endif
                                                        </td>
                                                        @if ( !Auth::guest())
                                                            <form class="form-horizontal" role="form" method="POST" action="{{ url('importacions')}}">
                                                                {{ csrf_field() }}
                                                                <td><input name="imp_cantidad" type="number" class="form-control" placeholder="cantidad del producto" min="1"></td>
                                                                <td>
                                                                    <input type="hidden" name="producto_id" value="{{ $producto['id'] }}">
                                                                    <button class="btn btn-success" type="submit">
                                                                        <i class="fa fa-caret-square-o-up fa-1x"></i>
                                                                        Importar Producto
                                                                    </button>
                                                                </td>
                                                            </form>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            @if (isset($mensage))
                                                <div class="alert alert-warning">
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