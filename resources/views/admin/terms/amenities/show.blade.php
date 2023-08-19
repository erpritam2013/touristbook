@extends('admin.layouts.main')
@section('title',$title)
@section('admin_head_css')
@parent
@endsection
@section('content')


<div class="container-fluid">
  @include('admin.layout-parts.breadcrumbs')
<div class="row">
   <div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{$title}}&nbsp;{!!get_fontawesome_icon_html($amenity->icon,'fa-lg')!!}</h4>
            <div align="right">
            	<a href="{{route('admin.terms.amenities.edit',$amenity->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
            	<a href="{{route('admin.terms.amenities.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
            	
            	  <div class="col-xl-12 ">
                        <div class="card">

                        		<div class="col-md-12">
									<h1>{{$amenity->name}}</h1>

									@if(!empty($amenity->description))<div class="extra-data"><p>{{$amenity->description}}</p></div>@endif
									<div>
										<span class="badge">Last updated {{get_time_format($amenity->updated_at,true)}}</span>
										<div class="pull-right">
											<span class="label label-default" style="color:#000;">{{$amenity->amenity_type}} Amenity</span>
                                            @php $parent_amenity = get_parent_term($amenity,$amenity->parent_amenity,true); @endphp
											<span class="label label-primary">{{(!empty($parent_amenity))?$parent_amenity:"No Parent"}}</span>
                                            @if($amenity->status == 1)
											<span class="label label-success">Active</span> 
											@else
											<span class="label label-danger">Inactive</span>
											@endif
										</div>         
										</div>
										<hr>
                        </div>
                    </div>
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