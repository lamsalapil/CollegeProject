@extends('layouts.admin')

@section('content')
    <div class="d-sm-flex align-items-center mb-4">
        <a class="h5 mb-0 mr-2 text-blue-800" href="{{url('admin/account')}}">Account</a> /
            <p class="h5 mb-0 text-gray-800 ml-2">Edit Account</p>
    </div>
    <div class="vh-100 gradient-custom">
        <div class="container h-100">
            <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                <div class="card-body p-4 p-md-5">
                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Edit Account
                        <a href="{{url('admin/account')}}" class="fas fa-arrow-circle-left float-right btn btn-info btn-lg" title="Back to previous page"></a>
                    </h3> 
                    <form action="{{url('admin/account/update/'.$user->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <label class="form-label" for="name">Full Name</label>
                            <input type="text" id="name" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" role="alert" placeholder="Edit the name *" value="{{$user->name}}"/>
                        </div>
                        @if ($errors->has('name'))
                            @error('name')
                                <div class="alert alert-light text-danger"><strong>{{ $message }}</strong></div>
                            @enderror
                        @endif
                        </div>

                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Edit the email*" class="form-control form-control-lg @error('email') is-invalid @enderror" role="alert" value="{{$user->email}}"/>
                        </div>
                        @if ($errors->has('email'))
                            @error('email')
                                <div class="alert alert-light text-danger"><strong>{{ $message }}</strong></div>
                            @enderror
                        @endif
                    </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4 d-flex align-items-center">
                            <div class="form-outline datepicker w-100 @error('date_of_birth') is-invalid @enderror">
                                <label for="date_of_birth" class="form-label " role="alert">Birthday*</label>
                                <input type="date" class="form-control form-control-lg " id="date_of_birth" name="date_of_birth" value="{{$user->date_of_birth}}" placeholder="dd-mm-yyyy"/>
                            @if ($errors->has('date_of_birth'))
                            @error('date_of_birth')
                                <div class="alert alert-light text-danger"><strong>{{ $message }}</strong></div>
                            @enderror
                            @endif
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <h6 class="mb-2 pb-1 @error('gender') is-invalid @enderror" role="alert">Gender* </h6>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender" value="M"
                                {{$user->gender == 'M' ? 'checked':''}} />
                                <label class="form-check-label" for="gender">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender" value="F"
                                {{$user->gender == 'F' ? 'checked':''}} />
                                <label class="form-check-label" for="gender">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender" value="O"
                                {{$user->gender == 'O' ? 'checked':''}} />
                                <label class="form-check-label" for="gender">Other</label>
                            </div>
                            @if ($errors->has('gender'))
                            @error('gender')
                                <div class="alert alert-light text-danger"><strong>{{ $message }}</strong></div>
                            @enderror
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4 pb-2">
                            <div class="form-outline">
                                <label class="form-label" for="address">Address</label>
                                <input type="text" id="address" 
                                    class="form-control form-control-lg" 
                                    value="{{$user->address}}" name="address" 
                                    placeholder="Edit address"/>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 pb-2">
                            <div class="form-outline">
                                <label class="form-label" for="phone_number">Phone Number*</label>
                                <input type="number" id="phone_number" name="phone_number" 
                                            class="form-control form-control-lg @error('phone_number') is-invalid @enderror" role="alert" 
                                            placeholder="Edit phone number"
                                            value="{{$user->phone_number}}"
                                            />
                            </div>
                            @if ($errors->has('phone_number'))
                                @error('phone_number')
                                {{-- <div class="alert alert-danger">{{ $message }}</div> --}}
                                    <div class="alert alert-light text-danger"><strong>{{ $message }}</strong></div>
                                @enderror
                            @endif
                        </div>
                        </div>
                    <div class="row">
                        <div class="col-12">
                                    <label for="avatar" class="form-label">Avatar</label>
                                    <input class="form-control @error('avatar') is-invalid @enderror" role="alert" name="avatar" type="file" id="avatar">
                        </div>
                        {{-- @if ($errors->has('avatar')) --}}
                                @error('avatar')
                                {{-- <div class="alert alert-danger">{{ $message }}</div> --}}
                                    <div class="alert alert-light text-danger"><strong>{{ $message }}</strong></div>
                                @enderror
                        {{-- @endif --}}
                        @if($user->avatar)
                            <img src="{{asset('admin/upload/img/'.$user->avatar)}}" class="img-thumbnail rounded" alt="{{$user->avatar}}">
                        @endif
                    </div><br/>
                    <div class="row">
                        <div class="col-12">
                        <label class="form-label select-label">Choose the role</label>
                        <select class="form-control" name="role_id">
                            <option class="text-primary" value="{{$user->role->id}}">--Select the roles--</option>
                            <option disabled class="text-primary">Current role: {{$user->role->name}}</option>
                            @foreach ($role_id as $roles )
                                <option value="{{$roles->id}}">{{$roles->name}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="mt-4 pt-2 float-right">
                        <button class="btn btn-primary btn-lg fas fa-save" type="submit" title="Submit"> Update</button>
                    </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection