@extends('admin.layouts.main')
@section('user_action', route('admin.users.userAsgin'))
@section('title',$title)
@section('admin_head_css')
@parent
<link rel="stylesheet" href="{!! asset('admin-part/vendor/select2/css/select2.min.css') !!}">
@endsection
@section('content')
<div class="container-fluid">
  @include('admin.layout-parts.breadcrumbs')
  <div class="row">
     <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$title}}</h4>
                <div align="right">
                    <a href="{{route('admin.users.index')}}" class="btn btn-dark btn-xs"><i class="fa fa-arrow-right"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
              @if(Session::has('success'))
              {!!get_form_success_msg(Session::get('success'))!!}
              @endif
              <div class="form-validation">
                <form class="form-valide" id="userAsgin-form" action="@yield('user_action')" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="{{$user_id}}">
                    <input type="hidden" name="user_delete" value="false" id="user-delete">
                    @section('method_field')
                    @show
                    <div class="row">
                        <div class="col-xl-12">
                         <div class="form-group row">
                           <div class="col-lg-12 table-responsive-sm">
                            <table class="table table-lg table-bordered table-striped" id="touristbook-datatable">
                                <tr>
                                    <th>S.No.</th>
                                    <th>Module Name</th>
                                    @if($asign_only)
                                    <th><input type="checkbox" class="css-control-input mr-2 select-all text-center" onchange="CustomSelectCheckboxAll(this);"> all Select Module</th>
                                    @endif
                                </tr>
                                @if(count($check_user_id_used))
                               
                                @foreach($check_user_id_used as $key =>$used_data)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{ucwords(str_replace('_',' ',$used_data))}}</td>
                                     @if($asign_only)
                                    <td>
                                          <input type="checkbox" class="css-control-input mr-2 select-id" name="tables[]" onchange="CustomSelectCheckboxSingle(this);" value="{{$used_data}}" id="tables"> Select Module
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                                @endif
                            </table>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label" for="admin">Editor's & Admin's
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-10">
                            <select class="form-control single-select-placeholder-touristbook" id="admin" name="admin">
                                <option value="">Select Editor & Admin</option>
                                @if($users)
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}} ({{$user->email}}) ({{$user->role}})</option>
                                @endforeach
                                @endif
                            </select>
                            {!! get_form_error_msg($errors, 'admin') !!}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary submit-data">Submit</button>
                    <button type="button" class="btn btn-light" onclick="window.location.replace('{{ route("admin.users.index") }}')">Cancel</button>

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
 <script src="{!! asset('admin-part/vendor/select2/js/select2.full.min.js') !!}"></script>
        <script src="{!! asset('admin-part/js/plugins-init/select2-init.js') !!}"></script>
 <!-- Jquery Validation -->
        <script src="{!! asset('admin-part/vendor/jquery-validation/jquery.validate.min.js') !!}"></script>
<script type="text/javascript">

    jQuery('.submit-data').on('click',function(e){
        e.preventDefault();
        if (confirm('Ok : Asgin Data And Delete User\nCancel : only Asgin Data to Anther Admin')) {
            $('#user-delete').val('true');    
        }else{
            $('#user-delete').val('false');  
        }
        $('#userAsgin-form').submit();
    })
    jQuery(".form-valide").validate({
        rules: {
          "tables[]": {
            required: !0
        },
          "admin": {
            required: !0
        }
    },
    messages: {
        "tables[]": {
            required: "Please select a any module!",
        },
        "admin": {
            required: "Please select a admin!",
        },
    },
       ignore: [],
    errorClass: "invalid-feedback animated fadeInUp",
    errorElement: "div",
    errorPlacement: function(e, a) {    
        jQuery(a).parents(".form-group > div").append(e)       
    },
    highlight: function(e) {
        jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
    },
    success: function(e) {
        jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
    },
});
</script>
@endsection