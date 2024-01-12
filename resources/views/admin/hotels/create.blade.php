@extends('admin.layouts.main')
@section('hotel_action', route('admin.hotels.store'))
@section('hotel_form_method', method_field('POST'))
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
