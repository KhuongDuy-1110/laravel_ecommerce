@extends('layouts.client')
@section('clientContent')

<!-- banner -->
<div class="img-fluid" >
    <img src="{{ asset('/images/banner/murat-demircan-beDmytOHU5k-unsplash.jpg') }}" style="width: 100%; height: 400px; object-fit: cover;" alt="">
</div>
<!-- end_banner -->

<!-- product detail -->

<div class="container">
    <div class="row productD">
        <div class="col-lg-6">
            <img src="{{ asset('/images/'.$data->photo) }}" class="productDIMG" style="border-radius: 10px;" alt="">
        </div>
        <div class="col-lg-6">
            <div class="row pt-5">
                <div class="col-lg-12">
                    <hr style=" margin-left: 0px; height:5px; width: 50px;  border-width:0; color:yellowgreen; background-color:yellowgreen">
                    <h1><b>{{ $data->name }}</b></h1>
                    <h6 style="color: #FF6D6D;">All you need for your life !</h6>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <h3 class="productDPR"><b>{{ __('Price') }}: </b>${{ $data->price }}</h3>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <p><b>{{ __('Notes') }}: </b>{{ $data->title }}</p>
                    <p><b>{{ __('Category') }}: </b>{{ $data->category->name }}</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <a href="{{ url('/cart/addcart/'.$data->id) }}" class="card-link btn btnPRD">{{ __('Add to cart') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 align-center">
        <hr>
        <section class="mb-5">
            {!! $data->description !!}
        </section>
    </div>
</div>

<!-- end_product detail -->

@endsection