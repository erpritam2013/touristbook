@extends('admin.layouts.main')
@section('category_action', route('admin.terms.categories.store'))
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
                <a href="{{route('admin.terms.categories.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
            </div>
        </div>
        <div class="card-body">
          @if(Session::has('success'))
          {!!get_form_success_msg(Session::get('success'))!!}
          @endif
          <div class="form-validation">
            <form class="form-valide" id="category-form" action="@yield('category_action')" method="post">
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
                                <input type="text" class="form-control" id="name" name="name" value="{{$category->name ?? ''}}" placeholder="Enter a name..">

                                {!! get_form_error_msg($errors, 'name') !!}
                            </div>
                        </div>
                        @isset($category->slug)
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="slug">Slug
                            </label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="slug" name="slug" value="{{$category->slug ?? ''}}" placeholder="Enter a slug..">
                            </div>
                        </div>
                        @endisset
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="description">Description 
                            </label>
                            <div class="col-lg-10">
                                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter Description..">{{$category->description ?? ''}}</textarea>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="icon">Icon

                            </label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control icp icp-auto" id="icon" name="icon" value="{{$category->icon ?? ''}}" placeholder="Enter a icon..">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="term-type">Category Type
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10">
                                <select class="form-control single-select-placeholder-touristbook" id="term-type" name="category_type" data-url="{{route('admin.terms.ajaxGetCategory')}}" data-term_title="category">
                                    @if(!empty($post_types))
                                    <option value="">Select Type</option>
                                    @foreach($post_types as $type)
                                    <option value="{{$type}}" {!!get_edit_select_post_types_old_value($type, $category->category_type ?? "",'select')!!}>{{$type}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                {!! get_form_error_msg($errors, 'category_type') !!}

                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="parent-id">category Parent
                            </label>
                            <div class="col-lg-10">
                                <select class="form-control single-select-placeholder-touristbook" id="parent-id" name="parent_id" data-existed_parent_id="{{$category->parent_id ?? ''}}">
                                    <option value="">Select Category Parent</option>
                                    @isset($categories)
                                    @foreach($categories as $cat_p)
                                    <option value="{{$cat_p->id}}" {!!get_edit_select_post_types_old_value($cat_p->id, $category->parent_id ?? "",'select')!!} >{{$cat_p->name}}</option>
                                    @endforeach
                                    @endisset
                                </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="status">Status
                            </label>
                            <div class="col-lg-10  {{setCheckboxActiveInactiveStyle(null,null,null,null, 'chacked','active-inactive')}}">

                                <label class="col-form-label {{setCheckboxActiveInactiveStyle('status', $category ?? "",'status',1, 'chacked','active')}}">
                                    <input type="radio" name="status" value="1" {!!get_edit_select_check_pvr_old_value('status', $category ?? "",'status',1, 'chacked')!!}>&nbsp;Active
                                </label>
                                <label class="col-form-label {{setCheckboxActiveInactiveStyle('status', $category ?? "",'status',0, 'chacked','inactive')}}">
                                    <input type="radio" name="status" {!!get_edit_select_check_pvr_old_value('status', $category ?? "",'status',0, 'chacked')!!} value="0">&nbsp;Inactive
                                </label>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary">@isset($category->id)Update @else Save @endisset</button>
                        @if(!isset($category->id))
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