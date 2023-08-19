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
            <h4 class="card-title">{{$title}}&nbsp;{!!get_fontawesome_icon_html($state->icon,'fa-lg')!!}</h4>
            <div align="right">
            	<a href="{{route('admin.terms.states.edit',$state->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
            	<a href="{{route('admin.terms.states.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
            	
            	  <div class="col-xl-12 ">
                        <div class="card">

                        		<div class="col-md-12">
									<h1>{{$state->name}}</h1>

									@if(!empty($state->description))<div class="extra-data"><p>{{$state->description}}</p></div>@endif
                                    @if(!empty(exploreJsonData($state->extra_data,'important_note')))<h6>Important Note :</h6>

                                    <div class="extra-data"><p>{{exploreJsonData($state->extra_data,'important_note')}}</p></div>@endif
                                    @if(!empty(exploreJsonData($state->extra_data,'sanstive_data')))<h6>Sanstive Data :</h6>

                                    <div class="extra-data"><p>{!!exploreJsonData($state->extra_data ?? '','sanstive_data') ?? '' !!}</p></div>@endif
                                    @if(!empty(exploreJsonData($state->extra_data,'helpful_facts')))<h6>Helpful Facts :</h6>

                                    <div class="extra-data"><p>{{exploreJsonData($state->extra_data ?? '','helpful_facts') ?? ''}}</p></div>@endif
									<div>
										<span class="badge">Last updated {{get_time_format($state->updated_at,true)}}</span>
										<div class="pull-right">
											<span class="label label-default">{{$state->state_type}} state</span>
                                            @php $parent_state = get_parent_term($state,$state->parent_state,true); @endphp
											<span class="label label-primary">{{(!empty($parent_state))?$parent_state:"No Parent"}}</span>
                                            @if($state->status == 1)
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