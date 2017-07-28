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
                                    <div class="col-lg-12">
                                        <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                                            <label for="user_id" class="control-label">Usuario del Cliente</label>
                                            <select name="user_id" class="form-control" onchange="if(this.options[this.selectedIndex].value == 'create/users'){location = this.options[this.selectedIndex].value;}">
                                                @foreach ( $users as $user )
                                                    <option value="{{$user['id']}}" @if (old('user_id') == $user['id']) selected @endif @if(isset($_REQUEST['user_id'])) @if ($_REQUEST['user_id'] == $user['id']) selected @endif @endif>{{$user['nombredeusuario']}} - {{$user['appaterno']}} {{$user['apmaterno']}}, {{$user['nombre']}}</option>
                                                @endforeach
                                                <option disabled @if ($users == null) selected @endif></option>
                                                <option value="create/users" class="text-primary">Registrar Nuevo Usuario</option>
                                            </select>
                                            @if ($errors->has('user_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('user_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
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
                                                <option value="Norte" @if (old('cli_zona') == 'Norte') selected @endif >Norte</option>
                                                <option value ="Sur" @if (old('cli_zona') == 'Sur') selected @endif >Sur</option>
                                                <option value="Este" @if (old('cli_zona') == 'Este') selected @endif >Este</option>
                                                <option value="Oeste" @if (old('cli_zona') == 'Oeste') selected @endif >Oeste</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                     <div class="col-md-12">
                                          <div class="form-group{{ $errors->has('cli_direccion') ? ' has-error' : '' }}">
                                            <label for="cli_direccion" class="control-label">Direccion de la ferreteria</label>
                                            <textarea id="cli_direccion" type="text" class="form-control" rows="3" name="cli_direccion">{{ old('cli_direccion') }}</textarea>
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