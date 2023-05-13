@extends('layouts.admin')

@section('content')
    <div class="d-sm mb-4">
        <p class="h4 mb-0 mr-2 font-weight-bold">Image of Bus Name: <span class="text-primary">{{$bus->bus_name}}</span>
            <a class="btn btn-primary float-right mb-3" href="{{url('admin/bus')}}"><i class="fas fa-arrow-circle-left rounded"> Go back</i></a>
        </p> 
    </div>
    <div class="row mt-4">
        @if($check)
            @foreach ($images_bus as $img)
                <div class="col-md-3">
                    <div class="card text-white bg-sencondary mb-3" style="max-width: 20rem">
                        <div class="card-body">
                            <img src="{{ asset($img) }}" width="200" height="200" class="card-img-top rounded" alt=""/>
                        </div>
                    </div>
                </div>    
            @endforeach
            @else
                <h5>No Image Added</h5>
            @endif
    </div>
@endsection