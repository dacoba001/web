@extends('layouts.app')
@section('content')
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <h1>Administrar Pedidos</h1>
                    <ul class="nav nav-tabs">
                        <li><a href="/pedidos">Morstar Peidos</a></li>
                        <li class="active"><a>Detalle del pedido</a></li>
                    </ul>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Pedidos
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Tipo</th>
                                                    <th>Descripcion del Producto</th>
                                                    <th class="text-right">Precio</th>
                                                    @if ( !Auth::guest())
                                                        <th class="text-center">Cantidad</th>
                                                        <th class="text-right">Sub Total</th>
                                                    @endif
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $total = 0 ?>
                                                @foreach ($detallepedido as $id => $producto)
                                                    <tr @if ($producto['producto']['stocks']['stk_cantidad'] < $producto['ped_cantidad']) style="background: rgba(255, 0, 0, 0.05);" @endif>
                                                        <td>{{$producto['producto']['pro_nombre']}}</td>
                                                        <td>{{$producto['producto']['tipo']['tip_nombre']}}</td>
                                                        <td>{{$producto['producto']['pro_descripcion']}}</td>
                                                        <td class="text-right">{{$producto['ped_precio']}} Bs.</td>
                                                        <td class="text-center">{{$producto['ped_cantidad']}}
                                                            @if ($producto['producto']['stocks']['stk_cantidad'] < $producto['ped_cantidad'])
                                                                <i class="fa fa-exclamation-circle" aria-hidden="true" style="color:#af1b1b;" title="Stock: {{ $producto['producto']['stocks']['stk_cantidad'] }}"></i>
                                                            @endif
                                                        </td>
                                                        <td class="text-right">{{$producto['ped_precio'] * $producto['ped_cantidad']}} Bs.</td>
                                                    </tr>
                                                    <?php $total += $producto['ped_precio'] * $producto['ped_cantidad'] ?>
                                                @endforeach
                                                <tr>
                                                    <td style="border: 1px solid transparent"></td>
                                                    <td style="border: 1px solid transparent"></td>
                                                    <td style="border: 1px solid transparent"></td>
                                                    <td style="border: 1px solid transparent"></td>
                                                    <td style="border: 1px solid transparent" class="text-right"><b>Total:</b></td>
                                                    <td style="border: 1px solid transparent" class="text-right">{{ $total }} Bs.</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            @if (isset($error))
                                            <div class="alert alert-danger">
                                                <strong>Stock no suficiente!</strong> No se puede realizar la validacion.
                                            </div>
                                            @endif
                                            @if ( Auth::user()->tipo_cuenta == 'Administrador')
                                                @if ( $pedido['ped_estado'] == 'pendiente')
                                                    <form class="form-horizontal" role="form" method="POST">
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        {{ csrf_field() }}
                                                        <td>
                                                            <button class="btn pull-right btn-success margin-left-md" type="submit">
                                                                <i class="fa fa-cart-plus fa-1x"></i>
                                                                Validar Pedido
                                                            </button>
                                                        </td>
                                                    </form>
                                                @endif
                                            @endif
                                            <a href="/pedidos" class="btn pull-right btn-danger">Atras</a>
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