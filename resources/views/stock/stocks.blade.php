@extends('layouts.app')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Administrar Stocks</h1>
                 <ul class="nav nav-tabs">
                    <li><a href="/stocks">Morstar Stocks</a></li>
                    <li class="active"><a href="{{ url('stocks/create')}}">Registrar Stock</a></li>
                </ul>
                <br>
                <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Registrar Stock
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                             <form class="form-horizontal" role="form" method="POST" action="{{ url('stocks/')}}">
                                    {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group{{ $errors->has('producto_id') ? ' has-error' : '' }}">
                                            <label for="producto_id" class="control-label">Producto</label>
                                            <select name="producto_id" class="form-control">
                                                @foreach ( $productos as $producto )
                                                    @if ($producto['stocks'] == null)
                                                        <option value="{{$producto['id']}}">{{$producto['pro_nombre']}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @if ($errors->has('producto_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('producto_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('stk_precio') ? ' has-error' : '' }}">
                                            <label for="stk_precio" class="control-label">Precio del Producto</label>
                                            <input name="stk_precio" type="number" step="0.01" value="0.00" class="form-control" placeholder="precio del producto" style="text-align:right;">
                                            @if ($errors->has('stk_precio'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('stk_precio') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('stk_cantidad') ? ' has-error' : '' }}">
                                            <label for="stk_cantidad" class="control-label">Cantidad en Cajas</label>
                                            <input name="stk_cantidad" type="number" class="form-control" placeholder="cantidad del producto" style="text-align:right;">
                                            @if ($errors->has('stk_cantidad'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('stk_cantidad') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('stk_cantmin') ? ' has-error' : '' }}">
                                            <label for="stk_cantmin" class="control-label">Cantidad de Stock Minima</label>
                                            <input name="stk_cantmin" type="number" class="form-control" placeholder="cantidad minima del producto" style="text-align:right;">
                                            @if ($errors->has('stk_cantmin'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('stk_cantmin') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn pull-right btn-success margin-left-md">Registrar Stock</button>
                                <a href="/stocks" type="reset" class="btn pull-right btn-danger">Cancelar Regisro</a>
                            </form>
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