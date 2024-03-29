@extends('admin.layouts.main')
@section('hotel_action', route('admin.hotels.update', $hotel->id))
@section('hotel_form_method', method_field('PUT'))
@section('title',$title)
@if(auth()->check())
@if(auth()->user()->isAdmin() || auth()->user()->isEditor())
@section('get_a_link')
{!!get_a_link($title,route('hotel',$hotel->slug),'view')!!}
@endsection
@endif 
@endif
@section('admin_head_css')
<link rel="stylesheet" href="{!! asset('admin-part/vendor/select2/css/select2.min.css') !!}">
@parent
@endsection
@section('content')


<div class="container-fluid">
  @include('admin.layout-parts.breadcrumbs')
    <div class="row">
        <div class="col-lg-12">
            <div class="card main-card">
                <div class="card-header">
                    <h4 class="card-title">{{$title}}</h4>
                    <div align="right">
                         @if(isset($hotel) && !empty($hotel))
                         @if(!empty($hotel->slug))
                        <a href="{{route('hotel',$hotel->slug)}}" class="btn btn-info" target="_blank"><i class="fa fa-file"></i> view</a>
                        @endif
                        @endif
                        <a href="{{route('admin.hotels.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
                    </div>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                    {!!get_form_success_msg(Session::get('success'))!!}
                    @endif
                    <div class="form-validation">
                        @include('admin.hotels.form', [
                            'hotel' => $hotel,
                            'facilities' => $facilities,
                            'amenities' => $amenities,
                            'medicares' => $medicares,
                            'topServices' => $topServices,
                            'places' => $places,
                            'propertyTypes' => $propertyTypes,
                            'accessibles' => $accessibles,
                            'meetingAndEvents' => $meetingAndEvents,
                            'states' => $states,
                            'occupancies' => $occupancies,
                            'deals' => $deals,
                            'activities' => $activities
                        ])

                    </div> <!-- Form Validation Tag End -->
                </div> <!-- Card Body End -->
            </div> <!-- Card -->
        </div> <!-- 12 Div End -->
    </div> <!-- Row Div End -->
</div> <!-- Container Fluid End -->

    @endsection
    @section('admin_jscript')
    @parent
    <!-- Jquery Validation -->
    <script src="{!! asset('admin-part/vendor/jquery-validation/jquery.validate.min.js') !!}"></script>
    <!-- Form validate init -->
    <script src="{!! asset('admin-part/js/plugins-init/jquery.validate-init.js') !!}"></script>
    <script src="{!! asset('admin-part/vendor/select2/js/select2.full.min.js') !!}"></script>
    <script src="{!! asset('admin-part/js/plugins-init/select2-init.js') !!}"></script>
    @endsection
