<div class="card {{(count($other_packages) > 5)?'term-card':'term-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Other Packages</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $other_packages, 'name'=> 'other_packages', 'selected' => $selected])
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
      @include('admin.partials.utils.add_term', ['terms' => $other_packages, 'field_name'=> 'other_packages', 'term_id'=> 'other_packages', 'term_type'=> 'other_package_type', 'term' => 'OtherPackage','post_type'=>$post ?? ""])
        </div>
</div>
