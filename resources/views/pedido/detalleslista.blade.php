@extends('layouts.app')
@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Administrar Pedidos</h1>
                <ul class="nav nav-tabs">
                        <li><a href="/pedidos">Morstar Pedidos Pendientes</a></li>
                    <li><a href="/pedidoss/estado/1">Morstar Pedidos Entregados</a></li>
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
                                @if (isset($error))
                                    <div class="alert alert-danger">
                                        <strong>¡Error! </strong>{{ $error }}
                                    </div>
                                @endif
                                @if (isset($success))
                                    <div class="alert alert-success">
                                        <strong>{{ $success }}</strong>
                                        @foreach($message as $item)
                                            <br><span>{{ $item }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th width="40%">Datos del Producto</th>
                                                <th class="text-right">Precio</th>
                                                @if ( !Auth::guest())
                                                    <th class="text-center">Por Entregar</th>
                                                    <th class="text-center">Entregados</th>
                                                    <th class="text-center">Devuelto</th>
                                                    <th class="text-right">Sub Total</th>
                                                    @if ( Auth::user()->tipo_cuenta == 'Administrador')
                                                        <th class="text-center">Accion</th>
                                                    @endif
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $totalSinDevuelto = 0 ?>
                                            <?php $totalEntregado = 0 ?>
                                            <?php $totalDevuelto = 0 ?>
                                            <?php $totalNeto = 0 ?>
                                            @foreach ($detallepedido as $id => $producto)
                                                <tr
                                                        @if ( Auth::user()->tipo_cuenta == 'Administrador')
                                                            @if ($producto['producto']['stocks']['stk_cantidad'] < ($producto['ped_cantidad'] - $producto['ped_cantidad_entregado']) and ($pedido['ped_estado'] != 'Entregado'))
                                                                style="background: rgba(255, 0, 0, 0.05);"
                                                            @endif
                                                        @endif
                                                >
                                                    <td class="text-center">
                                                        <img src="{{URL::asset('assets/images/productos')}}/{{$producto['producto']['pro_image']}}" alt="{{$producto['producto']['pro_nombre']}}" width="64" height="48">
                                                    </td>
                                                    <td>{{$producto['producto']['pro_nombre']}}
                                                    <br><strong>Tipo:</strong> {{$producto['producto']['tipo']['tip_nombre']}}
                                                        <br><strong>Descripcion:</strong> {{$producto['producto']['pro_descripcion']}}
                                                    </td>
                                                    <td class="text-right align-middle">{{$producto['ped_precio']}} Bs.</td>
                                                    <td class="text-center align-middle">{{$producto['ped_cantidad'] - $producto['ped_cantidad_entregado']}}
                                                    <td class="text-center align-middle">{{$producto['ped_cantidad_entregado']}}</td>
                                                        @if ( Auth::user()->tipo_cuenta == 'Administrador')
                                                            @if (($producto['producto']['stocks']['stk_cantidad'] < ($producto['ped_cantidad'] - $producto['ped_cantidad_entregado'])) and ($pedido['ped_estado'] != 'Entregado'))
                                                                <span class="text-danger">
                                                                    <br>Stock Insuficiente!
                                                                    <br>Stock Actual: {{ $producto['producto']['stocks']['stk_cantidad'] }}
                                                                </span>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td class="text-center align-middle">{{$producto['ped_cantidad_devuelto']}}</td>
                                                    <td class="text-right align-middle">{{$producto['ped_precio'] * $producto['ped_cantidad']}} Bs.</td>
                                                    @if ( Auth::user()->tipo_cuenta == 'Administrador')
                                                        <td class="text-center align-middle">
                                                            <button type="button" id="entregarModalbtn" class="btn btn-primary btn-sm"
                                                                    data-toggle="modal"
                                                                    data-target="#entregarModal"
                                                                    data-url="{{ url('pedidos')}}/"
                                                                    data-action="entregar/"
                                                                    data-action_text="Entregar"
                                                                    data-id="{{ $producto['id'] }}"
                                                                    data-nombre="{{ $producto['producto']['pro_nombre'] }}"
                                                                    data-image="{{ $producto['producto']['pro_image'] }}"
                                                                    data-url_image="{{URL::asset('assets/images/productos')}}/"
                                                                    data-tipo="{{ $producto['producto']['tipo']['tip_nombre'] }}"
                                                                    data-descripcion="{{ $producto['producto']['pro_descripcion'] }}"
                                                                    data-precio="{{ $producto['ped_precio'] }}"
                                                                    data-cantidad="{{ $producto['ped_cantidad'] }}"
                                                                    data-stock="{{ $producto['producto']['stocks']['stk_cantidad'] }}"
                                                                    data-cantidad_entregado="{{ $producto['ped_cantidad_entregado'] }}"
                                                                    data-cantidad_devuelto="{{ $producto['ped_cantidad_devuelto'] }}"
                                                            @if($producto['ped_cantidad'] == $producto['ped_cantidad_entregado']) disabled @endif>Entregar</button>
                                                            <button type="button" id="entregarModalbtn" class="btn btn-primary btn-sm"
                                                                    data-toggle="modal"
                                                                    data-target="#entregarModal"
                                                                    data-url="{{ url('pedidos')}}/"
                                                                    data-action="devolver/"
                                                                    data-action_text="Devolver"
                                                                    data-id="{{ $producto['id'] }}"
                                                                    data-nombre="{{ $producto['producto']['pro_nombre'] }}"
                                                                    data-image="{{ $producto['producto']['pro_image'] }}"
                                                                    data-url_image="{{URL::asset('assets/images/productos')}}/"
                                                                    data-tipo="{{ $producto['producto']['tipo']['tip_nombre'] }}"
                                                                    data-descripcion="{{ $producto['producto']['pro_descripcion'] }}"
                                                                    data-precio="{{ $producto['ped_precio'] }}"
                                                                    data-cantidad="{{ $producto['ped_cantidad'] }}"
                                                                    data-stock="{{ $producto['producto']['stocks']['stk_cantidad'] }}"
                                                                    data-cantidad_entregado="{{ $producto['ped_cantidad_entregado'] }}"
                                                                    data-cantidad_devuelto="{{ $producto['ped_cantidad_devuelto'] }}"
                                                            >Devolver</button>
                                                        </td>
                                                    @endif
                                                </tr>
                                                <?php $totalSinDevuelto += $producto['ped_precio'] * $producto['ped_cantidad'] ?>
                                                <?php $totalEntregado += $producto['ped_precio'] * $producto['ped_cantidad_entregado'] ?>
                                                <?php $totalDevuelto += $producto['ped_precio'] * $producto['ped_cantidad_devuelto'] ?>
                                                <?php $totalNeto += $producto['ped_precio'] * ($producto['ped_cantidad_entregado'] - $producto['ped_cantidad_devuelto']) ?>
                                            @endforeach
                                            <tr class="prices_details">
                                                <td colspan="4" style="border: 1px solid transparent"></td>
                                                <td colspan="2" style="border: 1px solid transparent" class="text-right"><b>Total sin Devuelto:</b></td>
                                                <td style="border: 1px solid transparent" class="text-right">{{ $totalSinDevuelto }} Bs.</td>
                                            </tr>
                                            <tr class="prices_details">
                                                <td colspan="4" style="border: 1px solid transparent"></td>
                                                <td colspan="2" style="border: 1px solid transparent" class="text-right"><b>Total Entregado:</b></td>
                                                <td style="border: 1px solid transparent" class="text-right">{{ $totalEntregado }} Bs.</td>
                                            </tr>
                                            <tr class="prices_details">
                                                <td colspan="4" style="border: 1px solid transparent"></td>
                                                <td colspan="2" style="border: 1px solid transparent" class="text-right"><b>Total Devuelto:</b></td>
                                                <td style="border: 1px solid transparent" class="text-right">- {{ $totalDevuelto }} Bs.</td>
                                            </tr>
                                            <tr class="prices_details">
                                                <td colspan="4" style="border: 1px solid transparent"></td>
                                                <td colspan="2" style="border: 1px solid transparent" class="text-right"><b>Total Neto:</b></td>
                                                <td style="border: 1px solid transparent;border-top: 2px solid;" class="text-right">{{ $totalNeto }} Bs.</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="modal fade" id="entregarModal" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <form id="form-pedido-deails" method="post" action="{{ url('pedidos/')}}/">
                                                        {{ csrf_field() }}
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">
                                                                Modal title
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div id="entregarModalId"></div>
                                                            <ul class="list-group">
                                                                <li class="list-group-item">
                                                                    <div class="row">
                                                                        <div class="col-sm-4">
                                                                            <img alt="140x140"
                                                                                 id="proImage"
                                                                                 data-src="holder.js/140x140"
                                                                                 class="img-rounded" style=""
                                                                                 src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzE0MHgxNDAKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNjI0YzYwYTE0ZiB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE2MjRjNjBhMTRmIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQ0LjA1NDY4NzUiIHk9Ijc0LjUiPjE0MHgxNDA8L3RleHQ+PC9nPjwvZz48L3N2Zz4="
                                                                                 data-holder-rendered="true"
                                                                                 width="140"
                                                                                 height="140"
                                                                            >
                                                                        </div>
                                                                        <div class="col-sm-8">
                                                                            <h4 class="card-title"><span id="proNombre"></span></h4>
                                                                            <br><strong>Precio: </strong><span id="proPrecio"></span> Bs.
                                                                            <br><strong>Tipo: </strong><span id="proTipo"></span>
                                                                            <br><strong>Descripcion: </strong><span id="proDescripcion"></span>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="list-group-item"><span class="badge" id="proCantidadEntregado">14</span>Entregados</li>
                                                                <li class="list-group-item">
                                                                    <span class="badge" id="proCantidadPorEntregar">14</span>
                                                                    <span id="proStock"></span>
                                                                    Por Entregar
                                                                </li>
                                                                <li class="list-group-item"><span class="badge" id="proCantidadDevuelto">14</span>Devueltos</li>
                                                                <li id="devolucion_stock" class="list-group-item" style="display: none">
                                                                    <div class="row">
                                                                        <div class="col-sm-4">
                                                                            Reponer en Stock
                                                                        </div>
                                                                        <div class="col-sm-offset-4 col-sm-4">
                                                                            <input type="checkbox" class="text-right pull-right" id="proReponerStock" name="proReponerStock" style="width: 20px;height: 20px">
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="row">
                                                                        <div class="col-sm-4">
                                                                            Cantidad a Procesar
                                                                        </div>
                                                                        <div class="col-sm-offset-4 col-sm-4">
                                                                            <input type="number" min="1" class="form-control text-right" id="proCantidadPrcesar" name="proCantidadPrcesar" required>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-primary btn-sm" id="proButton">Productos</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @if ( Auth::user()->tipo_cuenta == 'Administrador')
                                            @if ( $pedido['ped_estado'] == 'pendiente')
                                                <form class="form-horizontal" role="form" method="POST" action="{{ url('pedidos/entregartodo')}}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="pedido_id" value="{{ $pedido['id'] }}">
                                                    <button class="btn pull-right btn-primary margin-left-md" type="submit">
                                                        Entregar Todo
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                        <a href="/pedidos" class="btn pull-right btn-danger">Atras</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop