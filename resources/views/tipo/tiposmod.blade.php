@extends('layouts.app')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Administrar Tipos</h1>
                <ul class="nav nav-tabs">
                    <li><a href="/tipos">Morstar Tipos</a></li>
                    <li><a href="{{ url('tipos/create')}}">Registrar Tipo</a></li>
                    <li class="active"><a href="#">Modificar Tipo</a></li>
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
                            <form class="form-horizontal" role="form" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group{{ $errors->has('tip_nombre') ? ' has-error' : '' }}">
                                            <label for="tip_nombre" class="control-label">Nombre del Tipo</label>
                                            <input id="tip_nombre" type="text" class="form-control" name="tip_nombre" value="{{ $tip_nombre or old('tip_nombre') }}">
                                            @if ($errors->has('tip_nombre'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('tip_nombre') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn pull-right btn-warning margin-left-md">Modificar Tipo</button>
                                <a href="/tipos" type="reset" class="btn pull-right btn-danger">Cancelar Modificacion</a>
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