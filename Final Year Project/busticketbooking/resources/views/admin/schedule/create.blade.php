@extends('layouts.admin')
@section('custom-css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
@endsection
@section('content')
    <div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header text-white bg-primary font-weight-bold">Create New Schedule</div>
            <form method="POST" action="{{ route('admin.schedule.store') }}" accept-charset="UTF-8">
                @csrf
                <div class="card-body">
                    <label for="bus_id" class="col-form-label">Bus Name*</label>
                                            <select class="form-control" name="bus_id" id="bus_id">
                                                <option selected>-- Select The Bus --</option>
                                                @foreach ($bus as $bus_name)
                                                    <option value="{{$bus_name->id}}">{{$bus_name->bus_name}}</option>
                                                @endforeach
                                            </select><br/>
                                            @error('bus_id')
                                                <span class="invalid-feedback ">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror<br/>
                    <label>Departure Time*</label>
                    <input type="datetime-local" class="form-control form-control-lg @error('start_at') is-invalid @enderror" role="alert" name="start_at" id="start_at">
                                            @error('start_at')
                                                <span class="invalid-feedback ">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror<br/>
                    
                    <label>Start Destination*</label>
                    <input type="search" class="form-control " name="start_destination_id" id="start_destination_id" placeholder="Search Location: Da Nang, Ha Noi, HCM...">
                                            @error('start_destination_id')
                                                <span class="invalid-feedback ">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror <br/>

                    <label>Destination*</label>
                    <input type="search" class="form-control" name="destination_id" id="destination_id" placeholder="Search Location: Da Nang, Ha Noi, HCM...">
                                            @error('destination_id')
                                                <span class="invalid-feedback ">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror <br/>
                                                
                    <label>Price*</label>
                    <input type="number" class="form-control form-control-lg @error('price_schedules') is-invalid @enderror" role="alert" name="price_schedules" id="price_schedules" placeholder="10, 15, 20,100USD..">
                                            @error('price_schedules')
                                                <span class="invalid-feedback ">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror<br/>                        
                    <label>Notes</label>
                    <textarea type="text" multiple name="notes" class=" form-control @error('notes') is-invalid @enderror" role="alert"></textarea>
                                            @error('notes')
                                                <span class="invalid-feedback ">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror <br/>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{route('admin.schedule.index')}}">Go Back</a>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    {{-- Jquery --}}
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    
    <script>
        // Tạo mảng rỗng chứa data
        var availableTags_startdestination = [
            
        ];
        $.ajax({
            method: "GET",
            url:"/admin/schedule/start-destination",
            success: function(response){
                // console.log(response)
                startAutoComplete_start_destination(response);
            }
        });
        function startAutoComplete_start_destination(availableTags_startdestination)
        {
            $( "#start_destination_id" ).autocomplete({
                source: availableTags_startdestination
            });
        }

        //Search Destination
        var availableTags_destination = [
            
        ];
        $.ajax({
            method: "GET",
            url:"/admin/schedule/destination",
            success: function(response){
                // console.log(response)
                startAutoComplete_destination(response);
            }
        });
        function startAutoComplete_destination(availableTags_destination)
        {
            $( "#destination_id" ).autocomplete({
                source: availableTags_destination
            });
        }
    </script>
@endsection