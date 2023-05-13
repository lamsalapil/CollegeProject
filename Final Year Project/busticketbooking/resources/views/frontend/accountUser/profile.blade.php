@extends('layouts.frontend')
@section('custom-css')
    <style>
        .img-account-profile {
                height: 10rem;
                width: 10rem;
            }
    </style>
@endsection
@section('content')
    <div class="hero-wrap js-fullheight"
	style="background-image: url('https://cdn.pixabay.com/photo/2019/04/26/16/30/id-4157974_1280.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center"
                data-scrollax-parent="true">
                <div class="col-md-9 text-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span
                            class="mr-2"><a href="{{url('/')}}">Home</a></span> <span>My Profile</span></p>
                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">My Profile</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header text-white" style="background-color:#0063B2FF">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" src="{{ auth()->user()->avatar == null? asset('/admin/upload/img/avatar.png'): asset('/admin/upload/img/' . Auth::user()->avatar) }}" alt="">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG, JPEG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" type="button">Upload new image</button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload Avatar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ url('/upload-avatar') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="file" name="image">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn text-white" style="background-color:#5c3c92">Save changes</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header text-white" style="background-color:#0063B2FF">Account Details</div>
                <div class="card-body">
                    <form action="{{url('/update-profile')}}" method="POST">
                        @csrf
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Email (your email will appear here)</label>
                            <input class="form-control" id="inputUsername" type="email" placeholder="Enter your email" name="email" value="{{$show_info->email}}" readonly>
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputFirstName">Full Name</label>
                                <input class="form-control @error('full_name') is-invalid @enderror" id="inputFirstName" type="text" placeholder="Enter your full name" name="full_name" value="{{$show_info->name}}">
                                @error('full_name')
                                    <span class="invalid-feedback d-flex justify-content-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (organization name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOrgName">Address</label>
                                <input class="form-control" id="inputOrgName" type="text" placeholder="Enter your address" name="address" value="{{$show_info->address}}">
                            </div>
                            <!-- Form Group (location)-->
                            <div class="col-md-6">
                                <label class="small mb-1 @error('gender') is-invalid @enderror" for="inputLocation">Gender</label>
                                <div class="input-control">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender" value="M"
                                        {{$show_info->gender == 'M' ? 'checked':''}} />
                                        <label class="form-check-label" for="gender">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender" value="F"
                                        {{$show_info->gender == 'F' ? 'checked':''}} />
                                        <label class="form-check-label" for="gender">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender" value="O"
                                        {{$show_info->gender == 'O' ? 'checked':''}} />
                                        <label class="form-check-label" for="gender">Other</label>
                                    </div>
                                </div>
                                @error('gender')
                                    <div class="alert alert-light text-danger"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class="form-control @error('phone_number') is-invalid @enderror" id="inputPhone" type="tel" placeholder="Enter your phone number" name="phone_number" value="{{$show_info->phone_number}}">
                                @error('phone_number')
                                    <span class="invalid-feedback d-flex justify-content-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Birthday</label>
                                <input class="form-control @error('birthday') is-invalid @enderror" id="inputBirthday" type="date" name="birthday" placeholder="Enter your birthday" value="{{$show_info->date_of_birth}}">
                                @error('birthday')
                                    <span class="invalid-feedback d-flex justify-content-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- Update button-->
                        <button class="btn btn-primary" type="submit">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection