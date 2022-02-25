@extends('layouts.client')
@section('clientContent')


<!-- banner -->
<div class="img-fluid">
    <img src="{{ asset('images/banner/murat-demircan-beDmytOHU5k-unsplash.jpg') }}" style="width: 100%; height: 400px; object-fit: cover;" alt="">
</div>
<!-- end_banner -->

<!-- shopping cart -->

<!-- <img src="img/mochamad-taufiq-4VBl4F17bf8-unsplash.jpg" width="145px" height="98px" style="object-fit: cover;" alt=""> -->
<form method="POST" action="{{ url('/cart/order') }}">
    @csrf
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 text-center mb-3">
                <h2 style="font-family: 'Lobster', cursive;">Confirm Your Infomation</h2>
                <hr>
            </div>
            <div class="col-md-6 m-auto">

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="staticName" name="name" value="{{ $data->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" name="email" value="{{ $data->email }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputAddress" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputAddress" name="phone" placeholder="Phone number">
                    </div>
                </div>
                @if($errors->has('phone'))
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10 text-danger">{{ $errors->first('phone') }}
                    </div>
                </div>
                @endif
                <div class="form-group row">
                    <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Address">
                    </div>
                </div>
                @if($errors->has('address'))
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10 text-danger">{{ $errors->first('address') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="container col-lg-4 offset-lg-4 ml-auto mb-5">
        <div class="checkout">
            <ul>
                @if( Session::has('cart') )
                    <li class="subtotal">Subtotal <span>${{ number_format(Session::get('cart')->totalPrice) }}</span> </li>
                    <li class="cart-total">Total <span>${{ number_format(Session::get('cart')->totalPrice) }}</span> </li>
                @endif
            </ul>
            <input type="submit" class="btn process-btn col-lg-12" value="Confirm">
        </div>
    </div>
</form>

<!-- end_shopping cart -->

@endsection