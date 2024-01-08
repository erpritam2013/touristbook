@extends('admin.layouts.main')
@section('package_type_action', route('admin.terms.package-types.store'))
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
                    <a href="{{route('admin.terms.package-types.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
              @if(Session::has('success'))
              {!!get_form_success_msg(Session::get('success'))!!}
              @endif
              <div class="form-validation">
                <form class="form-valide" id="package-type-form" action="@yield('package_type_action')" method="post">
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
                                    <input type="text" class="form-control" id="name" name="name" value="{!!$package_type->name ?? ''!!}" placeholder="Enter a name..">

                                    {!! get_form_error_msg($errors, 'name') !!}
                                </div>
                            </div>
                            @isset($package_type->slug)
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="slug">Slug
                                </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="slug" name="slug" value="{{$package_type->slug ?? ''}}" placeholder="Enter a slug..">
                                </div>
                            </div>
                            @endisset
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="description">Description 
                                </label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter Description..">{{$package_type->description ?? ''}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="icon">Icon

                                </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control icp icp-auto" id="icon" name="icon" value="{{$package_type->icon ?? ''}}" placeholder="Enter a icon..">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="term-type">Package Type
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-10">
                                    <select class="form-control single-select-placeholder-touristbook" id="term-type" name="package_type_type" data-url="{{route('admin.terms.ajaxGetPackageType')}}" data-term_title="Package Type">
                                        @if(!empty($post_types))
                                        <option value="">Select Type</option>
                                        @foreach($post_types as $type)
                                        <option value="{{$type}}" {!!get_edit_select_post_types_old_value($type, $package_type->package_type_type ?? "",'select')!!}>{{$type}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    {!! get_form_error_msg($errors, 'package_type_type') !!}

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="parent-id">Package Type Parent
                                </label>
                                <div class="col-lg-10">
                                    <select class="form-control single-select-placeholder-touristbook" id="parent-id" name="parent_id" data-existed_parent_id="{{$package_type->parent_id ?? ''}}">
                                        @isset($package_types)
                                        <option value="">Select Package Type Parent</option>
                                        @foreach($package_types as $package_type_p)
                                        <option value="{{$package_type_p->id}}" {!!get_edit_select_post_types_old_value($package_type_p->id, $package_type->parent_id ?? "",'select')!!} >{{$package_type_p->name}}</option>
                                        @endforeach
                                        @endisset
                                    </select>

                                </div>
                            </div>

                            <!-- Button show -->
                            @include('admin.partials.utils.radio_input', ['name'=> 'button','label'=>'Button','item'=>$package_type ?? '','input' => ["On" => 1,"Off" => 0],'on_off_switch'=>true,'label_class'=>['off-switch','on-switch'],'col'=>true])



                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="important-note">Important Note
                                </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="important-note" name="extra_data[important_note]" value="{{$package_type->extra_data['important_note'] ?? ''}}" placeholder="Enter a important note..">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="status">Status
                                </label>
                                <div class="col-lg-10  {{setCheckboxActiveInactiveStyle(null,null,null,null, 'chacked','active-inactive')}}">

                                    <label class="col-form-label {{setCheckboxActiveInactiveStyle('status', $package_type ?? "",'status',1, 'chacked','active')}}">
                                        <input type="radio" name="status" value="1" {!!get_edit_select_check_pvr_old_value('status', $package_type ?? "",'status',1, 'chacked')!!}>&nbsp;Active
                                    </label>
                                    <label class="col-form-label {{setCheckboxActiveInactiveStyle('status', $package_type ?? "",'status',0, 'chacked','inactive')}}">
                                        <input type="radio" name="status" {!!get_edit_select_check_pvr_old_value('status', $package_type ?? "",'status',0, 'chacked')!!} value="0">&nbsp;Inactive
                                    </label>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary">@isset($package_type->id)Update @else Save @endisset</button>
                            @if(!isset($package_type->id))
                            <button type="button" class="btn btn-light" onclick="window.location.repackage_type('{{ url()->previous() }}')">cencel</button>
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