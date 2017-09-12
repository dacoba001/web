@extends('layouts.app')
@section('content')
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <h1>Administrar Productos</h1>
                        <ul class="nav nav-tabs">
                            <li><a href="/productos">Morstar Productos</a></li>
                            <li><a href="{{ url('productos/create')}}">Registrar Producto</a></li>
                            <li class="active"><a href="#">Modificar Producto</a></li>
                        </ul>
                        <br>
                        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Modificar Producto
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form class="form-horizontal" role="form" method="POST">
		                                <input type="hidden" name="_method" value="PUT">
		                            	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    	{{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Nombre del Producto:</label>
                                                    <input name="pro_nombre" class="form-control" placeholder="Nombre del producto" value="{{ $producto['pro_nombre'] or old('pro_nombre') }}" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Descripcion del Producto</label>
                                            <textarea name="pro_descripcion" class="form-control" rows="3">{{ $producto['pro_descripcion'] or old('pro_descripcion') }}</textarea>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Codigo del Producto</label>
                                                    <input name="pro_codigo" class="form-control" placeholder="codigo del producto" value="{{ $producto['pro_codigo'] or old('pro_codigo') }}" >
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Tipo de Producto</label>
                                                    <select name="tipo_id" class="form-control">
                                                        @foreach ( $tipos as $tipo )
                                                            <option value="{{$tipo['id']}}" @if ($producto['tipo_id'] == $tipo['id']) selected @endif >{{$tipo['tip_nombre']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn pull-right btn-warning margin-left-md">Modificar Prodcuto</button>
                                		<a href="/productos" type="reset" class="btn pull-right btn-danger">Cancelar Modificacion</a>
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