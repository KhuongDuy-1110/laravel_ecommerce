@extends('layouts.client')
@section('clientContent')

<div class="container">
    <div class="col-md-12 d-flex flex-row">
        <div class="col-md-3 align-middle p-0">
            <button class="btn btn-success pr-2 btn-block" style="margin-top: 45px; background-color: #6C4A4A; border:0;" type="button" id="btnDropdownDemo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ __('Category') }} &nbsp;
                <i class="fas fa-bars ml-2"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="btnDropdownDemo">
                @foreach($Category as $rows)
                    <a class="dropdown-item" href="{{ url('/products/'.$rows->id) }}">{{ $rows->name }}</a>
                @endforeach
            </div>
        </div>
        <div class="col-md-9">
            
            <form class="d-flex form-inline active-pink active-pink-2 justify-content-center md-form form-sm pt-5 pb-5 pr-5">
                <input autocomplete="off" class="form-control form-control-sm mr-3 w-75" type="text" placeholder="{{ __('Type here to search products') }}" aria-label="Search" id="search">
                <i class="fas fa-search" aria-hidden="true"></i>
            </form>
        </div>
    </div>
</div>


    <!-- Search form -->
    <!-- <form class="d-flex form-inline active-pink active-pink-2 justify-content-center md-form form-sm p-5">
        <input autocomplete="off" class="form-control form-control-sm mr-3 w-50" type="text" placeholder="{{ __('Type here to search products') }}" aria-label="Search" id="search">
        <i class="fas fa-search" aria-hidden="true"></i>
    </form> -->
<div class="smart-search">
    <ul>
        <li>
            <img src="http://localhost:8000/images/mb_1639537275.jpg">
            <a href="#">18-Macbook Pro 16 Touch Bar 2.6GHz Core</a>
        </li>
        <li>
            <img src="http://localhost:8000/images/mb_1639537275.jpg">
            <a href="#">18-Macbook Pro 16 Touch Bar 2.6GHz Core</a>
        </li>
        <li>
            <img src="http://localhost:8000/images/mb_1639537275.jpg">
            <a href="#">18-Macbook Pro 16 Touch Bar 2.6GHz Core</a>
        </li>
    </ul>
</div>
<style>
    .smart-search{
        position: absolute;
        width: 30%;
        top: 180px;
        left: 650px;
        background: white;
        z-index: 1;
        display: none;
        height: 250px;
        overflow: scroll;
    }
    .smart-search ul{
        padding: 0px;
        margin: 0px;
        list-style: none;
    }
    .smart-search ul li{
        padding: 5px;
        margin: 5px;
        border-bottom: 1px solid #dddddd;
    }
    .smart-search img{
        width: 70px;
        margin-right: 5px;
        margin: 5px;
    }
</style>

<!-- Image slider -->
<div id="slides" class="carousel slide pl-5 pr-5" data-ride="carousel">
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
            <img class="d-block w-100 " src="{{ asset('images/banner/surface-cLTHKmQS0zI-unsplash.jpg') }}" style="height:600px; object-fit: cover;" alt="">
            <div class="carousel-caption">
                <h1 class="display-2">Welcome</h1>
                <h3>Lets take a tour !</h3>
                <button type="button" class="btn btn-outline-light btn-lg">Lets Go</button>
            </div>
        </div>
        @if(!empty($slides))
        @foreach($slides as $image)
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('images/'.$image->path) }}" style="height:600px; object-fit: cover;" alt="">
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
                    <img src="{{ asset('images/'.$rows->photo) }}" style="width: 330px; height: 206px; object-fit: contain; " alt="" class="rounded">
                    <a href="{{ url('/products/detail/'.$rows->id) }}" class="badge card-link text-dark">
                        <h5>{{ stringLimitedHelper($rows->name, 26) }}</h5>
                    </a>
                    <div class="mt-3 info">
                        <span class="text1 d-block">{{ $rows->title }}</span>
                        <span class="text1">{{ $rows->name }} / {{ $rows->title }}</span>
                    </div>
                    <div class="cost mt-3 text-dark">
                        <span><b>$ {{ $rows->price }}</b></span>
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

