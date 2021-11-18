@extends('layouts.template')
@section('content')
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>
    <a class="btn btn-success" href="http://localhost:8000/verify?code={{ $details['verification_code'] }}" role="button">Verify</a>
    <p>Thank you !</p>
@endsection