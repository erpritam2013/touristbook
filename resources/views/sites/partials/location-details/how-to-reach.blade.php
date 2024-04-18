@php 
$how_to_reach = $location->locationMeta->how_to_reach;
$how_to_reach_description = $location->locationMeta->how_to_reach_description;
@endphp
@if (!empty($how_to_reach) || !empty($how_to_reach_description))

@if (!empty($how_to_reach_description))
<div id="how-to-reach-description" class="st_location_extra_desc">
	{!!$how_to_reach_description!!}
</div>
@endif
<div class="row">
	@if(!empty($how_to_reach)) 
	@foreach ($how_to_reach as $key => $howtoreach)
	<div class="col-md-4">
		<div class="st-overview content">
			<h3 class="st-section-title">{{$howtoreach['how_to_reach-title']}}</h3>
			@php 
			$long_description = $howtoreach['how_to_reach-description'];
			$desc_len = strlen($long_description);
			$style_desc = 'style="overflow:hidden;height:100%;"';
			$show_attr = 'data-show_text="all"';
			if($desc_len > 400){
				$style_desc = 'style="overflow:hidden;height:170px;"';
				$show_attr = 'data-show_text="more"';
			}
			@endphp
			<div class="st-how-to-reach-description">
				<div class="long-description" id="long-description-{{$key}}" {!!$style_desc!!} {!!$show_attr!!}>
					{!!$long_description!!}
					<div><a href="{{$howtoreach['how_to_reach-link'] ?? '#'}}" class="btn btn-default" target="_blank">Connect</a></div>
				</div>
			</div>
			<div class="more-btn p-2" >
				@if( $desc_len > 400 )
				<a href="javascript:void(0);" class="btn btn-grad btn-sm" onclick="readMoreText(this)" id="readBtn" data-len="{{$desc_len}}" data-key="{{$key}}">Read More</a>
				@endif
			</div>
		</div>

	</div>

	@endforeach
	@endif
</div>
@else
<div class="alert alert-warning mt15">No how to reach found.</div>
@endif
