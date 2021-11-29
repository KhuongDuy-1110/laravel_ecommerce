@extends("layouts.template")
@section("content")
  <div style="width: 40%; margin: auto; margin-top: 20px;">
      @if (session('flash_success'))
      <div class="alert alert-success">
        {{ session('flash_success') }}
      </div>
      @endif 
      @if (session('flash_warning'))
      <div class="alert alert-warning">
        {{ session('flash_warning') }}
      </div>
      @endif
      <form method="POST" >
      @csrf
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      </div>
      @if(isset($warning))
      <div class="p-3 mb-2 bg-danger text-white">{{ $warning }}</div>
      @endif

      <button type="submit" class="btn btn-primary">Login</button>
      <!-- <a href="{{ url('/get-password') }}" class="btn btn-primary">Forgot password</a> -->
      </form>
  </div>
@endsection