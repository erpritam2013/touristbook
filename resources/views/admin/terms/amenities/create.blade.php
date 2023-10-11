@extends('admin.layouts.main')
@section('amenity_action', route('admin.terms.amenities.store'))
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
                <a href="{{route('admin.terms.amenities.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
            </div>
        </div>
        <div class="card-body">
          @if(Session::has('success'))
          {!!get_form_success_msg(Session::get('success'))!!}
          @endif
          <div class="form-validation">
            <form class="form-valide" id="amenity-form" action="@yield('amenity_action')" method="post">
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
                                <input type="text" class="form-control" id="name" name="name" value="{{$amenity->name ?? ''}}" placeholder="Enter a name..">

                                {!! get_form_error_msg($errors, 'name') !!}
                            </div>
                        </div>
                        @isset($amenity->slug)
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="slug">Slug
                            </label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="slug" name="slug" value="{{$amenity->slug ?? ''}}" placeholder="Enter a slug..">
                            </div>
                        </div>
                        @endisset
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="description">Description 
                            </label>
                            <div class="col-lg-10">
                                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter Description..">{{$amenity->description ?? ''}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="icon">Icon

                            </label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control icp icp-auto" id="icon" name="icon" value="{{$amenity->icon ?? ''}}" placeholder="Enter a icon..">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="term-type">Amenity Type
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10">
                                <select class="form-control single-select-placeholder-touristbook" id="term-type" name="amenity_type" data-url="{{route('admin.terms.ajaxGetAmenity')}}" data-term_title="Amenity">
                                    @if(!empty($post_types))
                                    <option value="">Select Type</option>
                                    @foreach($post_types as $type)
                                    <option value="{{$type}}" {!!get_edit_select_post_types_old_value($type, $amenity->amenity_type ?? "",'select')!!}>{{$type}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                {!! get_form_error_msg($errors, 'amenity_type') !!}

                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="parent-id">Amenity Parent
                            </label>
                            <div class="col-lg-10">
                                <select class="form-control single-select-placeholder-touristbook" id="parent-id" name="parent_id" data-existed_parent_id="{{$amenity->parent_id ?? ''}}">
                                    <option value="">Select Amenity Parent</option>
                                    @isset($amenities)
                                    @foreach($amenities as $ame_p)
                                    <option value="{{$ame_p->id}}" {!!get_edit_select_post_types_old_value($ame_p->id, $amenity->parent_id ?? "",'select')!!} >{{$ame_p->name}}</option>
                                    @endforeach
                                    @endisset
                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="status">Status
                            </label>
                            <div class="col-lg-10  {{setCheckboxActiveInactiveStyle(null,null,null,null, 'chacked','active-inactive')}}">

                                <label class="col-form-label {{setCheckboxActiveInactiveStyle('status', $amenity ?? "",'status',1, 'chacked','active')}}">
                                    <input type="radio" name="status" value="1" {!!get_edit_select_check_pvr_old_value('status', $amenity ?? "",'status',1, 'chacked')!!}>&nbsp;Active
                                </label>
                                <label class="col-form-label {{setCheckboxActiveInactiveStyle('status', $amenity ?? "",'status',0, 'chacked','inactive')}}">
                                    <input type="radio" name="status" {!!get_edit_select_check_pvr_old_value('status', $amenity ?? "",'status',0, 'chacked')!!} value="0">&nbsp;Inactive
                                </label>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary">@isset($amenity->id)Update @else Save @endisset</button>
                        @if(!isset($amenity->id))
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