<div class="card {{(count($categories) > 5)?'term-card':'term-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Categories</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            @include('admin.partials.utils.nested_checkbox_list', ['items' => $categories, 'name'=> 'categories', 'selected' => $selected])
            @isset($required)
             {!! get_form_error_msg($errors, 'categories') !!}
             @endisset
        </div>
    </div>
    <div class="card-footer term-footer">
          @isset($post)
       @php $post_d = $post;@endphp
      @endisset
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
      @isset($post_d)
       @php $post = $post_d;@endphp
      @endisset
      @include('admin.partials.utils.add_term', ['terms' => $categories, 'field_name'=> 'categories', 'term_id'=> 'category', 'term_type'=> 'category_type', 'term' => 'Category','post_type'=> $post ?? ""])
        </div>
</div>
