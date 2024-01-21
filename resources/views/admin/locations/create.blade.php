@extends('admin.layouts.main')
@section('location_action', route('admin.locations.store'))
@section('title',$title)
@section('content')
<div class="container-fluid">
  @include('admin.layout-parts.breadcrumbs')
  <div class="row">
    <div class="col-lg-12">
        <div class="card main-card">
            <div class="card-header">
                <h4 class="card-title">{{$title}}</h4>
                <div align="right">
                     @if(isset($location) && !empty($location))
                     @if(!empty($location->slug))
                        <a href="{{route('location',$location->slug)}}" class="btn btn-info" target="_blank"><i class="fa fa-file"></i> view</a>
                        @endif
                        @endif
                    <a href="{{route('admin.locations.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                {!!get_form_success_msg(Session::get('success'))!!}
                @endif
                <div class="form-validation">
                  @include('admin.locations.form', [
                  'location' => $location,
                  'places' => $places,
                  'types' => $types,
                  'states' => $states,
                  ])
              </div> <!-- Form Validation Tag End -->
          </div> <!-- Card Body End -->
      </div> <!-- Card -->
  </div> <!-- 12 Div End -->
</div> <!-- Row Div End -->
</div> <!-- Container Fluid End -->
@endsection
