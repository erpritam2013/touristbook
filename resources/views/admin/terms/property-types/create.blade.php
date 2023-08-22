@extends('admin.layouts.main')
@section('property_type_action', route('admin.terms.property-types.store'))
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
                    <a href="{{route('admin.terms.property-types.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
                  @if(Session::has('success'))
                {!!get_form_success_msg(Session::get('success'))!!}
                @endif
                <div class="form-validation">
                    <form class="form-valide" id="property-type-form" action="@yield('property_type_action')" method="post">
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
                                        <input type="text" class="form-control" id="name" name="name" value="{{$property_type->name ?? ''}}" placeholder="Enter a name..">

                                        {!! get_form_error_msg($errors, 'name') !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="description">Description 
                                    </label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter Description..">{{$property_type->description ?? ''}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="property_type-type">Property Type
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control" id="term-type" name="property_type_type" data-url="{{route('admin.terms.ajaxGetPropertyType')}}" data-term_title="Property Type">
                                            @if(!empty($post_types))
                                            <option value="">Select Type</option>
                                            @foreach($post_types as $type)
                                            <option value="{{$type}}" {!!get_edit_select_post_types_old_value($type, $property_type->property_type_type ?? "",'select')!!}>{{$type}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        {!! get_form_error_msg($errors, 'property_type_type') !!}

                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="parent-id">Property Type Parent
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control multi-select" id="parent-id" name="parent_id" data-existed_parent_id="{{$property_type->parent_id ?? ''}}">
                                            @isset($property_types)
                                            <option value="">Select Property Type Parent</option>
                                            @foreach($property_types as $property_type_p)
                                            <option value="{{$property_type_p->id}}" {!!get_edit_select_post_types_old_value($property_type_p->id, $property_type->parent_id ?? "",'select')!!} >{{$property_type_p->name}}</option>
                                            @endforeach
                                            @endisset
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="icon">Icon

                                    </label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="icon" name="icon" value="{{$property_type->icon ?? ''}}" placeholder="Enter a icon..">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="important-note">Important Note
                                    </label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="important-note" name="extra_data[important_note]" value="{{exploreJsonData($property_type->extra_data ?? '','important_note') ?? ''}}" placeholder="Enter a important note..">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="status">Status
                                    </label>
                                    <div class="col-lg-10">

                                        <label class="col-form-label">
                                            <input type="radio" name="status" value="1" {!!get_edit_select_check_pvr_old_value('status',$property_type ?? "",'status',1, 'chacked')!!}>&nbsp;Active</label>
                                            <label class="col-form-label">
                                                <input type="radio" name="status" {!!get_edit_select_check_pvr_old_value('status',$property_type ?? "",'status',0, 'chacked')!!} value="0">&nbsp;Inactive</label>
                                            </div>
                                        </div>


                                        <button type="submit" class="btn btn-primary">@isset($property_type->id)Update @else Save @endisset</button>
                                        @if(!isset($property_type->id))
                                        <button type="button" class="btn btn-light" onclick="window.location.reproperty_type('{{ url()->previous() }}')">cencel</button>
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