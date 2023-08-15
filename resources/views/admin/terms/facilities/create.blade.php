@extends('admin.layouts.main')
@section('facility_action', route('admin.terms.facilities.store'))
@section('title',$title)
@section('admin_head_css')
<link rel="stylesheet" href="{!! asset('admin-part/vendor/select2/css/select2.min.css') !!}">
@parent
@endsection
@section('content')


<div class="container-fluid">
  @include('admin.layouts.breadcrumbs')
  <div class="row">
     <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$title}}</h4>
                <div align="right">
                    <a href="{{route('admin.terms.facilities.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
                  @if(Session::has('success'))
                {!!get_form_success_msg(Session::get('success'))!!}
                @endif
                <div class="form-validation">
                    <form class="form-valide" id="facility-form" action="@yield('facility_action')" method="post">
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
                                        <input type="text" class="form-control" id="name" name="name" value="{{$facility->name ?? ''}}" placeholder="Enter a name..">

                                        {!! get_form_error_msg($errors, 'name') !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="description">Description 
                                    </label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter Description..">{{$facility->description ?? ''}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="facility-type">Facility Type
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control" id="facility-type" name="facility_type" data-url="{{route('admin.terms.ajaxGet')}}" data-existed_f_type="{{$facility->facility_type ?? ''}}">
                                            @if(!empty($post_types))
                                            <option value="">Select Type</option>
                                            @foreach($post_types as $type)
                                            <option value="{{$type}}" {!!get_edit_select_post_types_old_value($type, $facility->facility_type ?? "",'select')!!}>{{$type}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        {!! get_form_error_msg($errors, 'facility_type') !!}

                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="facility-parent">Facility Parent
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control multi-select" id="facility-parent" name="parent_facility" data-existed_parent_facitity="{{$facility->parent_facility ?? ''}}">
                                            @isset($facilities)
                                            <option value="">Select Facility Parent</option>
                                            @foreach($facilities as $fac_p)
                                            <option value="{{$fac_p->id}}" {!!get_edit_select_post_types_old_value($fac_p->id, $facility->parent_facility ?? "",'select')!!} >{{$fac_p->name}}</option>
                                            @endforeach
                                            @endisset
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="icon">Icon

                                    </label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="icon" name="icon" value="{{$facility->icon ?? ''}}" placeholder="Enter a icon..">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="status">Status
                                    </label>
                                    <div class="col-lg-10">

                                        <label class="col-form-label">
                                            <input type="radio" name="status" value="1" {!!get_edit_select_check_pvr_old_value('status',$facility ?? "",'status',1, 'chacked')!!}>&nbsp;Active</label>
                                            <label class="col-form-label">
                                                <input type="radio" name="status" {!!get_edit_select_check_pvr_old_value('status',$facility ?? "",'status',0, 'chacked')!!} value="0">&nbsp;Inactive</label>
                                            </div>
                                        </div>


                                        <button type="submit" class="btn btn-primary">@isset($facility->id)Update @else Save @endisset</button>
                                        @if(!isset($facility->id))
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
    @section('admin_jscript')
    @parent
    <!-- Jquery Validation -->
    <script src="{!! asset('admin-part/vendor/jquery-validation/jquery.validate.min.js') !!}"></script>
    <!-- Form validate init -->
    <script src="{!! asset('admin-part/js/plugins-init/jquery.validate-init.js') !!}"></script>
    <script src="{!! asset('admin-part/vendor/select2/js/select2.full.min.js') !!}"></script>
    <script src="{!! asset('admin-part/js/plugins-init/select2-init.js') !!}"></script>

    <script type="text/javascript">

        $(document).ready(function () {
     // $('#icon').iconpicker();
       /* When input facility type */
            var preloader = $('body div#preloader');
            $('body').on('input', '#facility-type', function () {
              var userURL = $(this).data('url');

              
              var facility_type = $(this).children('option:selected').val();
              var existed_parent_facitity = $('#facility-parent').data('existed_parent_facitity');
              var facility_id = $("#facility-id").data('id');
              var data = {facility_type};
              if (typeof facility_id != "undefined") {
               data = {facility_type,'id':facility_id};
           }
            preloader.css({'z-index': 1});
            preloader.show();
            var facility_parent = $('#facility-parent');
            facility_parent.after(preloader);
           $.get(userURL,{facility_type,'id':facility_id},function (data) {
            $options = "";
            if (data.length != 0) {
                preloader.css({'z-index': 0});
                preloader.hide();
             facility_parent.find('option').remove();
             facility_parent.append(new Option('Select Facility Parent', ""));
             $.each(data.data,function(index,value){
                optionText = value.name;
                optionValue = value.id;
               
                if (typeof existed_parent_facitity != "undefined" && optionValue === parseInt(existed_parent_facitity)) {
                    facility_parent.append(new Option(optionText, optionValue,true, true));
                }else{

                facility_parent.append(new Option(optionText, optionValue));
                }
            });
         }else{
            alert('something went wrong!');
         }
            //$(facility_type).append(facility_type);
     });
           $('.multi-select').select2();
       });

        });

    </script>
    @endsection