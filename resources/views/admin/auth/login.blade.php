@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body p-5">
                    <div>
                        <img src="{{asset('/assets/images/Deved8.svg')}}" class="w-30 mb-3" alt="">
                        <h4 class="mb-2 fw-bold">Sign in to account</h4>
                        <p class="mb-4 form-text">Enter your email & password to login</p>
                    </div>
                    <form method="POST" action="{{route('admin.login')}}">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label fw-bold">Email address</label>
                          <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label fw-bold">Password</label>
                          <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3 form-check">
                          <input name="remember" type="checkbox" class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1">Remember Password</label>
                        </div>
                        <button type="submit" class="btn btn-dark">Sign in</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
