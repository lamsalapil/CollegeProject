    <form action="{{route('frontend.schedules')}}" method="GET">
		@csrf
		<div class="input-group">
			<div class="form-outline">
				<input type="search" name="bus_name" id="bus_name" 
				{{-- Auto delete text when focus on form search --}}
					onfocus="this.value=''" 
					value="{{request()->input('bus_name')}}" 
					class="form-control form-control-sm rounded" 
					placeholder="Search bus house..."/>
			</div>
		</div><br/>
	</form>
