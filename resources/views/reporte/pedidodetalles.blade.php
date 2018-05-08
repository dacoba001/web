@extends('layouts.app')
@section('content')
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <h1>Reportes</h1>
                    <ul class="nav nav-tabs">
                        <li><a href="{{ url('reportes/importacions')}}">Reporte de Importaciones</a></li>
                        <li class="active"><a href="{{ url('reportes/pedidos')}}">Reporte de Pedidos</a></li>
                        <li><a href="{{ url('reportes/stocks')}}">Reporte de Stocks</a></li>
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
                                                    <th width="50%">Producto</th>
                                                    <th class="text-right">Precio</th>
                                                    <th class="text-center">Cantidad</th>
                                                    <th class="text-center">Por Entregar</th>
                                                    <th class="text-center">Entregados</th>
                                                    <th class="text-center">Devuelto</th>
                                                    <th class="text-right">Sub Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $totalSinDevuelto = 0 ?>
                                                <?php $totalEntregado = 0 ?>
                                                <?php $totalDevuelto = 0 ?>
                                                <?php $totalNeto = 0 ?>
                                                @foreach ($detallepedido as $id => $producto)
                                                    <tr>
                                                        <td>{{$producto['producto']['pro_nombre']}}
                                                            <br><strong>Tipo:</strong> {{$producto['producto']['tipo']['tip_nombre']}}
                                                            <br><strong>Descripcion:</strong> {{$producto['producto']['pro_descripcion']}}
                                                        </td>
                                                        <td class="text-right align-middle">{{$producto['ped_precio']}} Bs.</td>
                                                        <td class="text-center align-middle">{{$producto['ped_cantidad']}}</td>
                                                        <td class="text-center align-middle">{{$producto['ped_cantidad'] - $producto['ped_cantidad_entregado']}}
                                                        <td class="text-center align-middle">{{$producto['ped_cantidad_entregado']}}</td>
                                                        <td class="text-center align-middle">{{$producto['ped_cantidad_devuelto']}}</td>
                                                        <td class="text-right align-middle">{{number_format((float)$producto['ped_precio'] * $producto['ped_cantidad'], 2, '.', '')}} Bs.</td>
                                                    </tr>
                                                    <?php $totalSinDevuelto += $producto['ped_precio'] * $producto['ped_cantidad'] ?>
                                                    <?php $totalEntregado += $producto['ped_precio'] * $producto['ped_cantidad_entregado'] ?>
                                                    <?php $totalDevuelto += $producto['ped_precio'] * $producto['ped_cantidad_devuelto'] ?>
                                                    <?php $totalNeto += $producto['ped_precio'] * ($producto['ped_cantidad_entregado'] - $producto['ped_cantidad_devuelto']) ?>
                                                @endforeach
                                                <tr class="prices_details">
                                                    <td colspan="4" style="border: 1px solid transparent"></td>
                                                    <td colspan="2" style="border: 1px solid transparent" class="text-right"><b>Monto Total:</b></td>
                                                    <td style="border: 1px solid transparent" class="text-right"><b>{{number_format((float)$totalSinDevuelto, 2, '.', '')}} Bs.</b></td>
                                                </tr>
                                                <tr class="prices_details">
                                                    <td colspan="4" style="border: 1px solid transparent"></td>
                                                    <td colspan="2" style="border: 1px solid transparent" class="text-right"><b>Monto Entregado:</b></td>
                                                    <td style="border: 1px solid transparent" class="text-right">{{number_format((float)$totalEntregado, 2, '.', '')}} Bs.</td>
                                                </tr>
                                                <tr class="prices_details">
                                                    <td colspan="4" style="border: 1px solid transparent"></td>
                                                    <td colspan="2" style="border: 1px solid transparent" class="text-right"><b>Monto Devuelto:</b></td>
                                                    <td style="border: 1px solid transparent" class="text-right">- {{number_format((float)$totalDevuelto, 2, '.', '')}} Bs.</td>
                                                </tr>
                                                <tr class="prices_details">
                                                    <td colspan="4" style="border: 1px solid transparent"></td>
                                                    <td colspan="2" style="border: 1px solid transparent" class="text-right"><b>Monto Neto:</b></td>
                                                    <td style="border: 1px solid transparent;border-top: 2px solid;" class="text-right">{{number_format((float)$totalNeto, 2, '.', '')}} Bs.</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            @if (isset($error))
                                            <div class="alert alert-danger">
                                                <strong>Stock no suficiente!</strong> No se puede realizar la validacion.
                                            </div>
                                            @endif
                                            <a href="/reportes/pedidos" class="btn pull-right btn-danger">Atras</a>
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