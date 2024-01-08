@extends('admin.layouts.main')
@section('accessible_action', route('admin.terms.accessibles.store'))
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
                <a href="{{route('admin.terms.accessibles.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
            </div>
        </div>
        <div class="card-body">
          @if(Session::has('success'))
          {!!get_form_success_msg(Session::get('success'))!!}
          @endif
          <div class="form-validation">
            <form class="form-valide" id="accessible-form" action="@yield('accessible_action')" method="post">
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
                                <input type="text" class="form-control" id="name" name="name" value="{!!$accessible->name ?? ''!!}" placeholder="Enter a name..">

                                {!! get_form_error_msg($errors, 'name') !!}
                            </div>
                        </div>
                        @isset($accessible->slug)
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="slug">Slug
                            </label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="slug" name="slug" value="{{$accessible->slug ?? ''}}" placeholder="Enter a slug..">
                            </div>
                        </div>
                        @endisset
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="description">Description 
                            </label>
                            <div class="col-lg-10">
                                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter Description..">{{$accessible->description ?? ''}}</textarea>
                            </div>
                        </div>

                          <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="icon">Icon

                            </label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control icp icp-auto" id="icon" name="icon" value="{!!$accessible->icon ?? 'fas fa-cog'!!}" placeholder="Enter a icon.." >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="term-type">accessible Type
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10">
                                <select class="form-control single-select-placeholder-touristbook" id="term-type" name="accessible_type" data-url="{{route('admin.terms.ajaxGetAccessible')}}" data-existed_f_type="{{$accessible->accessible_type ?? ''}}" data-term_title="Accessible">
                                    @if(!empty($post_types))
                                    <option value="">Select Type</option>
                                    @foreach($post_types as $type)
                                    <option value="{{$type}}" {!!get_edit_select_post_types_old_value($type, $accessible->accessible_type ?? "",'select')!!}>{{$type}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                {!! get_form_error_msg($errors, 'accessible_type') !!}

                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="parent-id">Accessible Parent
                            </label>
                            <div class="col-lg-10">
                                <select class="form-control single-select-placeholder-touristbook" id="parent-id" name="parent_id" data-existed_parent_id="{{$accessible->parent_id ?? ''}}">
                                    <option value="">Select accessible Parent</option>
                                    @isset($accessibles)
                                    @foreach($accessibles as $accessible_p)
                                    <option value="{{$accessible_p->id}}" {!!get_edit_select_post_types_old_value($accessible_p->id, $accessible->parent_id ?? "",'select')!!} >{{$accessible_p->name}}</option>
                                    @endforeach
                                    @endisset
                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="status">Status
                            </label>
                            <div class="col-lg-10  {{setCheckboxActiveInactiveStyle(null,null,null,null, 'chacked','active-inactive')}}">

                                <label class="col-form-label {{setCheckboxActiveInactiveStyle('status', $accessible ?? "",'status',1, 'chacked','active')}}">
                                    <input type="radio" name="status" value="1" {!!get_edit_select_check_pvr_old_value('status', $accessible ?? "",'status',1, 'chacked')!!}>&nbsp;Active
                                </label>
                                <label class="col-form-label {{setCheckboxActiveInactiveStyle('status', $accessible ?? "",'status',0, 'chacked','inactive')}}">
                                    <input type="radio" name="status" {!!get_edit_select_check_pvr_old_value('status', $accessible ?? "",'status',0, 'chacked')!!} value="0">&nbsp;Inactive
                                </label>
                            </div>
                        </div>
                        


                        <button type="submit" class="btn btn-primary">@isset($accessible->id)Update @else Save @endisset</button>
                        @if(!isset($accessible->id))
                        <button type="button" class="btn btn-light" onclick="window.location.reaccessible('{{ url()->previous() }}')">cencel</button>
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
