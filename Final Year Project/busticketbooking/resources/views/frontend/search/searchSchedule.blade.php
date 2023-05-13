<form action="{{route('frontend.schedules')}}" method="GET">
    @csrf
    <div class="fields">
        <div class="form-group">
            <input type="text" class="form-control" name="start_schedule" value="{{request()->input('start_schedule')}}"
                placeholder="Start Destination, City">
        </div>
        <div class="form-group">
            <div class="select-wrap one-third">
                <div class="icon">
                    <span class="ion-ios-arrow-down"></span>
                </div>
                <select name="destination_schedule" id="" class="form-control" placeholder="Keyword search">
                    <option value="">--Select Destination--</option>
                    @foreach ($all_schedules as $schedules)
                    @if($request->destination_schedule == $schedules->destination_id)
                    <option value="{{$schedules->destination_id}}" selected>{{$schedules->destination->name}}</option>
                    @else
                    <option value="{{$schedules->destination_id}}">{{$schedules->destination->name}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <input type="date" id="checkin_date" name="checkin_date" class="form-control" 
                value="{{request()->input('checkin_date')}}"
                autocomplete="off" placeholder="Date">
        </div>
        <div class="form-group">
            <input type="submit" value="Search" class="btn btn-outline-warning py-3 px-5">
        </div>
    </div>
</form>