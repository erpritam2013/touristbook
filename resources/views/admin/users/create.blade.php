@extends('admin.layouts.main')
@section('user_action', route('admin.users.store'))
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
                <a href="{{route('admin.users.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
            </div>
        </div>
        <div class="card-body">
          @if(Session::has('success'))
          {!!get_form_success_msg(Session::get('success'))!!}
          @endif
          <div class="form-validation">
            <form class="form-valide" id="facility-form" action="@yield('user_action')" method="post">
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
                                <input type="text" class="form-control" id="name" name="name" value="{{old('name', $user->name ?? '')}}" placeholder="Enter a name..">

                                {!! get_form_error_msg($errors, 'name') !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="email">Email
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10">
                                <input type="email" class="form-control" id="email" name="email" value="{{old('email', $user->email ?? '')}}" placeholder="Enter an Email.">

                                {!! get_form_error_msg($errors, 'email') !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="password">Password
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10">
                                <input type="password" class="form-control" id="password" name="password" value="" >

                                {!! get_form_error_msg($errors, 'password') !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="user-type">User Role
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10">
                                <select class="form-control single-select-placeholder-touristbook" id="user-type" name="role">
                                    <option value="">Select Role</option>
                                    <option value="editor" @if(old('role', $user->role ?? '') == 'editor') selected @endif>Editor</option>
                                    <option value="admin"  @if(old('role', $user->role ?? '') == 'admin') selected @endif>Admin</option>
                                    <option value="subscriber"  @if(old('role', $user->role ?? '') == 'subscriber') selected @endif>Subscriber</option>
                                </select>
                                {!! get_form_error_msg($errors, 'role') !!}

                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="is_active">Status
                            </label>
                            <div class="col-lg-10  {{setCheckboxActiveInactiveStyle(null,null,null,null, 'chacked','active-inactive')}}">

                                <label class="col-form-label {{setCheckboxActiveInactiveStyle('is_active', $user ?? "",'is_active',1, 'chacked','active')}}">
                                    <input type="radio" name="is_active" value="1" {!!get_edit_select_check_pvr_old_value('status', $user ?? "",'is_active',1, 'chacked')!!}>&nbsp;Active
                                </label>
                                <label class="col-form-label {{setCheckboxActiveInactiveStyle('is_active', $user ?? "",'is_active',0, 'chacked','inactive')}}">
                                    <input type="radio" name="is_active" {!!get_edit_select_check_pvr_old_value('is_active', $user ?? "",'is_active',0, 'chacked')!!} value="0">&nbsp;Inactive
                                </label>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary">@isset($user->id)Update @else Save @endisset</button>
                        @if(!isset($user->id))
                        <button type="button" class="btn btn-light" onclick="window.location.replace('{{ url()->previous() }}')">Cancel</button>
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
