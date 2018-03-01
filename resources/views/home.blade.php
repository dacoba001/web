@extends('layouts.app')

@section('content')
<style>
    div.gallery {
        margin: 5px;
        border: 1px solid #ccc;
        /*float: left;*/
        /*width: 280px;*/
    }

    div.gallery:hover {
        border: 1px solid #A94442;
        color: #A94442;
    }

    div.gallery img {
        width: 100%;
        height: auto;
    }

    div.desc {
        padding: 15px;
        text-align: center;
        font-size: 22px;
    }
</style>
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
                        @foreach ($productos as $producto)
                            <div class="col-lg-4 col-md-6 col-xs-12">
                                <div class="gallery">
                                    <img src="{{URL::asset('assets/images/productos')}}/{{$producto['pro_image']}}" alt="{{$producto['pro_nombre']}}" width="500" height="400">
                                    <div class="desc">{{$producto['pro_nombre']}}<br>
                                        <small><small><strong>Precio: </strong>{{ $producto['stocks']['stk_precio'] }} Bs.</small></small>
                                    @if ( !Auth::guest())
                                            <form class="form-horizontal" role="form" method="POST" action="{{ url('carritos')}}">
                                                {{ csrf_field() }}
                                                <div class="input-group">
                                                    <input name="car_cantidad" type="number" class="form-control" placeholder="cantidad del producto" value="1" style="text-align:right">
                                                    <input type="hidden" name="car_precio" value="{{ $producto['stocks']['stk_precio'] }}">
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                    <input type="hidden" name="producto_id" value="{{ $producto['id'] }}">
                                                    <span class="input-group-btn">
                                                        {{--<button class="btn btn-secondary" type="button">Go!</button>--}}
                                                        <button  @if (in_array($producto['id'], $items)) class="btn btn-primary" @else class="btn btn-success" @endif   type="submit">
                                                            <i  @if (in_array($producto['id'], $items)) class="fa fa-plus fa-1x" @else class="fa fa-cart-plus fa-1x" @endif></i>
                                                            @if (in_array($producto['id'], $items)) Aumentar @else Añadir @endif al carrito
                                                        </button>
                                                    </span>
                                                </div>
                                            </form>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
