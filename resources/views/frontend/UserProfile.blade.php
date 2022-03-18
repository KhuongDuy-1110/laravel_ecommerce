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
                <div class="col-md-8">
                    <div class="d-flex">
                        <img src="{{ asset('images/banner/logo.png') }}" style="width: 70px;" alt="">
                        <h3 class="ml-2 pt-4"><b>Profile</b></h3>
                    </div>
                    <p class="mb-4">Welcome to Bao Phat Smart Devices !</p>
                    @include('layouts.flash-message')
                    <div class="col-md-12 d-flex" style="border: 3px solid #6C4A4A; border-radius: 5px; border-style: none none solid solid;">
                        <div class="col-md-10 m-auto">

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Name: </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticName" name="name" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Email: </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" name="email" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Phone: </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" name="phone" value="{{ $user->phone }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Address: </label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" name="address" value="{{ $user->address }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg" width="200" height="200" class="rounded-circle">
                        </div>
                    </div>
                    <div class="d-flex mt-2 flex-row-reverse">
                    <button type="button" style="background-color: #6C4A4A;" class="btn btn-primary border-0" data-toggle="modal" data-target="#modalPassword">Update Password</button>
                        <button type="button" style="background-color: #6C4A4A;" class="btn btn-primary border-0 mr-2" data-toggle="modal" data-target="#modalInformation">Update Information</button>
                    </div>

                    <!-- Modal Information -->
                    <div class="modal fade" id="modalInformation" tabindex="-1" role="dialog" aria-labelledby="modalInformationLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalInformationLabel">Update User Information</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="col-md-10 m-auto">
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-2 col-form-label">Name: </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control-plaintext" id="staticName" name="name" value="{{ $user->name }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-2 col-form-label">Email: </label>
                                                <div class="col-sm-10">
                                                    <input type="text" disabled class="form-control-plaintext" id="staticEmail" name="email" value="{{ $user->email }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-2 col-form-label">Phone: </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control-plaintext" id="staticEmail" name="phone" value="{{ $user->phone }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-2 col-form-label">Address: </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control-plaintext" id="staticEmail" name="address" value="{{ $user->address }}">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                        <button type="submit" name="change" value="0" class="btn btn-danger">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Information -->

                    <!-- Modal Password -->
                    <div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="modalPasswordLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalPasswordLabel">Update New Password</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="col-md-12 m-auto">
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-form-label">Current Password: </label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control-plaintext" id="staticName" name="oldPassword" placeholder="Old Password" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-form-label">New Password: </label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control-plaintext" id="staticEmail" name="password" placeholder="New Password">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-form-label">Confirm New Password: </label>
                                                <div class="col-sm-7">
                                                    <input type="text" class="form-control-plaintext" id="staticEmail" name="password-confirmation" placeholder="Confirm">
                                                </div>
                                            </div>
                                            
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                        <button type="submit" name="change" value="1" class="btn btn-danger">Confirm</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal Password -->

                </div>
            </div>
        </div>
    </div>
</div>

@endsection