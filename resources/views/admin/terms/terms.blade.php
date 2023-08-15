
@extends('admin.layouts.main')
@section('title',$title)
@section('admin_head_css')
@parent

@endsection
@section('content')


<div class="container-fluid">
   @include('admin.layouts.breadcrumbs')

      <div class="row">

                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block">
                                    <i class="ti-layout-grid2 {{getIconColorClass()}}"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text"  onclick="window.location.replace('{{route("admin.terms.facilities.index")}}')">Facilities</div>
                                    <div class="stat-digit">{{$facilities}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="stat-icon d-inline-block">
                                    <i class="ti-layout-grid2 {{getIconColorClass()}}"></i>
                                </div>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text" onclick="window.location.replace('{{route("admin.terms.amenities.index")}}')">Amenities</div>
                                    <div class="stat-digit">{{$amenities}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                </div>
  
</div>
@endsection
@section('admin_jscript')

@parent

@endsection