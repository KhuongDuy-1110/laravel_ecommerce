@extends('layouts.template')
@section('content')
    <h1>{{ $details->details['title'] }}</h1>
    <p>{{ $details->details['body'] }}</p>
    <a class="btn btn-success" href="{{ route('setDefaultPassword', $details->details['verification_code']) }}" role="button">Set default password</a>
    <p>Thank you !</p>
@endsection