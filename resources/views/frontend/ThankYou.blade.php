@extends('layouts.client')
@section('clientContent')


<!-- banner -->
<div class="img-fluid">
    <img src="{{ asset('images/banner/murat-demircan-beDmytOHU5k-unsplash.jpg') }}" style="width: 100%; height: 400px; object-fit: cover;" alt="">
</div>
<!-- end_banner -->

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center mb-3">
                <h2 style="font-family: 'Lobster', cursive; color: #6C4A4A;">{{ __('Thank You - Your orders is being processed') }}</h2>
                <hr>
            </div>
            <div class="col-md-12 text-center">
                <img src="{{ asset('/images/tick.png') }}" width="150px" alt="">
            </div>
        </div>
    </div>
    <div class="container col-lg-4 offset-lg-4 ml-auto mb-5 mt-5">
        <div class="checkout text-center">
            <a href="{{ url('/') }}" class="nva-link" style="color: #6C4A4A;">{{ __('Back To Home') }}</a>
        </div>
    </div>


@endsection