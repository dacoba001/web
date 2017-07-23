@extends('layouts.app')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Administrar usuarios</h1>
                <ul class="nav nav-tabs">
                    <li><a href="/usuarios">Morstar usuarios</a></li>
                    <li class="active"><a href="{{route('reg_usuarios')}}">Registrar usuario</a></li>
                </ul>
                <br>
                <div class="row">
            <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Registrar usuario
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                           <form class="form-horizontal" role="form" method="POST" action="{{ url('/reg_usuarios') }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                            <label for="nombre" class="control-label">Nombre</label>
                                            <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}">
                                            @if ($errors->has('nombre'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('nombre') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group{{ $errors->has('appaterno') ? ' has-error' : '' }}">
                                            <label for="appaterno" class="control-label">Apellido paterno</label>
                                            <input id="appaterno" type="text" class="form-control" name="appaterno" value="{{ old('appaterno') }}">
                                            @if ($errors->has('appaterno'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('appaterno') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group{{ $errors->has('apmaterno') ? ' has-error' : '' }}">
                                            <label for="apmaterno" class="control-label">Apellido materno</label>
                                            <input id="apmaterno" type="text" class="form-control" name="apmaterno" value="{{ old('apmaterno') }}">
                                            @if ($errors->has('apmaterno'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('apmaterno') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tipo_cuenta" class="control-label">Tipo de cuenta</label>
                                            <select id="tipo_cuenta" name="tipo_cuenta" class="form-control">
                                                <option value="Administrador">Administrador</option>
                                                <option value ="Secretaria">Secretaria</option>
                                                <option value="Cliente">Cliente</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('nombredeusuario') ? ' has-error' : '' }}">
                                            <label for="nombredeusuario" class="control-label">Nombre de usuario</label>
                                            <input id="nombredeusuario" type="text" class="form-control" name="nombredeusuario" value="{{ old('nombredeusuario') }}">
                                            @if ($errors->has('nombredeusuario'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('nombredeusuario') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password" class="control-label">Contraseña</label>
                                            <input id="password" type="password" class="form-control" name="password">
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                            <label for="password-confirm" class="control-label">Confirme su Contraseña</label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                            @if ($errors->has('password_confirmation'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class="control-label">Correo electronico</label>
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group{{ $errors->has('fecha_nac') ? ' has-error' : '' }}">
                                            <label for="fecha_nac" class="control-label">Fecha de nacimiento</label>
                                            <input id="fecha_nac" type="date" class="form-control" name="fecha_nac" value="{{ old('fecha_nac') }}">
                                            @if ($errors->has('fecha_nac'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('fecha_nac') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                                            <label for="telefono" class="control-label">Telefono</label>
                                            <input id="telefono" type="number" class="form-control" name="telefono" value="{{ old('telefono') }}">
                                            @if ($errors->has('telefono'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('telefono') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn pull-right btn-success margin-left-md">Registrar usuario</button>
                                <a href="/usuarios" type="reset" class="btn pull-right btn-danger">Cancelar regisro</a>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
</div>
<!-- /#page-content-wrapper -->
@stop