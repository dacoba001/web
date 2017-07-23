@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Nuestros Productos</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Descripcion del Producto</th>
                                    <th>Codigo</th>
                                    <th class="text-center" style="width: 1px;">Opcion</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $id => $producto)
                                    <tr>
                                        <td>{{$producto['pro_nombre']}}</td>
                                        <td>{{$producto['tipo']['tip_nombre']}}</td>
                                        <td>{{$producto['pro_descripcion']}}</td>
                                        <td>{{$producto['pro_codigo']}}</td>
                                        <td>
                                            <a href="{{ url('productos/')}}/{{$producto['id']}}" class="btn btn-success">Añadir al carrito</a>
                                        </td>
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
