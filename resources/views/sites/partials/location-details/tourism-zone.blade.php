@if(!empty($tourismZone))
<div class="collapse show row" id="tourism-zone-div">

	<div class="col-md-12">
		<h2 class="st-heading-section">Tourism Zone</h2>

		<div class="border {{(isMobileDevice())?'p-3':'p-5'}} mt-3">
			{!! $tourismZone->tourism_zone_description !!}
		</div>
	</div>

	@if($tourismZone && !empty($tourismZone->tourism_zone))
	<div class="col-md-12 mt-3">



		<ul class="nav nav-tabs custom-tabs-detail" id="tourism-zone-area-pdf" >
			@foreach($tourismZone->tourism_zone as $key => $tzone)
			<li class="nav-item"> <a class="nav-link {{($key == 0)?'active':''}}" data-toggle="tab" href="#{{touristbook_sanitize_title($tzone['tourism_zone-title'])}}" onclick="tourism_zone_area_pdf(this)"> {!!$tzone['tourism_zone-title']!!} </a> </li>
			@endforeach

		</ul>

		<div class="tab-content text-justify">
			@foreach($tourismZone->tourism_zone as $key2 => $tzone)
			<div class="tab-pane {{($key2 == 0)?'active':''}}" id="{{touristbook_sanitize_title($tzone['tourism_zone-title'])}}">

				{!!$tzone['tourism_zone-description']!!}

			</div>
			@endforeach

		</div>


	</div>
	@endif

</div>
@endif