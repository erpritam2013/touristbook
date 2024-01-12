@extends('admin.layouts.main')
@section('activity_action', route('admin.activities.store'))
@section('activity_form_method', method_field('POST'))
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
                         @if(isset($activity) && !empty($activity))
                        <a href="{{route('activity',$activity->slug)}}" class="btn btn-info" target="_blank"><i class="fa fa-file"></i> view</a>
                        @endif
                        <a href="{{route('admin.activities.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
                    </div>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                    {!!get_form_success_msg(Session::get('success'))!!}
                    @endif
                    <div class="form-validation">
                     
                        @include('admin.activities.form', [
                            'activity' => $activity,
                            'term_activity_lists' => $term_activity_lists,
                            'states' => $states,
                            'attractions' => $attractions,
                            'languages' => $languages,
                        ])

                    </div> <!-- Form Validation Tag End -->
                </div> <!-- Card Body End -->
            </div> <!-- Card -->
        </div> <!-- 12 Div End -->
    </div> <!-- Row Div End -->
</div> <!-- Container Fluid End -->
@endsection
