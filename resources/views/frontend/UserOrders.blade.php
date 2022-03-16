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
            <!-- <div class="carousel-caption">
                <h1 class="display-2">Welcome</h1>
                <h3>Lets take a tour !</h3>
                <button type="button" class="btn btn-outline-light btn-lg">Lets Go</button>
            </div> -->
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
                <div class="col-md-12">
                    <div class="d-flex">
                        <img src="{{ asset('images/banner/logo.png') }}" style="width: 70px;" alt="">
                        <h3 class="ml-2 pt-3"><b>Your Orders</b></h3>
                    </div>
                    <p class="mb-4">Welcome to Bao Phat Smart Devices !</p>
                    <table class="col-md-12 table table-bordered">
                        <tr>
                            <td colspan="6" style="background-color: #6C4A4A; color: white; border-radius: 5px 5px 0px 0px;">Orders</td>
                        </tr>
                        <tr>
                            <th>Number</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Order At</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </tr>
                        @foreach($orders->orders as $num => $order)
                            @php
                                $orderDetail = json_decode($order->orderDetail);
                            @endphp
                            <tr>
                                <td>{{ $num+=1 }}</td>
                                <td>{{ $orderDetail->totalQuantity }}</td>
                                <td>$ {{ $orderDetail->totalPrice }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    @if($order->status === 0)
                                    <button type="button" class="btn btn-secondary">Processing</button>
                                    @elseif($order->status === 1)
                                    <button type="button" class="btn btn-warning">Transfering</button>
                                    @elseif($order->status === 2)
                                    <button type="button" class="btn btn-success">Finish</button>
                                    @else
                                    <button type="button" class="btn btn-danger">Cancel</button>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="{{ '#collapseExample'.$num }}" aria-expanded="false" aria-controls="collapseExample">See detail</button>
                                </td>
                            </tr>

                            @foreach($orderDetail->products as $product)
                            <tr class="collapse" id="{{ 'collapseExample'.$num }}">
                                <td colspan="6">
                                    <div>
                                        <div class="card card-body">
                                            <div style="display: flex;">
                                                <img src="{{ asset('images/'.$product->productInfo->photo) }}" style="width: 100px; height:70px; object-fit: cover;" alt="">
                                                <div class="product"><b>Name: </b>{{ $product->productInfo->name .' '. $product->productInfo->title }}</div>
                                                <div class="product"><b>Price: </b>${{ $product->productInfo->price }}</div>
                                                <div class="product"><b>Quantity: {{ $product->quantity }}</b></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .pagination {
        padding: 0px;
        margin: 0px;
    }

    .product {
        margin-left: 50px;
        margin-top: 25px;
    }
</style>
@endsection