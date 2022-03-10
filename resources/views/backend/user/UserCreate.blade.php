@extends('layouts.template')
@section('content')
<div class="col-md-12" style="margin: auto; margin-top: 50px; margin-bottom: 400px;">
    <div class="panel panel-primary">
        <div class="panel-heading" style="background-color: #152555; color: white; padding: 10px; border-radius: 5px 5px 0px 0px ;">Add user</div>
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
                    <div class="col-md-2">Email</div>
                    <div class="col-md-10">
                    <input type="mail" value="{{ isset($record->email)?$record->email:'' }}" name="email" class="form-control">
                    </div>
                </div>
                @if($errors->has('email'))
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10 text-danger">{{ $errors->first('email') }}
                    </div>
                </div>
                @endif
            
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Password</div>
                    <div class="col-md-10">
                    <input type="password" value="" name="password" class="form-control">
                    </div>
                </div>
                @if($errors->has('password'))
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10 text-danger">{{ $errors->first('password') }}
                    </div>
                </div>
                @endif
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