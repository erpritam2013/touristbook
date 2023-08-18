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
            <h4 class="card-title">{{$title}}&nbsp;{!!get_fontawesome_icon_html($meeting_and_event->icon,'fa-lg')!!}</h4>
            <div align="right">
            	<a href="{{route('admin.terms.meeting-and-events.edit',$meeting_and_event->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
            	<a href="{{route('admin.terms.meeting-and-events.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
            	
            	  <div class="col-xl-12 ">
                        <div class="card">

                        		<div class="col-md-12">
									<h1>{{$meeting_and_event->name}}</h1>

									<p>{{$meeting_and_event->description}}</p>
                                    <br/>
                                    <p>{{exploreJsonData($meeting_and_event->extra_data ?? '','important_note') ?? ''}}</p>
									<div>
										<span class="badge">Last updated {{get_time_format($meeting_and_event->updated_at,true)}}</span>
										<div class="pull-right">
											<span class="label label-default" style="color:#000;">{{$meeting_and_event->meeting_and_event_type}} Meeting And Event</span>
                                            @php $parent_meeting_and_event = get_parent_term($meeting_and_event,$meeting_and_event->parent_meeting_and_event,true); @endphp
											<span class="label label-primary">{{(!empty($parent_meeting_and_event))?$parent_meeting_and_event:"No Parent"}}</span>
                                            @if($meeting_and_event->status == 1)
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