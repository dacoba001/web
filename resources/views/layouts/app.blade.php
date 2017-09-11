<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lorenzetti</title>
    <!-- Fonts -->
    <link href="{{URL::asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous"-->
    {{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">--}}
    <link href="{{URL::asset('assets/css/latostyle2.css')}}" rel="stylesheet">

    <!-- Styles -->
    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"-->
    <link href="{{URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{URL::asset('assets/css/spaces.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/css/styles.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/css/styles2.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/css/latofonts.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/css/latostyle.css')}}" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
        .titpeque{
            font-size: 70%;
        }
        .titnopeque{
            font-size: 150%;
        }
        .titulo{
            padding-top: 0px;
        }
        .navbar-default .navbar-brand, .navbar-default .navbar-nav>li>a{
            color: white;
        }
        .navbar-default .navbar-brand:hover{
            color: white;
        }
        .navbar-default .navbar-nav>li>a:hover{
            color: white;
            background: rgba(255, 255, 255, 0.3);
        }
        .form-horizontal .form-group {
            margin-left: 0px;
            margin-right: 0px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top navbar-light" style="background-color: #c9252c;">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>

                <!-- Branding Image -->
                <a class="navbar-brand titulo" href="{{ url('/') }}">
                    <small class="titpeque">Importadora</small>
                    <br><big class="titnopeque">PARRA</big>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">ProductosWeb</a></li>
                     @if ( !Auth::guest())
                        @if ( Auth::user()->tipo_cuenta == 'Administrador')
                            <li><a href="{{ url('/usuarios') }}">Usuarios</a></li>
                            <li><a href="{{ url('/clientes') }}">Clientes</a></li>
                            <li><a href="{{ url('/tipos') }}">Tipos</a></li>
                            <li><a href="{{ url('/productos') }}">Productos</a></li>
                            @if ( Session::get('variable') > 0)
                                <li>
                                    <a href="{{ url('/stocks/min') }}">Stock
                                        @if ( Session::get('variable') > 0)
                                            <span class="pull-right">
                                            &nbsp;&nbsp;&nbsp;<span class="label label-alert">{{ Session::get('variable') }}</span>&nbsp;&nbsp;
                                            </span>
                                        @endif
                                    </a>
                                </li>
                            @else
                                <li><a href="{{ url('/stocks') }}">Stock</a>
                            </li>
                            @endif
                            <li><a href="{{ url('/pedidos') }}">Pedidos</a></li>
                            <li><a href="{{ url('/importacions/create') }}">Importaciones</a></li>
                            <li><a href="{{ url('/reportes/importacions') }}">Reportes</a></li>
                        @endif
                        @if ( Auth::user()->tipo_cuenta == 'Secretaria')
                            <li><a href="{{ url('/clientes') }}">Clientes</a></li>
                            <li><a href="{{ url('/pedidos') }}">Pedidos</a></li>
                        @endif
                        @if ( Auth::user()->tipo_cuenta == 'Cliente')
                            <li><a href="{{ url('/pedidos') }}">Pedidos</a></li>
                        @endif

                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->nombre }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
    <!-- JavaScripts -->
    <script src="{{URL::asset('assets/js/jquery.js')}}"></script>
    <script src="{{URL::asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/jquery.flexslider.js')}}"></script>
    <script src="{{URL::asset('assets/js/jquery.custom.js')}}"></script>
    <!--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    -->
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
