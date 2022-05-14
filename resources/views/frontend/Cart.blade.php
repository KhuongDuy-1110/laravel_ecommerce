@extends('layouts.client')
@section('clientContent')

<!-- Image slider -->
<div id="slides" class="carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
        <li data-target="#slides" data-slide-to="0" class="active"></li>
        @if(!empty($slides))
            @for( $i=1; $i<=count($slides); $i++)
            <li data-target="#slides" data-slide-to="{{ $i }}"></li>
            @endfor
        @endif
    </ul>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100 " src="{{ asset('images/banner/surface-cLTHKmQS0zI-unsplash.jpg') }}" style="width: 100%; height: 400px; object-fit: cover;" alt="">
            <!-- <div class="carousel-caption">
                <h1 class="display-2">Welcome</h1>
                <h3>Lets take a tour !</h3>
                <button type="button" class="btn btn-outline-light btn-lg">Lets Go</button>
            </div> -->
        </div>
        @if(!empty($slides))
            @foreach($slides as $image)
            <div class="carousel-item ">
                <img class="d-block w-100" src="{{ asset('images/'.$image->path) }}" style="width: 100%; height: 400px; object-fit: cover;" alt="">
            </div>
            @endforeach
        @endif
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

<!-- shopping cart -->

<!-- <img src="img/mochamad-taufiq-4VBl4F17bf8-unsplash.jpg" width="145px" height="98px" style="object-fit: cover;" alt=""> -->

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center mb-3">
            <h2 style="font-family: 'Lobster', cursive;">{{ __('Shopping List') }}</h2>
            <hr>
        </div>
        <div class="col-md-12">
            <table class="table table-bordered text-center">
                @if( Session::has('cart') )
                <thead>
                    <tr>
                        <th>{{ __('Image') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Quantity') }}</th>
                        <td></td>
                    </tr>
                    @foreach(Session::get('cart')->products as $rows )
                    <tr>
                        <td><img src="{{ asset('images/'.$rows['productInfo']->photo) }}" width="145px" height="98px" style="object-fit: cover;" alt=""></td>
                        <td style="vertical-align: middle;">{{ $rows['productInfo']->name }}</td>
                        <td style="vertical-align: middle;">{{ number_format($rows['productInfo']->price) }}</td>
                        <td style="vertical-align: middle;">
                            <div class="number-input md-number-input">
                                <a href="{{ url('/cart/updateCart/'.$rows['productInfo']->id.'/0') }}" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus btn">-</a>
                                <input class="quantity w-25 text-center" id="quanty-item-{{ $rows['productInfo']->id }}" name="quantity" value="{{ $rows['quantity'] }}" type="number">
                                <a href="{{ url('/cart/updateCart/'.$rows['productInfo']->id.'/1') }}" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus btn">+</a>
                            </div>
                        </td>
                        <td style="vertical-align: middle;"><a href="{{ url('/cart/deleteCart/'.$rows['productInfo']->id ) }}" class="btn btn-light"><i class="fas fa-times"></i></a></td>
                    </tr>
                    @endforeach
                </thead>
                @endif
            </table>
        </div>
    </div>
</div>
<div class="container col-lg-4 offset-lg-4 ml-auto mb-5">
    @if( Session::has('cart') )
    <div class="checkout">
        <ul>
            <li class="subtotal">{{ __('Subtotal') }} <span>$ {{ number_format(Session::get('cart')->totalPrice) }}</span> </li>
            <li class="cart-total">{{ __('Total') }} <span>$ {{ number_format(Session::get('cart')->totalPrice) }}</span> </li>
        </ul>
        <div class="row m-auto">
            <a href="{{ route('homePage') }}" class="col-lg-5 btn process-btn">{{ __('Continue shopping') }}</a>
            <a href="{{ url('/cart/checkout') }}" class="col-lg-5 btn process-btn ml-auto">{{ __('Checkout') }}</a>
        </div>
    </div>
    @endif
</div>

<!-- end_shopping cart -->

@endsection