@extends('admin.layouts.main')
@section('term_activity_list_action', route('admin.terms.term-activity-lists.store'))
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
                <a href="{{route('admin.terms.term-activity-lists.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
            </div>
        </div>
        <div class="card-body">
          @if(Session::has('success'))
          {!!get_form_success_msg(Session::get('success'))!!}
          @endif
          <div class="form-validation">
            <form class="form-valide" id="term_activity_list-form" action="@yield('term_activity_list_action')" method="post">
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
                                <input type="text" class="form-control" id="name" name="name" value="{{$term_activity_list->name ?? ''}}" placeholder="Enter a name..">

                                {!! get_form_error_msg($errors, 'name') !!}
                            </div>
                        </div>
                        @isset($term_activity_list->slug)
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="slug">Slug
                            </label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="slug" name="slug" value="{{$term_activity_list->slug ?? ''}}" placeholder="Enter a slug..">
                            </div>
                        </div>
                        @endisset
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="description">Description 
                            </label>
                            <div class="col-lg-10">
                                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter Description..">{{$term_activity_list->description ?? ''}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="icon">Icon

                            </label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control icp icp-auto" id="icon" name="icon" value="{{$term_activity_list->icon ?? ''}}" placeholder="Enter a icon..">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="parent">Term Activity List Parent
                            </label>
                            <div class="col-lg-10">
                                <select class="form-control single-select-placeholder-touristbook" id="parent" name="parent">
                                    @isset($term_activity_list_parent)
                                    <option value="">Select Term Activity List Parent</option>
                                    @foreach($term_activity_list_parent as $parent)
                                    <option value="{{$parent}}" {!!get_edit_select_post_types_old_value($parent, $term_activity_list->parent ?? "",'select')!!} >{{customStringReplaceWithStrCase('-'," ",$parent,'ucwords')}}</option>
                                    @endforeach
                                    @endisset
                                </select>

                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="status">Status
                            </label>
                            <div class="col-lg-10  {{setCheckboxActiveInactiveStyle(null,null,null,null, 'chacked','active-inactive')}}">

                                <label class="col-form-label {{setCheckboxActiveInactiveStyle('status', $term_activity_list ?? "",'status',1, 'chacked','active')}}">
                                    <input type="radio" name="status" value="1" {!!get_edit_select_check_pvr_old_value('status', $term_activity_list ?? "",'status',1, 'chacked')!!}>&nbsp;Active
                                </label>
                                <label class="col-form-label {{setCheckboxActiveInactiveStyle('status', $term_activity_list ?? "",'status',0, 'chacked','inactive')}}">
                                    <input type="radio" name="status" {!!get_edit_select_check_pvr_old_value('status', $term_activity_list ?? "",'status',0, 'chacked')!!} value="0">&nbsp;Inactive
                                </label>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary">@isset($term_activity_list->id)Update @else Save @endisset</button>
                        @if(!isset($term_activity_list->id))
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