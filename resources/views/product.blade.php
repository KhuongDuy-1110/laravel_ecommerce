
  
@extends('layouts.client')
@section('clientContent')
    <!-- banner -->
    <div class="img-fluid" >
        <img src="{{ asset('/images/frontend/murat-demircan-beDmytOHU5k-unsplash.jpg') }}" style="width: 100%; height: 400px; object-fit: cover;" alt="">
    </div>
    <!-- end_banner -->

    <!-- all products -->
    <div class="container-fluid product-lob">
        <div class="row py-5">
            <div class="col-lg-5 m-auto text-center">
                <h1 style="font-family: 'Lobster', cursive;">{{ __('All Products') }}</h1>
                <h6 style="color: #FF6D6D;">All you need for your life !</h6>
            </div>
        </div>
        <div class="row mb-5">
            
            @foreach($data as $rows)
                <div class="col-lg-3 text-center mb-5">
                    <div class="card border-0 bg-light mb-2">
                        <div class="card-body">
                            <img src="{{ asset('/images/'.$rows->photo) }}" class="img-fluid"  style="width: 330px; height: 206px; object-fit: contain;" alt="">
                        </div>
                    </div>
                    <h5 class="pt-2">{{ $rows->name }}</h5>
                    <p class="price">$ {{ $rows->price }}</p>    
                    <a href="{{ url('/cart/addcart/'.$rows->id) }}" class="card-link btn btnCart"><i class="fas fa-cart-plus"></i></a> 
                </div>
            @endforeach
        </div>
        

    </div>
    <!-- end_all products -->
@endsection