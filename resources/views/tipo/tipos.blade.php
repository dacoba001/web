@extends('layouts.app')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Administrar Tipos</h1>
                <ul class="nav nav-tabs">
                    <li><a href="/tipos">Morstar Tipos</a></li>
                    <li class="active"><a href="{{ url('tipos/create')}}">Registrar Tipo</a></li>
                </ul>
                <br>
                <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Registrar Tipo
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('tipos')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group{{ $errors->has('tip_nombre') ? ' has-error' : '' }}">
                                            <label for="tip_nombre" class="control-label">Nombre del Tipo</label>
                                            <input id="tip_nombre" type="text" class="form-control" name="tip_nombre" value="{{ old('tip_nombre') }}">
                                            @if ($errors->has('tip_nombre'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('tip_nombre') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('tip_image_file') ? ' has-error' : '' }}">
                                            <label for="tip_image_file" class="control-label">Imagen del Tipo</label>
                                            <input id="tip_image_file" type="file" class="form-control" name="tip_image_file" value="{{ old('tip_image_file') }}">
                                            @if ($errors->has('tip_image_file'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('tip_image_file') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn pull-right btn-success margin-left-md">Registrar Tipo</button>
                                <a href="/tipos" type="reset" class="btn pull-right btn-danger">Cancelar Registro</a>
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