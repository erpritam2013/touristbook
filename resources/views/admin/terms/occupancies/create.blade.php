@extends('admin.layouts.main')
@section('occupancy_action', route('admin.terms.occupancies.store'))
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
                    <a href="{{route('admin.terms.occupancies.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
                  @if(Session::has('success'))
                {!!get_form_success_msg(Session::get('success'))!!}
                @endif
                <div class="form-validation">
                    <form class="form-valide" id="occupancy-form" action="@yield('occupancy_action')" method="post">
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
                                        <input type="text" class="form-control" id="name" name="name" value="{{$occupancy->name ?? ''}}" placeholder="Enter a name..">

                                        {!! get_form_error_msg($errors, 'name') !!}
                                    </div>
                                </div>
                                 @isset($occupancy->slug)
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="slug">Slug
                                    </label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="slug" name="slug" value="{{$occupancy->slug ?? ''}}" placeholder="Enter a slug..">
                                    </div>
                                </div>
                                @endisset
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="description">Description 
                                    </label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter Description..">{{$occupancy->description ?? ''}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="term-type">occupancy Type
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control single-select-placeholder-touristbook" id="term-type" name="occupancy_type" data-url="{{route('admin.terms.ajaxGetOccupancy')}}" data-term_title="Occupancy">
                                            <option value="">Select Type</option>
                                            @if(!empty($post_types))
                                            @foreach($post_types as $type)
                                            <option value="{{$type}}" {!!get_edit_select_post_types_old_value($type, $occupancy->occupancy_type ?? "",'select')!!}>{{$type}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        {!! get_form_error_msg($errors, 'occupancy_type') !!}

                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="parent-id">Occupancy Parent
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control single-select-placeholder-touristbook" id="parent-id" name="parent_id" data-existed_parent_facitity="{{$occupancy->parent_id ?? ''}}">
                                            <option value="">Select occupancy Parent</option>
                                            @isset($occupancies)
                                            @foreach($occupancies as $fac_p)
                                            <option value="{{$fac_p->id}}" {!!get_edit_select_post_types_old_value($fac_p->id, $occupancy->parent_id ?? "",'select')!!} >{{$fac_p->name}}</option>
                                            @endforeach
                                            @endisset
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="icon">Icon

                                    </label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="icon" name="icon" value="{{$occupancy->icon ?? ''}}" placeholder="Enter a icon..">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="status">Status
                                    </label>
                                    <div class="col-lg-10">

                                        <label class="col-form-label">
                                            <input type="radio" name="status" value="1" {!!get_edit_select_check_pvr_old_value('status',$occupancy ?? "",'status',1, 'chacked')!!}>&nbsp;Active</label>
                                            <label class="col-form-label">
                                                <input type="radio" name="status" {!!get_edit_select_check_pvr_old_value('status',$occupancy ?? "",'status',0, 'chacked')!!} value="0">&nbsp;Inactive</label>
                                            </div>
                                        </div>


                                        <button type="submit" class="btn btn-primary">@isset($occupancy->id)Update @else Save @endisset</button>
                                        @if(!isset($occupancy->id))
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