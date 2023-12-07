
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
            <img class="d-block w-100 " src="{{ asset('images/banner/product-banner.jpg') }}" style="width: 100%; height: 400px; object-fit: cover;" alt="">
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

    <!-- all products -->
    <div class="container-fluid product-lob">
        <div class="row py-5">
            <div class="col-lg-5 m-auto text-center">
                <h1 style="font-family: 'Lobster', cursive;">{{ __('All Products') }}</h1>
                <h6 style="color: #FF6D6D;">All you need for your life !</h6>
            </div>
        </div>
        <!-- <div class="row mb-5">
            @foreach($data as $rows)
                <div class="col-md-4 text-center mb-5">
                    <div class="card border-0 bg-light mb-2">
                        <div class="card-body">
                            <img src="{{ asset('/images/'.$rows->photo) }}" class="img-fluid"  style="width: 330px; height: 206px; object-fit: contain;" alt="">
                        </div>
                    </div>
                    <a href="{{ url('/products/detail/'.$rows->id) }}" class="badge card-link text-dark" ><h5 class="pt-2">{{ $rows->name }}</h5></a>
                    <p class="price">$ {{ $rows->price }}</p>    
                    <a href="{{ url('/cart/addcart/'.$rows->id) }}" class="card-link btn btnCart"><i class="fas fa-cart-plus"></i></a> 
                </div>
            @endforeach
        </div>         -->
    </div>
    <div class="container">
        <div class="row mb-5">
            @foreach($data as $rows)
                <div class="col-md-4 text-center mb-5">
                    <div class="card border-0 bg-light mb-2">
                        <div class="card-body">
                            <img src="{{ asset('/images/'.$rows->photo) }}" class="img-fluid"  style="width: 330px; height: 206px; object-fit: contain;" alt="">
                        </div>
                    </div>
                    <a href="{{ url('/products/detail/'.$rows->id) }}" class="badge card-link text-dark" ><h5 class="pt-2">{{ stringLimitedHelper($rows->name, 26) }}</h5></a>
                    <p class="price">$ {{ $rows->price }}</p>    
                    <a href="{{ url('/cart/addcart/'.$rows->id) }}" class="card-link btn btnCart"><i class="fas fa-cart-plus"></i></a> 
                </div>
            @endforeach
        </div> 
    </div>
    @if(!empty($paginate))
    <div class="container ">
        <div class="row d-flex" style="margin-left: 420px;">
            <ul>
                {{ $data->links() }}
            </ul>
        </div>
    </div>
    @endif
    <!-- end_all products -->
@endsection
