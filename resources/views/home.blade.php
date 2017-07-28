@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Nuestros Productos
                    @if ( !Auth::guest())
                        <a href="{{ url('carritos/productos/')}}/{{ Auth::user()->id }}" class="btn btn-success btn-xs pull-right">
                            <span class="fa fa-shopping-cart"> Carrito:   {{$carr_cant}}</span>
                        </a>
                    @endif
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
                                    <th>Precio</th>
                                    @if ( !Auth::guest())
                                        <th>Cantidad</th>
                                        <th class="text-center" style="width: 1px;">Opcion</th>
                                    @endif
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $id => $producto)
                                    <tr>
                                        <td>{{$producto['pro_nombre']}}</td>
                                        <td>{{$producto['tipo']['tip_nombre']}}</td>
                                        <td>{{$producto['pro_descripcion']}}</td>
                                        <td>{{$producto['stocks']['stk_precio']}}</td>
                                        @if ( !Auth::guest())
                                            <form class="form-horizontal" role="form" method="POST" action="{{ url('carritos')}}">
                                                {{ csrf_field() }}
                                                <td><input name="car_cantidad" type="number" class="form-control" placeholder="cantidad del producto"></td>
                                                <td>
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                    <input type="hidden" name="producto_id" value="{{ $producto['id'] }}">
                                                    <button class="btn btn-success" type="submit">
                                                        <i class="fa fa-cart-plus fa-1x"></i>
                                                        Añadir al carrito
                                                    </button>
                                                </td>
                                            </form>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
