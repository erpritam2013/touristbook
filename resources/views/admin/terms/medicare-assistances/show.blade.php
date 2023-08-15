@extends('admin.layouts.main')
@section('title',$title)
@section('admin_head_css')
@parent
@endsection
@section('content')


<div class="container-fluid">
  @include('admin.layouts.breadcrumbs')
<div class="row">
   <div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{$title}}&nbsp;{!!get_fontawesome_icon_html($medicareAssistance->icon,'fa-lg')!!}</h4>
            <div align="right">
            	<a href="{{route('admin.terms.medicare-assistances.edit',$medicareAssistance->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
            	<a href="{{route('admin.terms.medicare-assistances.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
            	
            	  <div class="col-xl-12 ">
                        <div class="card">

                        		<div class="col-md-12">
									<h1>{{$medicareAssistance->name}}</h1>

									<p>{{$medicareAssistance->description}}</p>
									<div>
										<span class="badge">Last updated {{get_time_format($medicareAssistance->updated_at,true)}}</span>
										<div class="pull-right">
											<span class="label label-default">{{$medicareAssistance->medicare_assistance_type}} Facility</span>
                                            @php $parent_medicare_assistance = get_parent_term($medicareAssistance,$medicareAssistance->parent_medicare_assistance,true); @endphp
											<span class="label label-primary">{{(!empty($parent_medicare_assistance))?$parent_medicare_assistance:"No Parent"}}</span>
                                            @if($medicareAssistance->status == 1)
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