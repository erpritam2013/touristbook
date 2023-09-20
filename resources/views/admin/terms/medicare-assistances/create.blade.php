@extends('admin.layouts.main')
@section('medicare_assistance_action', route('admin.terms.medicare-assistances.store'))
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
                    <a href="{{route('admin.terms.medicare-assistances.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
                  @if(Session::has('success'))
                {!!get_form_success_msg(Session::get('success'))!!}
                @endif
                <div class="form-validation">
                    <form class="form-valide" id="medicare-assistance-form" action="@yield('medicare_assistance_action')" method="post">
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
                                        <input type="text" class="form-control" id="name" name="name" value="{{$medicareAssistance->name ?? ''}}" placeholder="Enter a name..">

                                        {!! get_form_error_msg($errors, 'name') !!}
                                    </div>
                                </div>
                                 @isset($medicareAssistance->slug)
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="slug">Slug
                                    </label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="slug" name="slug" value="{{$medicareAssistance->slug ?? ''}}" placeholder="Enter a slug..">
                                    </div>
                                </div>
                                @endisset
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="description">Description 
                                    </label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter Description..">{{$medicareAssistance->description ?? ''}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="term-type">Medicare Assistance Type
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control single-select-placeholder-touristbook" id="term-type" name="medicare_assistance_type" data-url="{{route('admin.terms.ajaxGetMedicareAssistance')}}" data-term_title="Medicare Assistance">
                                            <option value="">Select Type</option>
                                            @if(!empty($post_types))
                                            @foreach($post_types as $type)
                                            <option value="{{$type}}" {!!get_edit_select_post_types_old_value($type, $medicareAssistance->medicare_assistance_type ?? "",'select')!!}>{{$type}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        {!! get_form_error_msg($errors, 'medicare_assistance_type') !!}

                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="parent-id">Medicare Assistance Parent
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control single-select-placeholder-touristbook" id="parent-id" name="parent_id" data-existed_parent_facitity="{{$medicareAssistance->parent_id ?? ''}}">
                                            <option value="">Select Medicare Assistance Parent</option>
                                            @isset($medicare_assistances)
                                            @foreach($medicare_assistances as $ma_p)
                                            <option value="{{$ma_p->id}}" {!!get_edit_select_post_types_old_value($ma_p->id, $medicareAssistance->parent_id ?? "",'select')!!} >{{$ma_p->name}}</option>
                                            @endforeach
                                            @endisset
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="icon">Icon

                                    </label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="icon" name="icon" value="{{$medicareAssistance->icon ?? ''}}" placeholder="Enter a icon..">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="status">Status
                                    </label>
                                    <div class="col-lg-10">

                                        <label class="col-form-label">
                                            <input type="radio" name="status" value="1" {!!get_edit_select_check_pvr_old_value('status',$medicareAssistance ?? "",'status',1, 'chacked')!!}>&nbsp;Active</label>
                                            <label class="col-form-label">
                                                <input type="radio" name="status" {!!get_edit_select_check_pvr_old_value('status',$medicareAssistance ?? "",'status',0, 'chacked')!!} value="0">&nbsp;Inactive</label>
                                            </div>
                                        </div>


                                        <button type="submit" class="btn btn-primary">@isset($medicareAssistance->id)Update @else Save @endisset</button>
                                        @if(!isset($medicareAssistance->id))
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
