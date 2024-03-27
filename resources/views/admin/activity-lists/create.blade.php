@extends('admin.layouts.main')
@section('activity_list_action', route('admin.activity-lists.store'))
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
                    <a href="{{route('admin.activity-lists.index')}}" class="btn btn-dark btn-xs"><i class="fa fa-arrow-right"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                {!!get_form_success_msg(Session::get('success'))!!}
                @endif
                
                <div class="form-validation">
                  @include('admin.activity-lists.form', [
                  'activity_list' => $activity_list,
                  'custom_icons' => $custom_icons,
                  'activities' => $activities,
                  ])
              </div> <!-- Form Validation Tag End -->
          </div> <!-- Card Body End -->
      </div> <!-- Card -->
  </div> <!-- 12 Div End -->
</div> <!-- Row Div End -->
</div> <!-- Container Fluid End -->
@endsection