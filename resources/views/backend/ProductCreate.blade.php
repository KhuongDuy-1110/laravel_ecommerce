@extends('layouts.template')
@section('content')
<div class="col-md-8" style="margin: auto; margin-top: 50px;">
    <div class="panel panel-primary">
        <div class="panel-heading" style="background-color:#152555; color: white;">Add product</div>
        <div class="panel-body">
            <form method="post" action="{{ route('user.store') }}">
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
                        <input type="mail" value="{{ isset($record->email)?$record->email:'' }}" name="email" class="form-control">
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
                        <input type="password" value="" name="password" class="form-control">
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
                        <select name="parent_id" class="form-control" style="width: 300px;">
                            <option value="0"></option>
                            <?php
                            $data = DB::table("category")->orderBy("id", "asc")->get();
                            ?>
                            @if(!empty($data))
                            @foreach($data as $rows)
                            <option @if (isset($record->parent_id) && $record->parent_id == $rows->id) selected @endif
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

                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Description</div>
                    <div class="col-md-10">
                        <input type="password" value="" name="password" class="form-control">
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

                <div class="input-group mb-3 mt-2">
                    <div class="col-md-2">Photo</div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>

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