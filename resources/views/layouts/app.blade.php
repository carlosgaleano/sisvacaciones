<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistema de Vacaciones</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    {!! Html::style('css/app.css') !!}
    @yield('style')
</head>

<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
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
                <a class="navbar-brand" href="{{ url('/') }}">
                    Sistema  FexVac
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <!--  {{Auth::user()}} -->

                @if (!Auth::guest() && Auth::user()->rol == 'admin')
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Empleados <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                       
                            <li><a href="{{ url('/worker/create') }}">Registrar Empleado</a></li>
                            <li><a href="{{ url('/home') }}">Listar Empleados Activos</a></li>
                            <li><a href="{{ url('/worker/retirados') }}">Listar Empleados Retirados</a></li>
                            <li><a href="{{ url('/vacation/vacationsPending/') }}">Aprobar Vacaciones</a></li>

                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Areas <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/area/create') }}">Crear Area</a></li>
                            <li><a href="{{ url('/area') }}">Listar Areas</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuarios del Sistema <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        <li><a href="{{ url('/register') }}"><i class="fas fa-user-tie"></i>Registrar Usuario</a></li>
                            <li><a href="{{ url('/listaUsuarios') }}"><i class="fa fa-btn fas fa-users">  </i>  Listar Usuarios</a></li>
                        </ul>
                    </li>
                </ul>
                @endif
                @if (!Auth::guest() && Auth::user()->rol == 'normal')
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Solicitud de Vacaciones <span class="caret"></span></a>
                        <ul class="dropdown-menu">

                            <li><a href="{{ url('/home') }}">Gestione sus Vacaciones</a></li>

                        </ul>
                    </li>
                  

                </ul>

                @endif
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (!Auth::guest())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
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
    {!! Html::script('js/jquery.min.js') !!}
    {!! Html::script('js/bootstrap.min.js') !!}

    @yield('javascript')
</body>

</html>