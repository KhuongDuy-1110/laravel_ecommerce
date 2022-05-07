@extends('layouts/client')
@section('clientContent')

<!-- Image slider -->
<div id="slides" class="carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
        <li data-target="#slides" data-slide-to="0" class="active"></li>
        <li data-target="#slides" data-slide-to="1"></li>
        <li data-target="#slides" data-slide-to="2"></li>
    </ul>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100 " src="{{ asset('images/banner/surface-cLTHKmQS0zI-unsplash.jpg') }}" style="height:400px; object-fit: cover;" alt="">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('images/banner/microsoft-edge-FAaz8lkinzs-unsplash.jpg') }}" style="height:400px; object-fit: cover;" alt="">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('images/banner/windows-wYTd-B7BdoQ-unsplash.jpg') }}" style="height:400px; object-fit: cover;" alt="">
        </div>
    </div>
    <a class="carousel-control-prev" href="#slides" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#slides" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- end_image_slider -->

<div class="ml-auto mt-5 mb-5">
    <div class="bg order-1 order-md-2" style="background-image:url(images/xbg_1.jpg.pagespeed.ic.R5QWIA8_nZ.webp)"></div>
    <div class="contents order-2 order-md-1">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7">
                    <div class="d-flex">
                        <img src="{{ asset('images/banner/logo.png') }}" style="width: 70px;" alt="">
                        <h3 class="ml-2 pt-3"><b>{{ __('Forgot password') }}</b></h3>
                    </div>
                    <p class="mb-4 text-danger">* {{ __('Enter your email, phone number in the form below') }}</p>
                    @include('layouts/flash-message')
                    <form action="#" method="post">
                        @csrf
                        <div class="form-group first">
                            <label for="username">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="your-email@gmail.com" id="username">
                        </div>
                        <div class="form-group first">
                            <label for="phone">{{ __('Phone number') }}</label>
                            <input type="number" name="phone" class="form-control" placeholder="0935717***" id="phone">
                        </div>
                        <div class="col-md-12 p-0 mt-4">
                            <input type="submit" value="{{ __('Confirm') }}" class="btn btn-block btn-primary border-0 p-3" style="background-color: #6C4A4A;">
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection