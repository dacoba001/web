@extends('layouts.app')

@section('content')

<section class="mt20 mb40">
                    <section id="slider">
            <div class="flexslider">
                
            <div class="flex-viewport" style="overflow: hidden; position: relative;">
                <ul class="slides" style="width: 1400%; transition-duration: 0s; transform: translate3d(-2997px, 0px, 0px);"><li class="clone" aria-hidden="true" style="width: 999px; float: left; display: block;">
                             <a href="http://www.lorenzetti.com.br/es/Linhas.aspx?id=9">
                                <img id="MainContent_slide5img" src="{{URL::asset('assets/img/Lampadas.jpg')}}" style="height:266px;width:999px;" draggable="true">
                             </a>
                         </li>
                         
                         <li class="" style="width: 999px; float: left; display: block;">
                             <a href="http://www.lorenzetti.com.br/es/Categorias.aspx?id=80">
                                <img id="MainContent_slide1img" src="{{URL::asset('assets/img/Chuveiro.jpg')}}" style="height:266px;width:999px;" draggable="true">
                             </a>
                         </li>

                         <li style="width: 999px; float: left; display: block;" class="">
                             <a href="http:///www.lorenzetti.com.br/storage/upload/pdf/catalogo_exp.pdf">
                                <img id="MainContent_slide2img" src="{{URL::asset('assets/img/espanhol.jpg')}}" style="height:266px;width:999px;" draggable="true">
                             </a>
                         </li>

                         <li style="width: 999px; float: left; display: block;" class="">
                             <a href="http://www.lorenzetti.com.br/es/Detalhes_Produto.aspx?id=1216">
                                <img id="MainContent_slide3img" src="{{URL::asset('assets/img/Purificador.jpg')}}" style="height:266px;width:999px;" draggable="true">
                             </a>
                         </li>

                         <li style="width: 999px; float: left; display: block;" class="">
                             <a href="http://www.lorenzetti.com.br/es/Linhas.aspx?id=4">
                                <img id="MainContent_slide4img" src="{{URL::asset('assets/img/Aquecedores.jpg')}}" style="height:266px;width:999px;" draggable="true">
                             </a>
                         </li>
                </ul></div><ol class="flex-control-nav flex-control-paging"><li><a class="">1</a></li><li><a class="">2</a></li><li><a class="flex-active">1</a></li><li><a class="">4</a></li><li><a class="">5</a></li></ol><ul class="flex-direction-nav"><li><a class="flex-prev" href="#">Previous</a></li><li><a class="flex-next" href="#">Next</a></li></ul></div>
        </section>
    </section>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-heading">Bienvenido</div>

                <div class="panel-body">
                    Página principal de la aplicación.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
