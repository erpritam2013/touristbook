@extends('admin.layouts.main')
@section('other_package_action', route('admin.terms.other-packages.store'))
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
                    <a href="{{route('admin.terms.other-packages.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
              @if(Session::has('success'))
              {!!get_form_success_msg(Session::get('success'))!!}
              @endif
              <div class="form-validation">
                <form class="form-valide" id="package-type-form" action="@yield('other_package_action')" method="post">
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
                                    <input type="text" class="form-control" id="name" name="name" value="{{$other_package->name ?? ''}}" placeholder="Enter a name..">

                                    {!! get_form_error_msg($errors, 'name') !!}
                                </div>
                            </div>
                            @isset($other_package->slug)
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="slug">Slug
                                </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="slug" name="slug" value="{{$other_package->slug ?? ''}}" placeholder="Enter a slug..">
                                </div>
                            </div>
                            @endisset
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="description">Description 
                                </label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter Description..">{{$other_package->description ?? ''}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="icon">Icon

                                </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control icp icp-auto" id="icon" name="icon" value="{{$other_package->icon ?? ''}}" placeholder="Enter a icon..">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="term-type">Package Type
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-10">
                                    <select class="form-control single-select-placeholder-touristbook" id="term-type" name="other_package_type" data-url="{{route('admin.terms.ajaxGetPackageType')}}" data-term_title="Package Type">
                                        @if(!empty($post_types))
                                        <option value="">Select Type</option>
                                        @foreach($post_types as $type)
                                        <option value="{{$type}}" {!!get_edit_select_post_types_old_value($type, $other_package->other_package_type ?? "",'select')!!}>{{$type}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    {!! get_form_error_msg($errors, 'other_package_type') !!}

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="parent-id">Package Type Parent
                                </label>
                                <div class="col-lg-10">
                                    <select class="form-control single-select-placeholder-touristbook" id="parent-id" name="parent_id" data-existed_parent_id="{{$other_package->parent_id ?? ''}}">
                                        @isset($other_packages)
                                        <option value="">Select Package Type Parent</option>
                                        @foreach($other_packages as $other_package_p)
                                        <option value="{{$other_package_p->id}}" {!!get_edit_select_post_types_old_value($other_package_p->id, $other_package->parent_id ?? "",'select')!!} >{{$other_package_p->name}}</option>
                                        @endforeach
                                        @endisset
                                    </select>

                                </div>
                            </div>

                            <!-- Button show -->
                            @include('admin.partials.utils.radio_input', ['name'=> 'button','label'=>'Button','item'=>$other_package ?? '','input' => ["On" => 1,"Off" => 0],'on_off_switch'=>true,'label_class'=>['off-switch','on-switch'],'col'=>true])

                           
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="country">Country
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-10">
                                    <select class="form-control multi-select" id="country" name="country" >
                                        @isset($countries)
                                        <option value="">Select Country</option>
                                        @foreach($countries as $country)
                                        <option value="{{$country->code}}" {!!get_edit_select_post_types_old_value($country->code, $other_package->country ?? "",'select')!!} >{{$country->countryname}}</option>
                                        @endforeach
                                        @endisset
                                    </select>

                                </div>
                            </div>



                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="important-note">Important Note
                                </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="important-note" name="extra_data[important_note]" value="{{$other_package->extra_data['important_note'] ?? ''}}" placeholder="Enter a important note..">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label" for="status">Status
                                </label>
                                <div class="col-lg-10  {{setCheckboxActiveInactiveStyle(null,null,null,null, 'chacked','active-inactive')}}">

                                    <label class="col-form-label {{setCheckboxActiveInactiveStyle('status', $other_package ?? "",'status',1, 'chacked','active')}}">
                                        <input type="radio" name="status" value="1" {!!get_edit_select_check_pvr_old_value('status', $other_package ?? "",'status',1, 'chacked')!!}>&nbsp;Active
                                    </label>
                                    <label class="col-form-label {{setCheckboxActiveInactiveStyle('status', $other_package ?? "",'status',0, 'chacked','inactive')}}">
                                        <input type="radio" name="status" {!!get_edit_select_check_pvr_old_value('status', $other_package ?? "",'status',0, 'chacked')!!} value="0">&nbsp;Inactive
                                    </label>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary">@isset($other_package->id)Update @else Save @endisset</button>
                            @if(!isset($other_package->id))
                            <button type="button" class="btn btn-light" onclick="window.location.reother_package('{{ url()->previous() }}')">cencel</button>
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