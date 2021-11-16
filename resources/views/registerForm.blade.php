@extends("layouts.template")
@section("content")
    <div style="width: 40%; margin: auto; margin-top: 20px;">
    <form method="post">
        @csrf
        <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Name">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
@endsection