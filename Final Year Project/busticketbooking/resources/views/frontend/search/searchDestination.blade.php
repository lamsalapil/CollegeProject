<form action="{{route('frontend.schedules')}}" method="GET">
    @csrf
    <div class="input-group">
        <div class="form-outline">
            <input type="search" id="destination" 
                class="form-control form-control-sm rounded" 
                placeholder="Search destination"
                name="destination"
                {{-- Auto delete text when focus on form search --}}    
                onfocus="this.value=''" 
				value="{{request()->input('destination')}}" 
            />
    </div>
    </div><br/>            
</form>