<div class="mb-left">
	<div class="mb-left-title">
		<label for="form_amenities_types" class="form-label">Activity List</label>
		<i class="fa fa-angle-up" aria-hidden="true"></i>
	</div>
	
	<div class="form-group" id="accordionTermActivityList">
		@if(!empty($filterTermActivityList))
		@php 
        $tal_count = 0;
        $tal_child_count = 0;
		@endphp
		@foreach($filterTermActivityList as $key => $activity_list)
		<div class="card">
			<div class="card-header {{($tal_count != 0)?'collapsed':''}} main-title-tal" data-toggle="collapse" data-target="#{{$key}}" aria-expanded="true">     
				<span class="btn btn-grad card-title pt-1 pb-1 px-5 mb-0 w-100">{{str_replace('-',' ',$key)}}</span>
			</div>
			<div id="{{$key}}" class="collapse {{$tal_count == 0?'show':''}}" data-parent="#accordionTermActivityList" style="">
				<div class="card-body">
					<div class="form-group">
					@if(!empty($activity_list))
					<ul class="list-unstyled mb-0">
						@foreach($activity_list as $key_2 => $ac_list)
						<li>
							<div class="custom-control custom-checkbox">
								<input type="checkbox" id="term_activity_lists_{{$tal_child_count}}" name="term_activity_lists[]"
								class="custom-control-input filter-option filter-term-activity-lists" value="{{$ac_list['id']}}">
								<label for="term_activity_lists_{{$tal_child_count}}" class="custom-control-label">{{$ac_list['name']}}</label>
							</div>
						</li>
						@php $tal_child_count++; @endphp
						@endforeach
					</ul>
					@endif
				</div>
				</div>
			</div>
		</div>
						@php $tal_count++; @endphp
		@endforeach
		@endif

	</div>

</div>