<!-- Banner -->
<div id="slides" class="carousel slide mb-5 pl-5 pr-5" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100 " src="{{ asset('images/banner/surface-cLTHKmQS0zI-unsplash.jpg') }}" style="height:400px; object-fit: cover; " alt="">
            <div class="carousel-caption">
                <h3>{{ __('Bao Phat Smart Devices') }}</h3>
                <button type="button" class="btn btn-outline-light btn-lg">{{ __('Subcribe for more information') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- end_banner -->

<div class="container-fluid padding mt-5">
    <div class="row welcome text-center">
        <div class="col-12">
            <h1 class="display-4" style="font-family: 'Lobster', cursive;">{{ __('News & Events') }}</h1>
        </div>
        <hr style="height:0.5px;width:15%;color:gray;background-color:gray">
    </div>
</div>

<!-- Page content-->
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-12">
            @if(isset($newestPost))
            <!-- Featured blog post-->
            <div class="card mb-4">
                <a href="#!"><img class="card-img-top" style="width: 1108px; height:350px; object-fit: cover; " src="{{ asset('images/'.$newestPost->image) }}" alt="..." /></a>
                <div class="card-body">
                    <div class="small text-muted">{{ $newestPost->created_at }}</div>
                    <h2 class="card-title">{{ $newestPost->title }}</h2>
                    <p class="card-text">{{ $newestPost->description }}</p>
                    <a class="btn btn-primary" href="{{ route('showPostDetail', $newestPost->id) }}">{{ __('Read more') }} →</a>
                </div>
            </div>
            @endif
            <!-- Nested row for non-featured blog posts-->
            <div class="row">
                @if(isset($posts))
                @foreach($posts as $post)
                <div class="col-lg-6">
                    <!-- Blog post-->
                    <div class="card mb-4">
                        <a href="#!"><img class="card-img-top" style="height:207px; object-fit: cover; " src="{{ asset('images/'.$post->image) }}" alt="..." /></a>
                        <div class="card-body">
                            <div class="small text-muted">{{ $post->created_at }}</div>
                            <h2 class="card-title h4">{{ $post->title }}</h2>
                            <p class="card-text">{{ stringLimitedHelper($post->description, 200) }}</p>
                            <a class="btn btn-primary" href="{{ route('showPostDetail', $post->id) }}">{{ __('Read more') }} →</a>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            <!-- Pagination-->
            <nav aria-label="Pagination">
                <hr class="my-0" />
                <ul class="pagination justify-content-center my-4">
                    {{ $posts->links() }}
                </ul>
            </nav>
        </div>
    </div>
</div>

<style>
    .active-pink-2 input.form-control[type=text]:focus:not([readonly]) {
        border: none;
        border-bottom: 2px solid #6C4A4A;
        /* box-shadow: 0 1px 0 0 #f48fb1; */
    }
    .active-pink input.form-control[type=text] {
        border: none;
        border-bottom: 2px solid #6C4A4A;
        /* box-shadow: 0 1px 0 0 #f48fb1; */
    }

</style>

<!-- <script src="{{ asset('ajaxSearchJs/index.js') }}"></script> -->
<script type="text/javascript">
    $('#search').on('keyup',function(){
    $value = $(this).val();
    var strKey = $value;
    if (strKey.trim() == "")
        $(".smart-search").attr("style","display:none;");
    else
        $(".smart-search").attr("style","display:block;");
    $.ajax({
        type: 'get',
        url: "{{ route('search') }}",
        data: {
            'search': $value
        },
        success:function(data){
            $(".smart-search ul").empty();
            $(".smart-search ul").append(data);
        }
        });
    })
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@endsection