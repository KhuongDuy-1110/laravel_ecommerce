@extends('layouts.client')
@section('clientContent')

<!-- banner -->
<div class="img-fluid">
    <img src="{{ asset('images/frontend/murat-demircan-beDmytOHU5k-unsplash.jpg') }}" style="width: 100%; height: 400px; object-fit: cover;" alt="">
</div>
<!-- end_banner -->

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
                                <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus btn">-</button>
                                <input class="quantity w-25 text-center" name="quantity" value="{{ $rows['quantity'] }}" type="number">
                                <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus btn">+</button>
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
            <a href="#" class="col-lg-5 btn process-btn">{{ __('Update') }}</a>
            <a href="{{ url('/cart/checkout') }}" class="col-lg-5 btn process-btn ml-auto">{{ __('Checkout') }}</a>
        </div>
    </div>
    @endif
</div>

<!-- end_shopping cart -->

@endsection