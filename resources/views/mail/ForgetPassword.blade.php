@extends('layouts.template')
@section('content')
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>
    <a class="btn btn-success" href="http://localhost:8000/forgot-password?code={{ $details['verification_code'] }}" role="button">Set new password</a>
    <p>Thank you !</p>
@endsection