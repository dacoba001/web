@extends('layouts.app')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Administrar Tipos</h1>
                <ul class="nav nav-tabs">
                    <li class="active"><a href="/tipos">Morstar Tipos</a></li>
                    <li><a href="{{ url('tipos/create')}}">Registrar Tipo</a></li>
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
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Nombre del Tipo</th>
                                    <th class="text-center" style="width: 1px;">Modificar</th>
                                    <th class="text-center" style="width: 1px;">Eliminar</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tipos as $id => $tipo)
                                    <tr>
                                        <td>{{$tipo['tip_nombre']}}</td>
                                        <td>
                                            <a href="{{ url('tipos/')}}/{{$tipo['id']}}" class="btn btn-warning">Modificar</a>
                                        </td>
                                        <td>
                                            <form action="{{ url('tipos/')}}/{{$tipo['id']}}" method="post">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="DELETE" >
                                                <input class="btn btn-danger" type="submit" value="Eliminar" >
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if (isset($error))
                                <div class="alert alert-danger">
                                   <strong>¡Error! </strong>{{ $error }}
                                </div>
                            @endif
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