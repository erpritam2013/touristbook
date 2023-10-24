 <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/"><i class="ti-home"></i>Home</a></li>
    @if(!empty($location_name))
    <li class="breadcrumb-item"><a href="{{$location_route ?? '#'}}" target="_blank"><i class="ti-home"></i> {!!ucwords($location_name)!!}</a></li>
    @endif
    <li class="breadcrumb-item active">{!!$post_name ?? ''!!}</li>
  </ol>
</nav>