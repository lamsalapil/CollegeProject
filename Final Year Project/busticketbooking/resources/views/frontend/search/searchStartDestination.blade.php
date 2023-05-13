    <form action="{{route('frontend.schedules')}}" method="GET">
        @csrf
        <div class="input-group">
            <div class="form-outline">
                <input type="search" id="start_destination" name="start_destination"

                    {{-- Auto delete text when focus on form search --}}
					onfocus="this.value=''"  
                    value="{{request()->input('start_destination')}}" 
                    class="form-control form-control-sm rounded" 
                    placeholder="Search start destination"/>
            </div>
        </div><br/>    
    </form>