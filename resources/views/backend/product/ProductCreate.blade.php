@extends('layouts.template')
@section('content')
<div class="col-md-12" style="margin: auto; margin-top: 50px;">
    <div class="panel panel-primary">
        <div class="panel-heading" style="background-color: #152555; color: white; padding: 10px; border-radius: 5px 5px 0px 0px ;">Add product</div>
        <div class="panel-body">
            <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Name</div>
                    <div class="col-md-10">
                        <input type="text" value="{{ isset($record->name)?$record->name:'' }}" name="name" class="form-control">
                    </div>
                </div>
                @if($errors->has('name'))
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10 text-danger">{{ $errors->first('name') }}
                    </div>
                </div>
                @endif
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Title</div>
                    <div class="col-md-10">
                        <input type="text" value="{{ isset($record->title)?$record->title:'' }}" name="title" class="form-control">
                    </div>
                </div>
                @if($errors->has('Title'))
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10 text-danger">{{ $errors->first('Title') }}
                    </div>
                </div>
                @endif
                <!-- end rows -->

                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Price</div>
                    <div class="col-md-10">
                        <input type="number" value="" name="price" class="form-control">
                    </div>
                </div>
                @if($errors->has('price'))
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10 text-danger">{{ $errors->first('price') }}
                    </div>
                </div>
                @endif
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Category</div>
                    <div class="col-md-10">
                        <select name="category" class="form-control" style="width: 300px;">
                                    <option value="0"></option>
                            @if(!empty($Category))
                                @foreach($Category as $rows)
                                    <option @if (isset($record->parent_id) && $record->parent_id == $rows->id) selected @endif
                                        value="{{ $rows->id }}"> {{ $rows->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                @if($errors->has('category'))
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10 text-danger">{{ $errors->first('category') }}
                    </div>
                </div>
                @endif
                <!-- end rows -->

                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Hot</div>
                    <div class="col-md-1">
                        <input type="checkbox" name="hot" class="form-control">
                    </div>
                </div>

                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Description</div>
                    <div class="col-md-10">
                        <!-- <input type="text" value="" name="description" class="form-control"> -->
                        <textarea name="description" id="product-description" rows="10" cols="80" class="form-control"></textarea>
                        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
                        <script> CKEDITOR.replace( 'product-description' ); </script>
                    </div>
                </div>
                @if($errors->has('description'))
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10 text-danger">{{ $errors->first('description') }}
                    </div>
                </div>
                @endif
                <!-- end rows -->

                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Photo</div>
                    <div class=" col-md-8">
                        <input type="file" class="custom-file-input" name="photo" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                @if($errors->has('photo'))
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10 text-danger">{{ $errors->first('photo') }}
                    </div>
                </div>
                @endif
                <style>
                    .custom-file-label{
                        left: 15px;
                    }
                </style>

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