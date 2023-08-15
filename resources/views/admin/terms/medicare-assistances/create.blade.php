@extends('admin.layouts.main')
@section('medicare_assistance_action', route('admin.terms.medicare-assistances.store'))
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
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="description">Description 
                                    </label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter Description..">{{$medicareAssistance->description ?? ''}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="medicare-assistance-type">Medicare Assistance Type
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control" id="medicare-assistance-type" name="medicare_assistance_type" data-url="{{route('admin.terms.ajaxGetMedicareAssistance')}}" data-existed_f_type="{{$medicareAssistance->medicare_assistance_type ?? ''}}">
                                            @if(!empty($post_types))
                                            <option value="">Select Type</option>
                                            @foreach($post_types as $type)
                                            <option value="{{$type}}" {!!get_edit_select_post_types_old_value($type, $medicareAssistance->medicare_assistance_type ?? "",'select')!!}>{{$type}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        {!! get_form_error_msg($errors, 'medicare_assistance_type') !!}

                                    </div>
                                </div>
                            
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="medicare-assistance-parent">Medicare Assistance Parent
                                    </label>
                                    <div class="col-lg-10">
                                        <select class="form-control multi-select" id="medicare-assistance-parent" name="parent_medicare_assistance" data-existed_parent_facitity="{{$medicareAssistance->parent_medicare_assistance ?? ''}}">
                                            @isset($medicare_assistances)
                                            <option value="">Select Medicare Assistance Parent</option>
                                            @foreach($medicare_assistances as $ma_p)
                                            <option value="{{$ma_p->id}}" {!!get_edit_select_post_types_old_value($ma_p->id, $medicareAssistance->parent_medicare_assistance ?? "",'select')!!} >{{$ma_p->name}}</option>
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
       /* When input medicare-assistance type */
            var preloader = $('body div#preloader');
            $('body').on('input', '#medicare-assistance-type', function () {
              var userURL = $(this).data('url');

              
              var medicare_assistance_type = $(this).children('option:selected').val();
              var existed_parent_facitity = $('#medicare-assistance-parent').data('existed_parent_facitity');
              var medicare_assistance_id = $("#medicare-assistance-id").data('id');
              var data = {medicare_assistance_type};
              if (typeof medicare_assistance_id != "undefined") {
               data = {medicare_assistance_type,'id':medicare_assistance_id};
           }
            preloader.css({'z-index': 1});
            preloader.show();
            var medicare_assistance_parent = $('#medicare-assistance-parent');
            medicare_assistance_parent.after(preloader);
           $.get(userURL,{medicare_assistance_type,'id':medicare_assistance_id},function (data) {
            $options = "";
            if (data.length != 0) {
                preloader.css({'z-index': 0});
                preloader.hide();
             medicare_assistance_parent.find('option').remove();
             medicare_assistance_parent.append(new Option('Select Medicare Assistance Parent', ""));
             $.each(data.data,function(index,value){
                optionText = value.name;
                optionValue = value.id;
               
                if (typeof existed_parent_facitity != "undefined" && optionValue === parseInt(existed_parent_facitity)) {
                    medicare_assistance_parent.append(new Option(optionText, optionValue,true, true));
                }else{

                medicare_assistance_parent.append(new Option(optionText, optionValue));
                }
            });
         }else{
            alert('something went wrong!');
         }
            //$(medicare-assistance_type).append(medicare-assistance_type);
     });
           $('.multi-select').select2();
       });

        });

    </script>
    @endsection