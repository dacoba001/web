<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Importadora Parra</title>
    <!-- CSS -->
    <link href="{{URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/css/simple-sidebar.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/css/spaces.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/css/styles.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/css/styles2.css')}}" rel="stylesheet">
</head>
<body>
    <div id="wrapper" class="toggled">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="{{ url('/') }}">
                        Importadora Parra
                    </a>
                </li>
                <li>
                    <a href="/usuarios">Administrar Usuarios</a>
                </li>
                <li>
                    <a href="{{route('clientes')}}">Administrar Clientes</a>
                </li>
                <li>
                    <a href="#">Administrar Productos</a>
                </li>
                <li>
                    <a href="#">Administrar Stock</a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-pencil"></i>Administrar Alertas
                        <span class="pull-right">
                        &nbsp;<span class="label label-alert">5</span>&nbsp;&nbsp;
                        </span>
                        
                    </a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div style="color:#c9252c;float:right;font-size:40pt;font-family: sans-serif;margin-right:20px">PARRA</div>

@yield('content')

    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="{{URL::asset('assets/js/jquery.js')}}"></script>
    <script src="{{URL::asset('assets/js/bootstrap.min.js')}}"></script>
    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
</body>
</html>