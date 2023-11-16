

 @if(!empty($location->locationMeta->best_time_to_visit_description))
 <div id="best-time-to-visit-description" class="st_location_extra_desc">
 	<div class="div-desc">
 		{!!$location->locationMeta->best_time_to_visit_description!!}
 	</div>
 </div>
 @endif

 @if(!empty($location->locationMeta->best_time_to_visit))
<h2 class="p-2" style="color:#07509c;">Best Time To Visit</h2>
       
 @php 

          $best_time_to_visit_keys = array_keys($location->locationMeta->best_time_to_visit[0]);
         unset($best_time_to_visit_keys[0]);
         
@endphp
 <table class="table table-striped" style="color:#000000!important;">
  <thead>
    <tr>
     @foreach ($best_time_to_visit_keys as $th)
       @php 
         $str_replace_th = str_replace("best_time_to_visit", "", $th);
         $str_replace_th = str_replace("-", " ", $str_replace_th);
         $str_replace_th = str_replace("_", " ", $str_replace_th);
         $str_replace_th = str_replace("min max", "Min/Max", $str_replace_th);
         $th = ucwords($str_replace_th);
       @endphp
        
      <th scope="col">{{$th}}</th>
      
      @endforeach
    </tr>
  </thead>
  <tbody>
    @foreach ($location->locationMeta->best_time_to_visit as $key => $best_time_to_visit_value)
    @php
         unset($best_time_to_visit_value['best_time_to_visit-title']);
         @endphp
    <tr>
      
    @foreach ($best_time_to_visit_keys as $td) 
      @if (isset($best_time_to_visit_value[$td]))
      <td>{{$best_time_to_visit_value[$td]}}</td>
   @endif 
   @endforeach
    </tr>
   @endforeach
   
  </tbody>
</table>
@else

      <div class="alert alert-warning mt15">No best time to visit  found.</div>
 

 @endif
