@extends("layouts.template")
@section("content")
    <h1>welcome !</h1>
    <a href="{{ url('/logout') }}">Logout</a>
@endsection