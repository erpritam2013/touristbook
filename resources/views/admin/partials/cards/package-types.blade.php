<div class="card {{(count($package_types) > 5)?'term-card':'term-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Package Types</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $package_types, 'name'=> 'package_types', 'selected' => $selected])
        </div>
    </div>
    <div class="card-footer term-footer">
         @php $post = "";@endphp
      @isset($hotel)
       @php $post = $hotel;@endphp
      @endisset
      @isset($location)
       @php $post = $location;@endphp
      @endisset
      @isset($tour)
       @php $post = $tour;@endphp
      @endisset
      @isset($activity)
       @php $post = $activity;@endphp
      @endisset
      @isset($room)
       @php $post = $room;@endphp
      @endisset
      @include('admin.partials.utils.add_term', ['terms' => $package_types, 'field_name'=> 'package_types', 'term_id'=> 'package_types', 'term_type'=> 'package_type_type', 'term' => 'PackageType','post_type'=>$post ?? ""])
        </div>
</div>
