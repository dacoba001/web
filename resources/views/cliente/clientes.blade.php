@extends('layouts.app')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Administrar Clientes</h1>
                <ul class="nav nav-tabs">
                    <li><a href="/clientes">Morstar Clientes</a></li>
                    <li class="active"><a href="{{ url('clientes/create')}}">Registrar Cliente</a></li>
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
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('clientes')}}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('cli_nombre') ? ' has-error' : '' }}">
                                            <label for="cli_nombre" class="control-label">Nombre de la Ferreteria</label>
                                            <input id="cli_nombre" type="text" class="form-control" name="cli_nombre" value="{{ old('cli_nombre') }}">
                                            @if ($errors->has('cli_nombre'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('cli_nombre') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cli_zona" class="control-label">Zona</label>
                                            <select id="cli_zona" name="cli_zona" class="form-control">
                                                <option value="Norte">Norte</option>
                                                <option value ="Sur">Sur</option>
                                                <option value="Este">Este</option>
                                                <option value="Oeste">Oeste</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-12">
                                          <div class="form-group{{ $errors->has('cli_direccion') ? ' has-error' : '' }}">
                                            <label for="cli_direccion" class="control-label">Direccion de la ferreteria</label>
                                            <textarea id="cli_direccion" type="text" class="form-control" rows="3" name="cli_direccion" value="{{ old('cli_direccion') }}"></textarea>
                                            @if ($errors->has('cli_direccion'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('cli_direccion') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn pull-right btn-success margin-left-md">Registrar Cliente</button>
                                <a href="/clientes" type="reset" class="btn pull-right btn-danger">Cancelar Registro</a>
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