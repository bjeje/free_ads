<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/index.css')}}">
    @if(Route::is('login') )
        <link rel="stylesheet" href="{{ asset('css/login.css')}}">
    @elseif(Route::is('register') || Route::is('edit-profil') || Route::is('/user/{id}'))
        <link rel="stylesheet" href="{{ asset('css/register.css')}}">
    @else
        <link rel="stylesheet" href="{{ asset('css/articleLittle.css')}}">
        <link rel="stylesheet" href="{{ asset('css/articleManage.css')}}">
        <link rel="stylesheet" href="{{ asset('css/showUser.css')}}">
        <link rel="stylesheet" href="{{ asset('css/register.css')}}">
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
          crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</head>
<body>
    <div class="full-height">

        <nav class="navbar navbar-expand-md container__menu">
            <a href="#" class="navbar-brand brand__name">Free Ads</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fas fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    @guest
                        @if (Route::has('login') || Route::has('register'))
                        <li class="nav-item active links">
                            <a class="nav-link" href="{{ url('/login') }}">Se connecter <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item links">
                            <a class="nav-link" href="{{ url('/register') }}">S'enregistrer</a>
                        </li>
                        @endif
                    @else
                        <li class="nav-item links">
                            <a class="nav-link" href="{{ url('/home') }}">Acceuil</a>
                        </li>
                        <li class="nav-item dropdown links">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Profil
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ url('/user/'. Auth::user()->id) }}">Mon profil</a>
                                <a class="dropdown-item" href="{{ url('/user/edit-profil') }}">Modifier</a>
                                <a class="dropdown-item" href="{{ url('/user/delete-profil') }}">Supprimer</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Déconnection') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
        <div class="border"></div>

        <div class="content">
            @yield('content')
        </div>

        <div class="border--bottom"></div>
        <footer>
            <div class="row">
                <div class="who ">
                    <h4>A propos</h4>
                    <ul class="footer__nav">
                        <li><a href="">Qui sommes Nous?</a></li>
                        <li><a href="">Nous contacter</a></li>
                        <li><a href="">aide</a></li>
                    </ul>
                </div>
                <div class="media">
                    <a href=""><i class="fab fa-facebook social"></i></a>
                    <a href=""><i class="fab fa-twitter social"></i></a>
                    <a href=""><i class="fab fa-instagram social"></i></a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
