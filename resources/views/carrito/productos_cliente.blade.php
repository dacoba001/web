@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Productos del Carrito
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
                                        <th class="text-center" style="width: 1px;">Opcion</th>
                                    @endif
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php $total = 0 ?>
                                    @foreach ($productos as $id => $producto)
                                    <tr>
                                        <td>{{$producto['producto']['pro_nombre']}}</td>
                                        <td>{{$producto['producto']['tipo']['tip_nombre']}}</td>
                                        <td>{{$producto['producto']['pro_descripcion']}}</td>
                                        <td class="text-right">{{$producto['producto']['stocks']['stk_precio']}} Bs.</td>
                                        <td class="text-center">{{$producto['car_cantidad']}}</td>
                                        <td class="text-right">{{$producto['producto']['stocks']['stk_precio'] * $producto['car_cantidad']}} Bs.</td>
                                        <td>
                                            <form action="{{ url('carritos/')}}/{{$producto['id']}}" method="post">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="DELETE" >
                                                <button class="btn btn-danger btn-xs" type="submit">
                                                    <i class="fa fa-cart-arrow-down"></i>
                                                    Quitar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php $total += $producto['producto']['stocks']['stk_precio'] * $producto['car_cantidad'] ?>
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
                            <a href="/usuarios" class="btn pull-right btn-success margin-left-md">Realizar Pedido</a>
                            <a href="/home" class="btn pull-right btn-primary">Productos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
