@extends('admin.layouts.main')
@section('state_action', route('admin.terms.states.store'))
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
                    <a href="{{route('admin.terms.states.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
              @if(Session::has('success'))
              {!!get_form_success_msg(Session::get('success'))!!}
              @endif
              <div class="form-validation">
                <form class="form-valide" id="state-form" action="@yield('state_action')" method="post">
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
                                    <input type="text" class="form-control" id="name" name="name" value="{{$state->name ?? ''}}" placeholder="Enter a name..">

                                    {!! get_form_error_msg($errors, 'name') !!}
                                </div>
                            </div>
                            @isset($state->slug)
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="slug">Slug
                                </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="slug" name="slug" value="{{$state->slug ?? ''}}" placeholder="Enter a slug..">
                                </div>
                            </div>
                            @endisset
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="description">Description
                                </label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter Description..">{{$state->description ?? ''}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="icon">Icon

                                </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control icp icp-auto" id="icon" name="icon" value="{{$state->icon ?? ''}}" placeholder="Enter a icon..">
                                </div>
                            </div>

                            {{--<div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="parent-id">state Parent
                                </label>
                                <div class="col-lg-10">
                                    <select class="form-control single-select-placeholder-touristbook" id="parent-id" name="parent_id" data-existed_parent_facitity="{{$state->parent_id ?? ''}}">
                                        @isset($states)
                                        <option value="">Select State Parent</option>
                                        @foreach($states as $s_p)
                                        <option value="{{$s_p->id}}" {!!get_edit_select_post_types_old_value($s_p->id, $state->parent_id ?? "",'select')!!} >{{$s_p->name}}</option>
                                        @endforeach
                                        @endisset
                                    </select>

                                </div>
                            </div>--}}

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="country">Country
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-10">
                                    <select class="form-control multi-select" id="country" name="country" >
                                        @isset($countries)
                                        <option value="">Select Country</option>
                                        @foreach($countries as $country)
                                        <option value="{{$country->code}}" {!!get_edit_select_post_types_old_value($country->code, $state->country ?? "",'select')!!} >{{$country->countryname}}</option>
                                        @endforeach
                                        @endisset
                                    </select>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="important-note">Important Note
                                </label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" id="important-note" name="extra_data[important_note]" rows="5" placeholder="Enter Important Note..">{{exploreJsonData($state->extra_data ?? '','important_note') ?? ''}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="sanstive-data">Sanstive Data
                                </label>
                                <div class="col-lg-10">
                                    <textarea class="form-control ckeditor" id="sanstive-data" name="extra_data[sanstive_data]" rows="8" placeholder="Enter Sanstive Data..">{!!exploreJsonData($state->extra_data ?? '','sanstive_data') ?? '' !!}</textarea>


                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="helpful-facts">Helpful Facts
                                </label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" id="helpful-facts" name="extra_data[helpful_facts]" rows="5" placeholder="Enter Helpful Facts..">{{exploreJsonData($state->extra_data ?? '','helpful_facts') ?? ''}}</textarea>


                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="status">Status
                                </label>
                                <div class="col-lg-10  {{setCheckboxActiveInactiveStyle(null,null,null,null, 'chacked','active-inactive')}}">

                                    <label class="col-form-label {{setCheckboxActiveInactiveStyle('status', $state ?? "",'status',1, 'chacked','active')}}">
                                        <input type="radio" name="status" value="1" {!!get_edit_select_check_pvr_old_value('status', $state ?? "",'status',1, 'chacked')!!}>&nbsp;Active
                                    </label>
                                    <label class="col-form-label {{setCheckboxActiveInactiveStyle('status', $state ?? "",'status',0, 'chacked','inactive')}}">
                                        <input type="radio" name="status" {!!get_edit_select_check_pvr_old_value('status', $state ?? "",'status',0, 'chacked')!!} value="0">&nbsp;Inactive
                                    </label>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary">@isset($state->id)Update @else Save @endisset</button>
                            @if(!isset($state->id))
                            <button type="button" class="btn btn-light" onclick="window.location.replace('{{ url()->previous() }}')">cencel</button>
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
