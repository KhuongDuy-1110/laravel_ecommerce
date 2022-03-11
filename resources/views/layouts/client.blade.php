<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script defer src="https://pro.fontawesome.com/releases/v5.10.0/js/all.js" integrity="sha384-G/ZR3ntz68JZrH4pfPJyRbjW+c0+ojii5f+GYiYwldYU69A+Ejat6yIfLSxljXxD" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>{{ isset($title)?$title:'Ecommerce' }}</title>
</head>

<body>
    <!-- navigation -->
    <nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('images/banner/logo.png') }}" style="width: 70px; " alt="#">Laravel
                ecommerce</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                <span class="nvabar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-5">
                    <li class="nav-item {{ (isset($title)&&$title === 'Home')?'active':'' }}">
                        <a href="{{ url('/') }}" class="nav-link">{{ __('Home') }}</a>
                    </li>
                    <!-- <li class="nav-item {{ (isset($title)&&$title === 'Product')?'active':'' }} ">
                        <a href="{{ url('/products') }}" class="nav-link">{{ __('Products') }}</a>
                    </li> -->

                    <li class="nav-item dropdown {{ (isset($title)&&$title === 'Product')?'active':'' }}">
                        <a href="#" class="nav-link dropdown-toggle" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('Products') }}</a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach($Category as $rows)
                                <a class="dropdown-item" href="{{ url('/products/'.$rows->id) }}">{{ $rows->name }}</a>
                            @endforeach
                        </div>   
                    </li>

                    <li class="nav-item {{ (isset($title)&&$title === 'Cart')?'active':'' }} ">
                        <a href="{{ url('/cart') }}" class="nav-link">{{ __('Cart')}}</a>
                    </li>
                </ul>
                @if(Auth::check())
                    <ul class="navbar-nav ml-auto">
                        @if(Config::get('app.locale') == 'en')
                            <li class="nav-item">
                                <img src="{{ asset('images/flag_lang/vietnam.png') }}" alt="" style="margin-top: 9px;">
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/change-language/vi') }}" class="nav-link">vi</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <img src="{{ asset('images/flag_lang/american.png') }}" alt="" style="margin-top: 9px;">
                            </li>
                            <li class="nav-item"><a href="{{ url('/change-language/en') }}" class="nav-link">
                                en
                            </a></li>
                        @endif
                        <li class="nav-item"><a href="#" class="nav-link"> </a></li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">{{ __('Welcome') }}</a>
                        </li>
                        <li class="nav-item"><a href="#" class="nav-link">|</a></li>
                        <li class="nav-item">
                            <a href="{{ url('/logout') }}" class="nav-link">{{ __('Log out') }}</a>
                        </li>
                    </ul>
                @else
                    <ul class="navbar-nav ml-auto">
                        @if(Config::get('app.locale') == 'en')
                            <li class="nav-item">
                                <img src="{{ asset('images/flag_lang/vietnam.png') }}" alt="" style="margin-top: 9px;">
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/change-language/vi') }}" class="nav-link">vi</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <img src="{{ asset('images/flag_lang/american.png') }}" alt="" style="margin-top: 9px;">
                            </li>
                            <li class="nav-item"><a href="{{ url('/change-language/en') }}" class="nav-link">
                                en
                            </a></li>
                        @endif
                        <li class="nav-item"><a href="#" class="nav-link"> </a></li>
                        <li class="nav-item">
                            <a href="{{ url('/register') }}" class="nav-link">{{ __('Sign up') }} </a>
                        </li>
                        <li class="nav-item"><a href="#" class="nav-link">|</a></li>
                        <li class="nav-item">
                            <a href="{{ url('/login') }}" class="nav-link">{{ __('Sign in') }}</a>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </nav>
    <!-- end_navigation -->

    @yield('clientContent')

    <!-- footer -->

    <div class="container-fluid padding">
        <div class="row text-center pt-5" style="background-color: #6C4A4A; color: white;">
            <div class="col-md-4">
                <img src="{{ asset('images/banner/logo.png') }}" style="width: 70px;" alt="">
                <!-- <hr class="light"> -->
                <p>12-3456-789</p>
                <p>khuong.pham@tda.company</p>
                <p>Bac Tu Liem, Ha Noi, Viet Nam</p>
            </div>
            <div class="col-md-4">
                <!-- <hr class="light"> -->
                <h5>{{ __('Our hours') }}</h5>
                <hr class="light">
                <p>Monday: 8.30AM - 5.30PM</p>
                <p>Wednesday: 8.30AM - 5.30PM</p>
                <p>Friday: 8.30AM - 5.30PM</p>
            </div>
            <div class="col-md-4">
                <!-- <hr class="light"> -->
                <h5>{{ __('Contact Support') }}</h5>
                <hr class="light">
                <p>Monday: 8.30AM - 5.30PM</p>
                <p>Wednesday: 8.30AM - 5.30PM</p>
                <p>Friday: 8.30AM - 5.30PM</p>
            </div>
            <div class="col-12 pt-5">
                <hr class="light">
                <h5>khuongduy.com</h5>
            </div>
        </div>
    </div>

    <!-- end_footer -->


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>