<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Icons -->
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }} - Making Minecraft Capes Easier for Developers and Players</title>
    
    <!-- Meta Tags -->
    <meta name="description" content="Capes API is a product by Halfpetal built to allow Minecraft client, Forge, and mod developers to give custom capes to users and allows users to manage the capes they own.">
    <meta name="keywords" content="minecraft, mojang, forge, mod, forgemods, modification, hacked client, client developer, minecraft capes, cape api, halfpetal, wizardhax, api, capes">
    <meta name="robots" content="index, nofollow">
    <meta name="revisit-after" content="30 days">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/themes/yeti/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <script src="https://use.fontawesome.com/a551ad771b.js"></script>
</head>
<body>
    <!-- 
        May I ask why you're looking at this source code?
        Honestly, it's nothing special. It's just HTML. You won't see anything important here.
    -->
    <div id="app">
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
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="{{ route('donate') }}"><i class="fa fa-heart-o" aria-hidden="true"></i> Donate <i class="fa fa-heart-o" aria-hidden="true"></i></a>
                        </li>
                        @if(Session::get('mojangUUID'))
                        <li class="dropdown">
                            <a href="#" class="dropdlgwn-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Session::get('mojangUsername') }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('mojang::getUserCP') }}">User Dashboard</a>
                                </li>
                                <li>
                                    <a href="{{ route('mojang::getLogout') }}">User Logout</a>
                                </li>
                            </ul>
                        </li>
                        
                        @else
                        <li>
                            <a href="{{ route('mojang::getLogin') }}">User Login</a>
                        </li>
                        @endif
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li class="dropdown">
                                <a href="#" class="dropdlgwn-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Developers <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/login') }}">Login</a></li>
                                    <li><a href="{{ url('/register') }}">Register</a></li>
                                </ul>
                            </li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdlgwn-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    @role('admin')
                                    <li><a href="{{ route('admin::dashboard') }}">Administration</a></li>
                                    @endrole
                                    <li><a href="{{ route('developer::dashboard') }}">Dashboard</a></li>
                                    <li><a href="{{ route('api-docs') }}" target="_blank">Documentation</a></li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @if(!Request::is('/'))
        <div class="container">
            <ol class="breadcrumb">
            <li></li>
            @yield('breadcrumb')
            </ol>
        </div>   
        @endif

        @yield('content')

        <div class="container">
            <div class="text-muted">
                <div class="copyright">
                    &copy; Copyright <a href="https://halfpetal.com" target="_blank">Halfpetal</a> {{ date('Y') }}. All rights reserved. 
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script async src="https://cdnjs.cloudflare.com/ajax/libs/fuckadblock/3.2.1/fuckadblock.min.js"></script>
    <script>
        function onAdBlock() {
            alert('AdBlock detected. Consider disabling it on CapesAPI to help pay for our servers.');
            //window.location = 'https://youtu.be/ifBpjs36kFs?t=2m9s';
        }
        
        $(document).ready(function() {
            if(typeof fuckAdBlock === 'undefined') {
                onAdBlock();
            } else {
                fuckAdBlock.onDetected(onAdBlock);
                fuckAdBlock.on(true, onAdBlock);
            }
        });
    </script>
</body>
</html>
