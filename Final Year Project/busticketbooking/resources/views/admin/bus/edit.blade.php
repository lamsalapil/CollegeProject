@extends('layouts.admin')

@section('content')
    <div class="d-sm-flex align-items-center mb-4">
        <a class="h5 mb-0 mr-2 text-blue-800" href="{{url('admin/bus')}}">Bus</a> /
            <p class="h5 mb-0 text-gray-800 ml-2">Edit Bus</p>
    </div>
    <div class="vh-100 gradient-custom">
        <div class="container h-100">
            <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                <div class="card-body p-4 p-md-5">
                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Edit Bus
                        <a href="{{url('admin/bus')}}" class="fas fa-arrow-circle-left float-right btn btn-info btn-lg" title="Back to previous page"></a>
                    </h3> 
                    <form action="{{url('admin/bus/update/'.$bus->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <label class="form-label" for="bus_name">Bus Name</label>
                            <input type="text" id="bus_name" name="bus_name" class="form-control form-control-md @error('bus_name') is-invalid @enderror" role="alert" placeholder="Edit the bus name*" value="{{$bus->bus_name}}"/>
                        </div>
                        @error('bus_name')
                                <span class="invalid-feedback ">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                        </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <label class="form-label" for="email">Bus Number(license plates)</label>
                            <input type="text" id="bus_number" name="bus_number" placeholder="Edit the license plates*" class="form-control form-control-md @error('bus_number') is-invalid @enderror" role="alert" 
                                value="{{$bus->bus_number}}"/>
                        </div>
                        @if ($errors->has('bus_number'))
                                @error('bus_number')
                                    <div class="alert alert-light text-danger"><strong>{{ $message }}</strong></div>
                                @enderror
                        @endif
                    </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <h6 class="mb-2 pb-1" role="alert">Bus Status* </h6>
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="bus_status" 
                                    {{$bus->bus_status == '1' ? 'checked':''}} id="customSwitches">
                                    <label class="custom-control-label" for="customSwitches">Switch on=Shown/ Switch Off=Not Shown</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <label class="form-label" for="address">Amount of Seats</label>
                            <input type="number" id="number_of_seats" name="number_of_seats" class="form-control" value="{{$bus->number_of_seats}}" placeholder="Edit Amount of Seats*"/>
                        </div>
                        @error('number_of_seats')
                            <span>
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                        </div>
                        </div>
                        <div class="mb-4 pb-2 mr-2">
                            <div class="form-outline">
                                <label class="form-label" for="image_bus">Image of Bus*</label>
                                <input type="file" id="image_bus" name="image_bus[]" multiple 
                                            class="form-control  @error('image_bus') is-invalid @enderror" role="alert" 
                                            placeholder="Edit Bus Image"/>
                            </div>
                            <div>
                                @if($bus->imageBus)
                                <div class="row">
                                    @foreach ($bus->imageBus as $image)
                                    <div class="col-md-3">
                                            <a href="{{url('admin/bus/delete-image-bus/'.$image->id)}}" class=" d-block" style="right:20px; position:absolute; z-index:1;" title="Delete Image">
                                                <span class="fas fa-times text-info"></span>    
                                            </a>    
                                            <img src="{{asset($image->image_bus)}}" class=" me-4 border" style="width: 90px; height:90px;"/>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                    <h5>No Image Added</h5>
                                @endif
                            </div>
                            @error('image_bus')
                                <span class="invalid-feedback ">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                    <div class="row">
                        <div class="col-12">
                        <label class="form-label select-label">Choose the Driver</label>
                        <select class="form-control" name="driver_id">
                            <option disabled class="text-primary">Current Driver: {{$bus->users->name}}</option>
                            @foreach ($driver_id as $driver )
                                <option value="{{$driver->id}}">{{$driver->name}}</option>
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