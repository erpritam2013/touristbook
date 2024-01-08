@extends('admin.layouts.main')
@section('type_action', route('admin.terms.types.store'))
@section('title',$title)
@section('content')


<div class="container-fluid">
  @include('admin.layout-parts.breadcrumbs')
  <div class="row">
     <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$title}}</h4>
                <div align="right">
                    <a href="{{route('admin.terms.types.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
              @if(Session::has('success'))
              {!!get_form_success_msg(Session::get('success'))!!}
              @endif
              <div class="form-validation">
                <form class="form-valide" id="type-form" action="@yield('type_action')" method="post">
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
                                    <input type="text" class="form-control" id="name" name="name" value="{!!$type->name ?? ''!!}" placeholder="Enter a name..">

                                    {!! get_form_error_msg($errors, 'name') !!}
                                </div>
                            </div>
                            @isset($type->slug)
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="slug">Slug
                                </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="slug" name="slug" value="{{$type->slug ?? ''}}" placeholder="Enter a slug..">
                                </div>
                            </div>
                            @endisset
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="description">Description 
                                </label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter Description..">{{$type->description ?? ''}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row icon d-none">
                                <label class="col-lg-2 col-form-label" for="icon">Icon

                                </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control icp icp-auto" id="icon"value="{{$type->icon ?? ''}}" placeholder="Enter a icon.." data-existed_value="{{$type->icon ?? ''}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="term-type">Type
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-10">
                                    <select class="form-control single-select-placeholder-touristbook" id="term-type" name="type" data-url="{{route('admin.terms.ajaxGetType')}}" data-term_title="Type">
                                        <option value="">Select Type</option>
                                        @if(!empty($post_types))
                                        @foreach($post_types as $p_type)
                                        <option value="{{$p_type}}" {!!get_edit_select_post_types_old_value($p_type, $type->type ?? "",'select')!!}>{{$p_type}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    {!! get_form_error_msg($errors, 'type') !!}

                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="parent-id">Type Parent
                                </label>
                                <div class="col-lg-10">
                                    <select class="form-control single-select-placeholder-touristbook" id="parent-id" name="parent_id" data-existed_parent_id="{{$type->parent_id ?? ''}}">
                                        <option value="">Select Type Parent</option>
                                        @isset($types)
                                        @foreach($types as $type_p)
                                        <option value="{{$type_p->id}}" {!!get_edit_select_post_types_old_value($type_p->id, $type->parent_id ?? "",'select')!!} >{{$type_p->name}}</option>
                                        @endforeach
                                        @endisset
                                    </select>

                                </div>
                            </div>

                            <div class="form-group row attachment d-none">
                                <label class="col-lg-2 col-form-label" for="attachment">Attachment
                                </label>
                                <div class="col-lg-10">

                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="get_image"  value="{{$type->attachment ?? ''}}" accept="image/jpeg" data-existed_value="{{$type->attachment ?? ''}}">
                                            <label class="custom-file-label">Choose Attachment</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    <img id="show_image" src="{{asset('admin-part\images\t-b-logo.png')}}" alt="your image" width="120" />
                                </div>
                            </div>
                            <div class="form-group row lebal-type d-none">
                                <label class="col-lg-2 col-form-label" for="lebal-type">Lebal Type
                                </label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="lebal-type" data-existed_value="{{$type->lebal_type ?? ''}}">
                                        @if(!empty($lebal_types))
                                        <option value="">Select Lebal Type</option>
                                        @foreach($lebal_types as $l_type)
                                        <option value="{{$l_type}}" {!!get_edit_select_post_types_old_value($l_type, $type->lebal_type ?? "",'select')!!}>{{ucwords($l_type)}}</option>
                                        @endforeach
                                        @endif
                                    </select>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="status">Status
                                </label>
                                <div class="col-lg-10  {{setCheckboxActiveInactiveStyle(null,null,null,null, 'chacked','active-inactive')}}">

                                    <label class="col-form-label {{setCheckboxActiveInactiveStyle('status', $type ?? "",'status',1, 'chacked','active')}}">
                                        <input type="radio" name="status" value="1" {!!get_edit_select_check_pvr_old_value('status', $type ?? "",'status',1, 'chacked')!!}>&nbsp;Active
                                    </label>
                                    <label class="col-form-label {{setCheckboxActiveInactiveStyle('status', $type ?? "",'status',0, 'chacked','inactive')}}">
                                        <input type="radio" name="status" {!!get_edit_select_check_pvr_old_value('status', $type ?? "",'status',0, 'chacked')!!} value="0">&nbsp;Inactive
                                    </label>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary">@isset($type->id)Update @else Save @endisset</button>
                            @if(!isset($type->id))
                            <button type="button" class="btn btn-light" onclick="window.location.retype('{{ url()->previous() }}')">cencel</button>
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