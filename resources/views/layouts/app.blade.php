<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>@yield('title', 'Developers TI')</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- CSS Files -->
    <link href="{{ asset('clients/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('clients/css/material-kit.css') }}" rel="stylesheet"/>

    @yield('styles')

</head>

<body class="@yield('body-class')">
    <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">Mundo Fashion</a>
            </div>

            <div class="collapse navbar-collapse" id="navigation-example">
                <ul class="nav navbar-nav navbar-right">
                    
                    @guest
                            <li><a href="{{ route('login') }}">Ingresar</a></li>
                            <li><a href="{{ route('register') }}">Registro</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ url('/clientes/'.auth()->user()->id ) }}">Mi perfil</a>
                                </li>
                                    @if (auth()->user()->admin)
                                    
                                        <li>
                                            <a href="{{ url('/admin/categories') }}">Gestionar categorias</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/admin/products') }}">Gestionar productos</a>
                                        </li>
                                        <li>
                                            <a href="{{url('/admin/compra')}}">Gestion Compras</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/admin/venta') }}">Gestionar Ventas</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/admin/envios') }}">Gestionar envios</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/admin/clientes') }}">Gestion Clientes</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/admin/pedido')}}">Pedidos</a>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Cerrar sesión
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest

                    <li>
                        <a href="#" target="_blank" class="btn btn-simple btn-white btn-just-icon">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" target="_blank" class="btn btn-simple btn-white btn-just-icon">
                            <i class="fa fa-facebook-square"></i>
                        </a>
                    </li>
                    <li>
                        @guest
                         
                        @else
                                                      
                        @endguest

                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="wrapper">
        @yield('content')

        
    </div>


    </body>
    <!--   Core JS Files   -->
    <script src="{{ asset('clients/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('clients/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('clients/js/material.min.js') }}"></script>
    
    <script src="{{ asset('clients/js/nouislider.min.js') }}" type="text/javascript"></script>
    
    <script src="{{ asset('clients/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    
    <script src="{{ asset('clients/js/material-kit.js') }}" type="text/javascript"></script>

    @yield('scripts')
    
</html>