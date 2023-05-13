@extends('layouts.app')

@section('content')
    <section class="login py-5 bg-primary">
        <div class="container">
          <div class="row1 g-0">
            <div class="col-lg-5 text-center">
              <!-- <img src="{{asset('frontend/img/register.svg')}}" class="img-fluid" alt="" /> -->
              <br>
              <br>
              <br>
              <br><br><br><br>
              <h3>Sign In Right Here </h3>
              <p>Booking Now</p>
              <a
                href="/login"
                class="btn btn-outline-primary rounded"
                id="sign-up-btn"
              >
                Sign in
              </a>
              <a href="/" class="fa fa-home btn btn-outline-primary btn-lg" title="Go to Home">
              </a>
            </div>
            <div class="col-lg-7 text-center py-5">
              <h1 class="animate__animated animate__rubberBand">
                Join with us
              </h1>
              <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-row py-auto">
                  <div class="offset-1 col-lg-10">
                    <i
                      class="fas fa-user"
                      style="margin-right: 10px"
                    ></i>
                    <input
                      type="text"
                      name="name"
                      placeholder="Your Name"
                      class="inp px-3 @error('name') is-invalid @enderror" role="alert"
                      value="{{ old('name') }}" 

                    />
                    <br /> <br/>
                    @error('name')
                        <span class="invalid-feedback ">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>

                <div class="form-row py-auto">
                  <div class="offset-1 col-lg-10">
                    <i
                        class="fas fa-at"
                        style="margin-right: 10px"
                    ></i>
                    <input
                        type="email"
                        name="email"
                        placeholder="Your Email"
                        class="inp px-3 @error('email') is-invalid @enderror" role="alert"
                        value="{{ old('email') }}" 
                    />
                    <br /> <br/>
                    @error('email')
                        <span class="invalid-feedback ">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>

                {{-- Password --}}
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
                      value="{{ old('password') }}" 
                      
                    />
                    <br/> <br/>
                    @error('password')
                        <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                </div>
                  {{-- Confirm password --}}
                  <div class="form-row py-auto">
                    <div class="offset-1 col-lg-10">
                        <i
                            class="fas fa-lock"
                            style="margin-right: 10px"
                        ></i>
                        <input
                            class="inp px-3"
                            type="password"
                            placeholder="Confirm Password"
                            name="password_confirmation"
                            required autocomplete="new-password"
                            id="password-confirm"
                        />
                    </div>
                </div>
                <div class="form-row py-3">
                  <div class="offset-1 col-lg-10">
                    <button type="submit" class="btn1">
                      Register
                    </button>
                  </div>
                </div>
              </form>
              <br><br><br><br><br>
            </div>
          </div>
        </div>
      </section>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
