@extends('layouts.frontend')
@section('custom-css')
    <style>
        @import "bourbon";
        .wrapper {	
            margin-top: 80px;
        margin-bottom: 80px;
        }

        .form-signin {
        max-width: 380px;
        padding: 15px 35px 45px;
        margin: 0 auto;
        background-color: #fff;
        border: 1px solid rgba(0,0,0,0.1);  

        .form-signin-heading,
            .checkbox {
            margin-bottom: 30px;
            }

            .checkbox {
            font-weight: normal;
            }

            .form-control {
                position: relative;
                font-size: 16px;
                height: auto;
                padding: 10px;
                box-sizing: border-box;
                &:focus {
                z-index: 2;
                }
            }

            input[type="text"] {
            margin-bottom: -1px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
            }

            input[type="password"] {
            margin-bottom: 20px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            }
        }

    </style>
@endsection
@section('content')
    <div class="hero-wrap js-fullheight"
	style="background-image: url('https://images.unsplash.com/photo-1633265486064-086b219458ec?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center"
                data-scrollax-parent="true">
                <div class="col-md-9 text-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span
                            class="mr-2"><a href="{{url('/')}}">Home</a></span> <span>Change Password</span></p>
                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Change Password</h1>
                </div>
            </div>
        </div>
    </div>
     <div class="wrapper">
        <form class="form-signin" action="{{url('/update-password')}}" method="POST">
            @csrf       
            <h2 class="form-signin-heading">Change Password</h2>
            <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" placeholder="Enter Old Password" autofocus="" /><br/>
            @error('old_password')
                <span class="invalid-feedback d-flex justify-content-left" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" placeholder="Enter New Password"/><br/>
            @error('new_password')
                <span class="invalid-feedback d-flex justify-content-left" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" placeholder="Enter Confirm Password"/><br/>   
            @error('confirm_password')
                <span class="invalid-feedback d-flex justify-content-left" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <button class="btn btn-lg btn-success btn-block" type="submit">Update Password</button>   
        </form>
  </div>
@endsection