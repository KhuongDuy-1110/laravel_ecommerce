@extends('layouts.template')
@section('content')
<div class="col-md-12" style="margin: auto; margin-top: 50px;">
    <div class="panel panel-primary">
        <div class="panel-heading" style="background-color: #152555; color: white; padding: 10px; border-radius: 5px 5px 0px 0px ;">Update product</div>
        <div class="panel-body">
            <form method="post" action="{{ route('product.update',isset($record->id)?$record->id:'') }}" enctype="multipart/form-data">
                @method('PUT')
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
                        <input type="number" value="{{ isset($record->price)?$record->price:'' }}" name="price" class="form-control">
                    </div>
                </div>
                @if($errors->has('Price'))
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10 text-danger">{{ $errors->first('Price') }}
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
                                    <option @if (isset($record->category_id) && $record->category_id == $rows->id) selected @endif
                                        value="{{ $rows->id }}"> {{ $rows->name }}
                                    </option>                           
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                @if($errors->has('Category'))
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10 text-danger">{{ $errors->first('Category') }}
                    </div>
                </div>
                @endif
                <!-- end rows -->

                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Hot</div>
                    <div class="col-md-1">
                        <input type="checkbox" @if($record->hot == 1) checked @endif name="hot" class="form-control">
                    </div>
                </div>

                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Description</div>
                    <div class="col-md-10">
                        <!-- <input type="text" value="{{ isset($record->description)?$record->description:'' }}" name="description" class="form-control"> -->
                        <textarea name="description"  id="product-description" rows="10" cols="80" class="form-control">
                            {{ isset($record->description)?$record->description:'' }}
                        </textarea>
                        <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
                        <script> CKEDITOR.replace( 'product-description' ); </script>
                    </div>
                </div>
                @if($errors->has('Description'))
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10 text-danger">{{ $errors->first('Description') }}
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