@extends('layouts.app')
@section('content')
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <h1>Administrar Productos</h1>
                        <ul class="nav nav-tabs">
                            <li><a href="/productos">Morstar Productos</a></li>
                            <li class="active"><a href="{{ url('productos/create')}}">Registrar Producto</a></li>
                        </ul>
                        <br>
                        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Registrar Producto
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('productos')}}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group{{ $errors->has('pro_nombre') ? ' has-error' : '' }}">
                                                    <label for="pro_nombre" class="control-label">Nombre del Producto:</label>
                                                    <input name="pro_nombre" class="form-control" placeholder="Nombre del producto" value="{{ old('pro_nombre') }}">
                                                    @if ($errors->has('pro_nombre'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('pro_nombre') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('pro_image_file') ? ' has-error' : '' }}">
                                            <label for="pro_image_file" class="control-label">Imagen del Prudcto</label>
                                            <input id="pro_image_file" type="file" class="form-control" name="pro_image_file" value="{{ old('pro_image_file') }}">
                                            @if ($errors->has('pro_image_file'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('pro_image_file') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="form-group{{ $errors->has('pro_descripcion') ? ' has-error' : '' }}">
                                            <label for="pro_descripcion" class="control-label">Descripcion del Producto</label>
                                            <textarea name="pro_descripcion" class="form-control" rows="3">{{ old('pro_descripcion') }}</textarea>
                                            @if ($errors->has('pro_descripcion'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('pro_descripcion') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group{{ $errors->has('pro_codigo') ? ' has-error' : '' }}">
                                                    <label for="pro_codigo" class="control-label">Codigo del Producto</label>
                                                    <input name="pro_codigo" class="form-control" placeholder="codigo del producto" value="{{ old('pro_codigo') }}">
                                                    @if ($errors->has('pro_codigo'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('pro_codigo') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group{{ $errors->has('tipo_id') ? ' has-error' : '' }}">
                                                    <label for="tipo_id" class="control-label">Tipo de Producto</label>
                                                    <select name="tipo_id" class="form-control">
                                                        @foreach ( $tipos as $tipo )
                                                            <option value="{{$tipo['id']}}" @if (old('tipo_id') == $tipo['id']) selected @endif >{{$tipo['tip_nombre']}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('tipo_id'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('tipo_id') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn pull-right btn-success margin-left-md">Registrar Producto</button>
                                        <a href="/productos" type="reset" class="btn pull-right btn-danger">Cancelar Registro</a>
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