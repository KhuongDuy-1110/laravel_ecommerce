@extends('layouts.client')
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
                <img class="d-block w-100 " src="{{ asset('images/banner/surface-cLTHKmQS0zI-unsplash.jpg') }}" style="height:700px; object-fit: cover;" alt="">
                <div class="carousel-caption">
                    <h1 class="display-2">Welcome</h1>
                    <h3>Lets take a tour !</h3>
                    <button type="button" class="btn btn-outline-light btn-lg">Lets Go</button>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('images/banner/microsoft-edge-FAaz8lkinzs-unsplash.jpg') }}" style="height:700px; object-fit: cover;" alt="">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('images/banner/windows-wYTd-B7BdoQ-unsplash.jpg') }}" style="height:700px; object-fit: cover;" alt="">
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

    <!-- hot products -->
    <div class="container-fluid padding mt-5">
        <div class="row welcome text-center">
            <div class="col-12">
                <h1 class="display-4" style="font-family: 'Lobster', cursive;">{{ __('Hot Products') }}</h1>
            </div>
            <hr style="height:0.5px;width:15%;color:gray;background-color:gray">
        </div>
    </div>

    <div class="container mb-5 mt-5">
        <div class="row">
            @foreach($HotProducts as $rows)
            <!-- product1 -->
            <div class="col-md-4">
                <div class="card mt-3">
                    <div class="product-1 align-item-center p-2 text-center">
                        <img src="{{ asset('images/'.$rows->photo) }}"
                            style="width: 330px; height: 206px; object-fit: contain; " alt="" class="rounded">
                        <a href="{{ url('/products/detail/'.$rows->id) }}" class="badge card-link text-dark" ><h5>{{ $rows->name }}</h5></a>
                        <div class="mt-3 info">
                            <span class="text1 d-block">{{ $rows->title }}</span>
                            <span class="text1">oiretoivmme</span>
                        </div>
                        <div class="cost mt-3 text-dark">
                            <span>$ {{ $rows->price }}</span>
                            <div class="star mt-3 align-items-center">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 shoe text-center  mt-3">
                        <a href="{{ url('cart/addcart/'.$rows->id) }}" class="text-uppercase card-link text-dark">{{ __('ADD TO CART') }}</a>
                    </div>
                </div>
            </div>
            <!-- end_product1 -->
            @endforeach
            



        </div>
    </div>

    <!-- end_hot products -->


@endsection