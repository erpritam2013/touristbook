@extends('admin.layouts.main')
@section('top_service_action', route('admin.terms.top-services.store'))
@section('title',$title)
@section('admin_head_css')
<link rel="stylesheet" href="{!! asset('admin-part/vendor/select2/css/select2.min.css') !!}">
@parent
@endsection
@section('content')


<div class="container-fluid">
  @include('admin.layout-parts.breadcrumbs')
  <div class="row">
     <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$title}}</h4>
                <div align="right">
                    <a href="{{route('admin.terms.top-services.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
                  @if(Session::has('success'))
                {!!get_form_success_msg(Session::get('success'))!!}
                @endif
                <div class="form-validation">
                    <form class="form-valide" id="top-services-form" action="@yield('top_service_action')" method="post">
                        {{ csrf_field() }}
                        @section('method_field')
                        @show
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="name">Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="name" name="name" value="{{$top_service->name ?? ''}}" placeholder="Enter a name..">

                                        {!! get_form_error_msg($errors, 'name') !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="description">Description 
                                    </label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter Description..">{{$top_service->description ?? ''}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="top-service-type">top_service Type
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control" id="top-service-type" name="top_service_type" data-url="{{route('admin.terms.ajaxGetTopService')}}" data-existed_f_type="{{$top_service->top_service_type ?? ''}}">
                                            @if(!empty($post_types))
                                            <option value="">Select Type</option>
                                            @foreach($post_types as $type)
                                            <option value="{{$type}}" {!!get_edit_select_post_types_old_value($type, $top_service->top_service_type ?? "",'select')!!}>{{$type}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        {!! get_form_error_msg($errors, 'top_service_type') !!}

                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="top_service-parent">top_service Parent
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control multi-select" id="top-service-parent" name="parent_top_service" data-existed_parent_top_service="{{$top_service->parent_top_service ?? ''}}">
                                            @isset($top_services)
                                            <option value="">Select top_service Parent</option>
                                            @foreach($top_services as $ts_p)
                                            <option value="{{$ts_p->id}}" {!!get_edit_select_post_types_old_value($ts_p->id, $top_service->parent_top_service ?? "",'select')!!} >{{$ts_p->name}}</option>
                                            @endforeach
                                            @endisset
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="icon">Icon

                                    </label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="icon" name="icon" value="{{$top_service->icon ?? ''}}" placeholder="Enter a icon..">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="status">Status
                                    </label>
                                    <div class="col-lg-10">

                                        <label class="col-form-label">
                                            <input type="radio" name="status" value="1" {!!get_edit_select_check_pvr_old_value('status',$top_service ?? "",'status',1, 'chacked')!!}>&nbsp;Active</label>
                                            <label class="col-form-label">
                                                <input type="radio" name="status" {!!get_edit_select_check_pvr_old_value('status',$top_service ?? "",'status',0, 'chacked')!!} value="0">&nbsp;Inactive</label>
                                            </div>
                                        </div>


                                        <button type="submit" class="btn btn-primary">@isset($top_service->id)Update @else Save @endisset</button>
                                        @if(!isset($top_service->id))
                                        <button type="button" class="btn btn-light" onclick="window.location.replace('{{ url()->previous() }}')">cancel</button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
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