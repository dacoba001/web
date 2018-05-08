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
                                                    <th>Nombre</th>
                                                    <th class="text-center">Fecha</th>
                                                    <th class="text-center">Cantidad a Importar</th>
                                                    <th class="text-center">Estado de la Importacion</th>
                                                    @if ( !Auth::guest())
                                                        <th class="text-center" style="width: 1px;">Opcion</th>
                                                    @endif
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($productos as $id => $producto)
                                                    @if($producto['imp_estado'] != "Importado")
                                                        <tr>
                                                            <td>
                                                                <big><strong>{{$producto['producto']['pro_nombre']}}</strong></big><br>
                                                                <strong>Tipo: </strong>{{$producto['producto']['tipo']['tip_nombre']}}
                                                            </td>
                                                            <td class="text-center">{{date('h:i a - d/m/Y', strtotime($producto['imp_fecha']))}}</td>
                                                            <td class="text-center">{{$producto['imp_cantidad']}}</td>
                                                            <td class="text-center"><big><strong>{{$producto['imp_estado']}}</strong></big><br>
                                                                <form action="{{ url('importacions/')}}/{{$producto['id']}}" method="POST">
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <input type="hidden" name="_method" value="PUT">
                                                                    <button class="btn btn-success" type="submit" @if ( $producto['imp_estado'] == "Importado") style="display: none;" @endif>
                                                                        Cambiar a
                                                                        @if ($producto['imp_estado'] === "Peticion")
                                                                            Embarcado
                                                                        @elseif ($producto['imp_estado'] === "Embarcado")
                                                                            Frontera
                                                                        @elseif ($producto['imp_estado'] === "En Frontera")
                                                                            Canal Aduanero
                                                                        @elseif ($producto['imp_estado'] === "Canal Aduanero")
                                                                            Aduana Nacional
                                                                        @elseif ($producto['imp_estado'] === "Aduana Nacional")
                                                                            Importado
                                                                        @endif
                                                                    </button>
                                                                </form>
                                                            </td>
                                                            @if ( !Auth::guest())
                                                                <td>
                                                                    <form action="{{ url('importacions/')}}/{{$producto['id']}}" method="POST">
                                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                        <input type="hidden" name="_method" value="DELETE" >
                                                                        <button class="btn btn-danger" type="submit" @if ( $producto['imp_estado'] == "Importado") disabled @endif>
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                            @if (isset($mensage))
                                                <div class="alert alert-success">
                                                    <strong>¡Exitoso! </strong>{{ $mensage }}
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
