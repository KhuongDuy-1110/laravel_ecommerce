@extends('layouts.template')
@section('content')
<div class="col-md-12" style="margin: auto; margin-top: 50px;">
    <div class="panel panel-primary">
        <div class="panel-heading" style="background-color: #152555; color: white; padding: 10px; border-radius: 5px 5px 0px 0px ;">Add image slide</div>
        <div class="panel-body mt-5">
            <form method="post" action="{{ route('image.store',['type' => $type]) }}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Image</div>
                    <div class="col-md-10">
                        <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                            <input id="upload" name="image" type="file" onchange="readURL(this);" class="form-control border-0">
                            <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
                            <div class="input-group-append">
                                <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
                            </div>
                        </div>
                    </div>
                    <!-- Uploaded image area-->
                    <div class="image-area mt-4"><img id="imageResult" style="width: 250px;" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                </div>
                @if($errors->has('image'))
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10 text-danger">{{ $errors->first('image') }}
                    </div>
                </div>
                @endif
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Status</div>
                    <div class="col-md-10 pl-0">
                        <div class="col-md-10 row form-inline">
                            <label for="imageActive" class="col-sm-1 col-form-label">Active</label>
                            <input type="checkbox" name='imageActive' id="imageActive" name="hot" class="form-control" style="width: 15px;">
                        </div>
                    </div>
                </div>
                <!-- end rows -->


                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <input type="submit" value="Process" class="btn btn-primary" style="background-color:#152555;">
                    </div>
                </div>
                <!-- end rows -->
            </form>
        </div>
    </div>
</div>
@endsection
<link rel="stylesheet" href="{{ asset('imageInputCssJs/style.css') }}">
<script src="{{ asset('imageInputCssJs/index.js') }}"></script>