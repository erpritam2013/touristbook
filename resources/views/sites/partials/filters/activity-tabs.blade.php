 @php $section_rc = touristbook_custom_grouping_val($sections,'activity_zone_section'); 
  $p_index = 0;

@endphp

 <div class="accordion activity-zone-parent-section mb-0" id="accordion" data-parent_count="{{count($section_rc)}}" >
  <div class="activity-zone-heading"><h4>Activity Zone</h4></div>
 	@foreach ($section_rc as $parent => $section)
 	<div class="accordion-item" data-parent_index="{{$p_index}}">

 		<div class="accordion-title border border-ligh">
 			<a class="collapsed p-2" data-toggle="collapse" href="#{{$parent}}"><h5 style="line-height: 2em;">{{ strtoupper(str_replace('-', " ", $parent)).' & GUIDELINES'; }}<i class="fa fa-hand-o-up" aria-hidden="true"></i></h5>
      </a>
 			
 		</div>
  <div class="collapse" id="{{$parent}}" data-parent="#accordion">

 		<div class="accordion-content p-0">
 			<ul class="nav nav-tabs" role="tablist">
            @foreach ($section as $key_1 => $post_1)
              @php $active_c = ""; @endphp
              @if ($key_1 == 0 && $p_index == 0)
                @php $active_c = 'active';@endphp
              @endif
              @php $post_title_sm = touristbook_sanitize_title($post_1['activity_zone_section-title']); @endphp
              <li class="activity-zone-li {{$active_c}} nav-item w-100 mb-1 rounded-0 " role="{{$post_title_sm;}}"><a class="nav-link p-2" href="#{{$post_title_sm}}" aria-controls="{{$post_title_sm;}}" role="tab" data-toggle="tab">{!!$post_1['activity_zone_section-title']!!}</a></li>

            @endforeach
          </ul>
 		</div>
    </div>
 	</div>
@php 
$p_index++;
@endphp
@endforeach
@php 
$pdf_link = '#!';
@endphp
@if (!empty($activity_zone_pdf_link))
 
 @php $pdf_link =$activity_zone_pdf_link;@endphp
<div class="update-more-information text-center">
  <div class="activity-zone-heading">
    <h4 class="p-0"><a href="{{$pdf_link ?? '#!'}}" target="_blank" class='btn btn-green btn-large btn-full upper pt-3'>FOR MORE UPDATE <i class="fa fa-hand-o-up" aria-hidden="true"></i></a></h4 class="p-1">
  </div>
  </div>
@endif
 </div>


  