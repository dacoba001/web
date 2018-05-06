@extends('layouts.app')
@section('content')
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <h1>Administrar Importaciones</h1>
                    <ul class="nav nav-tabs">
                        <li><a href="{{ url('importacions/create')}}">Registrar Importacion</a></li>
                        <li class="active"><a href="{{ url('importacions')}}">Morstar Importaciones</a></li>
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
                                                    <th>Fecha</th>
                                                    <th>Nombre</th>
                                                    <th>Tipo</th>
                                                    <th class="text-center">Cantidad</th>
                                                    <th class="text-center">Estado Actual</th>
                                                    @if ( !Auth::guest())
                                                        <th class="text-center" style="width: 1px;">Opcion</th>
                                                    @endif
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($productos as $id => $producto)
                                                    <tr>
                                                        <td>{{$producto['imp_fecha']}}</td>
                                                        <td>{{$producto['producto']['pro_nombre']}}</td>
                                                        <td>{{$producto['producto']['tipo']['tip_nombre']}}</td>
                                                        <td class="text-center">{{$producto['imp_cantidad']}}</td>
                                                        <td class="text-center">{{$producto['imp_estado']}}</td>
                                                        @if ( !Auth::guest())
                                                            <td>
                                                                <form action="{{ url('importacions/')}}/{{$producto['id']}}" method="POST">
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <input type="hidden" name="_method" value="PUT">
                                                                    <button class="btn btn-success btn-lg" type="submit" @if ( $producto['imp_estado'] == "Importado") style="display: none;" @endif>
                                                                        @if ($producto['imp_estado'] === "Peticion")
                                                                            A Embarcado
                                                                        @elseif ($producto['imp_estado'] === "Embarcado")
                                                                            A En Frontera
                                                                        @elseif ($producto['imp_estado'] === "En Frontera")
                                                                            A Canal Aduanero
                                                                        @elseif ($producto['imp_estado'] === "Canal Aduanero")
                                                                            A Aduana Nacional
                                                                        @elseif ($producto['imp_estado'] === "Aduana Nacional")
                                                                            Importar
                                                                        @endif
                                                                    </button>
                                                                </form>
                                                                <form action="{{ url('importacions/')}}/{{$producto['id']}}" method="POST">
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <input type="hidden" name="_method" value="DELETE" >
                                                                    <button class="btn btn-danger btn-xs btn-block" type="submit" @if ( $producto['imp_estado'] == "Importado") disabled @endif>
                                                                        <i class="fa fa-cart-arrow-down"></i>
                                                                        Quitar
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            @if (isset($mensage))
                                                <div class="alert alert-success">
                                                    <strong>¡Importado! </strong>{{ $mensage }}
                                                </div>
                                            @endif
                                            @if (isset($delete))
                                                <div class="alert alert-success">
                                                    <strong>¡Borrado! </strong>{{ $delete }}
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
