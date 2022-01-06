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
        <div class="col-lg-5">
            <img src="{{ asset('/images/'.$data->photo) }}" class="productDIMG" alt="">
        </div>
        <div class="col-lg-7">
            <div class="row pt-5">
                <div class="col-lg-12">
                    <hr style=" margin-left: 0px; height:5px; width: 50px;  border-width:0; color:yellowgreen; background-color:yellowgreen">
                    <h1 style="font-family: 'Lobster', cursive;">{{ $data->name }}</h1>
                    <h6 style="color: #FF6D6D;">All you need for your life !</h6>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <h1 class="productDPR">${{ $data->price }}</h1>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <p>{{ $data->description }}</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <a href="#" class="card-link btn btnPRD">Add to cart</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end_product detail -->

@endsection