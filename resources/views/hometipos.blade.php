@extends('layouts.app')

@section('content')
<style>
    div.gallery {
        margin: 5px;
        border: 1px solid #ccc;
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
                        @foreach ($tipos as $tipo)
                            <div class="col-lg-4 col-md-6 col-xs-12">
                                <div class="gallery">
                                    <a href="{{ url('home/productos')}}/{{$tipo['id']}}">
                                        <img src="{{URL::asset('assets/images/tipos')}}/{{$tipo['tip_image']}}" alt="{{$tipo['tip_nombre']}}" width="500" height="400">
                                    </a>
                                    <div class="desc">{{$tipo['tip_nombre']}}
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
