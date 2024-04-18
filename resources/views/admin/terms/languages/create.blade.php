@extends('admin.layouts.main')
@section('language_action', route('admin.terms.languages.store'))
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
                <a href="{{route('admin.terms.languages.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
            </div>
        </div>
        <div class="card-body">
          @if(Session::has('success'))
          {!!get_form_success_msg(Session::get('success'))!!}
          @endif
          <div class="form-validation">
            <form class="form-valide" id="language-form" action="@yield('language_action')" method="post">
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
                                <input type="text" class="form-control" id="name" name="name" value="{!!$language->name ?? ''!!}" placeholder="Enter a name..">

                                {!! get_form_error_msg($errors, 'name') !!}
                            </div>
                        </div>
                        @isset($language->slug)
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="slug">Slug
                            </label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="slug" name="slug" value="{{$language->slug ?? ''}}" placeholder="Enter a slug..">
                            </div>
                        </div>
                        @endisset
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="description">Description 
                            </label>
                            <div class="col-lg-10">
                                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter Description..">{{$language->description ?? ''}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="icon">Icon

                            </label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control icp icp-auto" id="icon" name="icon" value="{{$language->icon ?? ''}}" placeholder="Enter a icon..">
                            </div>
                        </div>

                        {{--<div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="term-type">language Type
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10">
                                <select class="form-control single-select-placeholder-touristbook" id="term-type" name="language_type" data-url="{{route('admin.terms.ajaxGetlanguage')}}" data-existed_f_type="{{$language->language_type ?? ''}}" data-term_title="Language">
                                    @if(!empty($post_types))
                                    <option value="">Select Type</option>
                                    @foreach($post_types as $type)
                                    <option value="{{$type}}" {!!get_edit_select_post_types_old_value($type, $language->language_type ?? "",'select')!!}>{{$type}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                {!! get_form_error_msg($errors, 'language_type') !!}

                            </div>
                        </div>--}}
                        
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="parent-id">language Parent
                            </label>
                            <div class="col-lg-10">
                                <select class="form-control single-select-placeholder-touristbook" id="parent-id" name="parent_id" data-existed_parent_id="{{$language->parent_id ?? ''}}">
                                    <option value="">Select language Parent</option>
                                    @isset($languages)
                                    @foreach($languages as $language_p)
                                    <option value="{{$language_p->id}}" {!!get_edit_select_post_types_old_value($language_p->id, $language->parent_id ?? "",'select')!!} >{{$language_p->name}}</option>
                                    @endforeach
                                    @endisset
                                </select>

                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="status">Status
                            </label>
                            <div class="col-lg-10  {{setCheckboxActiveInactiveStyle(null,null,null,null, 'chacked','active-inactive')}}">

                                <label class="col-form-label {{setCheckboxActiveInactiveStyle('status', $language ?? "",'status',1, 'chacked','active')}}">
                                    <input type="radio" name="status" value="1" {!!get_edit_select_check_pvr_old_value('status', $language ?? "",'status',1, 'chacked')!!}>&nbsp;Active
                                </label>
                                <label class="col-form-label {{setCheckboxActiveInactiveStyle('status', $language ?? "",'status',0, 'chacked','inactive')}}">
                                    <input type="radio" name="status" {!!get_edit_select_check_pvr_old_value('status', $language ?? "",'status',0, 'chacked')!!} value="0">&nbsp;Inactive
                                </label>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary">@isset($language->id)Update @else Save @endisset</button>
                        @if(!isset($language->id))
                        <button type="button" class="btn btn-light" onclick="window.location.relanguage('{{ url()->previous() }}')">cencel</button>
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
