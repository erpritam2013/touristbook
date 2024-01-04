<div class="mb-left">
	<div class="mb-left-title">
		<label for="form_other_package" class="form-label">Other Package</label>
		<i class="fa fa-angle-up" aria-hidden="true"></i>
	</div>
	
	<div class="form-group" id="accordionOtherPackage">
		@if(!empty($filterOtherPackage))
		@php 
		$tal_count = 0;
		$tal_child_count = 0;
		@endphp
		@foreach($filterOtherPackage as $key => $other_package)
		@php
		if($key != 0){
			$parent_data = getSingleRecord($key,'OtherPackage',true);

			$parent_name_l = touristbook_sanitize_title($parent_data->name);

		}else{
			$parent_name_l = "more";
		}
		@endphp
		<div class="card">
			<div class="card-header main-title-tal" data-toggle="collapse" data-target="#{{$parent_name_l}}" aria-expanded="true">  

				<div class="custom-checkbox">
					<input type="checkbox" id="parent_other_packages_{{$tal_count}}" name="other_package_parent"
					class="custom-control-input filter-option filter-other-package-parent" value="{{$key}}" data-parent="{{$parent_name_l}}">
					<label class="btn btn-grad card-title w-100" for="parent_other_packages_{{$tal_count}}" class="custom-control-label">{{str_replace('-',' ',$parent_data->name)}}</label>
				</div>   
			</div>
			<div id="{{$parent_name_l}}" class="collapse" data-parent="#accordionOtherPackage" style="">
				<div class="card-body">
					<div class="form-group">
						@if(!empty($other_package))
						<ul class="list-unstyled mb-0">
							@foreach($other_package as $key_2 => $op_list)
							<li>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" id="other_packages_{{$tal_child_count}}" name="other_packages[]"
									class="custom-control-input filter-option filter-other-package" value="{{$op_list['id']}}">
									<label for="other_packages_{{$tal_child_count}}" class="custom-control-label">{{$op_list['name']}}</label>
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




