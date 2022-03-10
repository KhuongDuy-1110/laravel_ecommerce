@extends('layouts.template')
@section('content')
<div class="col-md-12" style="margin: auto; margin-top: 50px;">
    <div class="panel panel-primary">
        <div class="panel-heading" style="background-color: #152555; color: white; padding: 10px; border-radius: 5px 5px 0px 0px ;">Add category</div>
        <div class="panel-body">
            <form method="post" action="{{ route('category.store') }}">
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
                    <div class="col-md-2">Parent</div>
                    <div class="col-md-10">
                        <select name="parent_id" class="form-control" style="width: 300px;">
                            <option value="0"></option>
                            <?php
                                $data = DB::table("category")->where("parent_id","=",0)->orderBy("id","asc")->get();
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