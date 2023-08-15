@extends('admin.layouts.main')
@section('amenity_action', route('admin.terms.amenities.store'))
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
                    <a href="{{route('admin.terms.amenities.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
                  @if(Session::has('success'))
                {!!get_form_success_msg(Session::get('success'))!!}
                @endif
                <div class="form-validation">
                    <form class="form-valide" id="amenity-form" action="@yield('amenity_action')" method="post">
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
                                        <input type="text" class="form-control" id="name" name="name" value="{{$amenity->name ?? ''}}" placeholder="Enter a name..">

                                        {!! get_form_error_msg($errors, 'name') !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="description">Description 
                                    </label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter Description..">{{$amenity->description ?? ''}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="amenity-type">Amenity Type
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control" id="amenity-type" name="amenity_type" data-url="{{route('admin.terms.ajaxGet')}}" data-existed_f_type="{{$amenity->amenity_type ?? ''}}">
                                            @if(!empty($post_types))
                                            <option value="">Select Type</option>
                                            @foreach($post_types as $type)
                                            <option value="{{$type}}" {!!get_edit_select_post_types_old_value($type, $amenity->amenity_type ?? "",'select')!!}>{{$type}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        {!! get_form_error_msg($errors, 'amenity_type') !!}

                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="amenity-parent">Amenity Parent
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control multi-select" id="amenity-parent" name="parent_amenity" data-existed_parent_amenity="{{$amenity->parent_amenity ?? ''}}">
                                            @isset($amenities)
                                            <option value="">Select Amenity Parent</option>
                                            @foreach($amenities as $ame_p)
                                            <option value="{{$ame_p->id}}" {!!get_edit_select_post_types_old_value($ame_p->id, $amenity->parent_amenity ?? "",'select')!!} >{{$ame_p->name}}</option>
                                            @endforeach
                                            @endisset
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="icon">Icon

                                    </label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="icon" name="icon" value="{{$amenity->icon ?? ''}}" placeholder="Enter a icon..">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="status">Status
                                    </label>
                                    <div class="col-lg-10">

                                        <label class="col-form-label">
                                            <input type="radio" name="status" value="1" {!!get_edit_select_check_pvr_old_value('status',$amenity ?? "",'status',1, 'chacked')!!}>&nbsp;Active</label>
                                            <label class="col-form-label">
                                                <input type="radio" name="status" {!!get_edit_select_check_pvr_old_value('status',$amenity ?? "",'status',0, 'chacked')!!} value="0">&nbsp;Inactive</label>
                                            </div>
                                        </div>


                                        <button type="submit" class="btn btn-primary">@isset($amenity->id)Update @else Save @endisset</button>
                                        @if(!isset($amenity->id))
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
       /* When input amenity type */
            var preloader = $('body div#preloader');
            $('body').on('input', '#amenity-type', function () {
              var userURL = $(this).data('url');

              
              var amenity_type = $(this).children('option:selected').val();
              var existed_parent_amenity = $('#amenity-parent').data('existed_parent_amenity');
              var amenity_id = $("#amenity-id").data('id');
              var data = {amenity_type};
              if (typeof amenity_id != "undefined") {
               data = {amenity_type,'id':amenity_id};
           }
            preloader.css({'z-index': 1});
            preloader.show();
            var amenity_parent = $('#amenity-parent');
            amenity_parent.after(preloader);
           $.get(userURL,{amenity_type,'id':amenity_id},function (data) {
            $options = "";
            if (data.length != 0) {
                preloader.css({'z-index': 0});
                preloader.hide();
             amenity_parent.find('option').remove();
             amenity_parent.append(new Option('Select amenity Parent', ""));
             $.each(data.data,function(index,value){
                optionText = value.name;
                optionValue = value.id;
               
                if (typeof existed_parent_amenity != "undefined" && optionValue === parseInt(existed_parent_amenity)) {
                    amenity_parent.append(new Option(optionText, optionValue,true, true));
                }else{

                amenity_parent.append(new Option(optionText, optionValue));
                }
            });
         }else{
            alert('something went wrong!');
         }
            //$(amenity_type).append(amenity_type);
     });
           $('.multi-select').select2();
       });

        });

    </script>
    @endsection