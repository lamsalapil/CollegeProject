@extends('layouts.app')

@section('content')
<section class="login py-5 bg-primary">
        <div class="container">
          <div class="row1 g-0">
            <div class="col-lg-5 text-center">
              <!-- <img src="{{asset('frontend/img/login.svg')}}" class="img-fluid" alt="" /> -->
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <h3>Create New Account ?</h3>
              
              <a
                href="/register"
                class="btn btn-outline-primary rounded"
                id="sign-up-btn"
                
              >
                Sign up
              </a>
              <a href="/" class="fa fa-home btn btn-outline-primary btn-lg" title="Go to Home">
              </a>
            </div>
            <div class="col-lg-7 text-center py-5">
              <h1 class="animate__animated animate__rubberBand">
                Welcome
              </h1>
              <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-row py-auto pt-5">
                  <div class="offset-1 col-lg-10">
                    <i
                      class="fas fa-at"
                      style="margin-right: 10px"
                    ></i>
                    
                    <input
                      class="inp px-3 @error('email') is-invalid @enderror" role="alert"
                      type="email"
                      placeholder="Email Address"
                      name="email"
                      value="{{ old('email') }}"
                    />
                    @error('email')
                        <span class="invalid-feedback ">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <br/>
                <div class="form-row py-auto">
                  <div class="offset-1 col-lg-10">
                    <i
                      class="fas fa-lock"
                      style="margin-right: 10px"
                    ></i>
                    <input
                      class="inp px-3 @error('password') is-invalid @enderror" role="alert"
                      type="password"
                      placeholder="Password"
                      name="password"
                      
                    />
                    @error('password')
                        <span class="invalid-feedback ">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                <br/>
                @if (session('error'))
                      <div class="text-danger" style="">
                        <strong>{{ session('error') }}</strong>
                      </div>
                @endif
                <a href="{{route('password.request')}}" class="btn btn-link">Forgot the password?</a>
                <div class="form-row ">
                  <div class="offset-1 col-lg-10">
                    <button type="submit" class="btn1">
                      Login
                    </button>
                  </div>
                </div>
              </form>
              
              <br>
              <br><br>
              <br>
              <br><br>
              <!-- <p>Or Login with</p> -->
              <!-- <span>
                <i class="fab fa-facebook"></i>
              </span>
              <span>
                <i class="fab fa-google-plus"></i>
              </span> -->
            </div>
          </div>
        </div>
      </section>

@endsection
