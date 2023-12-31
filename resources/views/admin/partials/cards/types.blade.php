<div class="card {{(count($types) > 5)?'term-card':'term-card-padding'}}">
    <div class="card-header border-bottom">
          @isset($post)
       @php $label_d = 'Post';@endphp
      @endisset
      @php $label = "";@endphp
      @isset($hotel)
       @php $label = 'Hotel';@endphp
      @endisset
      @isset($location)
       @php $label = 'Location';@endphp
      @endisset
      @isset($tour)
       @php $label = 'Tour';@endphp
      @endisset
      @isset($activity)
       @php $label = 'Activity';@endphp
      @endisset
      @isset($label_d)
       @php $label = $label_d;@endphp
      @endisset
        <h4 class="card-title">{{$label}} Type</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $types, 'name'=> 'type', 'selected' => $selected])
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
       @include('admin.partials.utils.add_term', ['terms' => $types, 'field_name'=> 'types', 'term_id'=> 'type', 'term_type'=> 'type', 'term' => 'Type','post_type'=>$post ?? ""])
        </div>
</div>
