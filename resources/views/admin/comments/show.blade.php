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
            <h4 class="card-title">{{$title}}&nbsp;{!!get_fontawesome_icon_html($comment->icon,'fa-lg')!!}</h4>
            <div align="right">
            	<a href="javascript:void(0);" class="btn btn-danger del_entity_form btn-xs" title="Delete" item_id="'.$comment->id.'" data-text="place"><i class="fa fa-trash"></i></a>
            	<a href="{{route('admin.comments.index')}}" class="btn btn-dark btn-xs"><i class="fa fa-arrow-right"></i> Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
            	
            	  <div class="col-xl-12 ">
                        <div class="card">

                        		<div class="col-md-12">
									<h1>{{$comment->name}}</h1>

									@if(!empty($comment->comments))<div class="extra-data"><p>{{$comment->comments}}</p></div>@endif
									<div>
										<span class="badge">Last updated {{get_time_format($comment->updated_at,true)}}</span>
										<div class="pull-right">
											<span class="label label-default">{{$comment->model_type}} Comment</span>
                                            @php $parent_id = get_parent_term($comment,$comment->parent_id,true); @endphp
											<span class="label label-primary">{{(!empty($parent_id))?$parent_id:"No Parent"}}</span>
										</div>         
										</div>
										<hr>
                        </div>
                    </div>
            </div>
                </div>
                <form id='delete_entity_form' method="POST" action="{{route('admin.comments.index')}}" style="display: none">
          {{ csrf_field() }}

          {{method_field('DELETE')}}

      </form>
            </div>
        </div>
    </div>

</div>
@endsection
@section('admin_jscript')
@parent

@endsection