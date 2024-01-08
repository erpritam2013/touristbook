@extends('admin.layouts.main')
@section('country_action', route('admin.terms.countries.store'))
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
                    <a href="{{route('admin.terms.countries.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
                </div>
            </div>
            <div class="card-body">
                  @if(Session::has('success'))
                {!!get_form_success_msg(Session::get('success'))!!}
                @endif
                <div class="form-validation">
                    <form class="form-valide" id="country-form" action="@yield('country_action')" method="post">
                        {{ csrf_field() }}
                        @section('method_field')
                        @show
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="countrycode">Country Code
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="countrycode" name="countrycode" value="{{$country->countrycode ?? ''}}" placeholder="Enter a countrycode..">

                                        {!! get_form_error_msg($errors, 'countrycode') !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="countryname">Country Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="countryname" name="countryname" value="{!!$country->countryname ?? ''!!}" placeholder="Enter a countryname..">

                                        {!! get_form_error_msg($errors, 'countryname') !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label" for="code">Code
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="code" name="code" value="{{$country->code ?? ''}}" placeholder="Enter a code..">

                                        {!! get_form_error_msg($errors, 'code') !!}
                                    </div>
                                </div>


                                        <button type="submit" class="btn btn-primary">@isset($country->id)Update @else Save @endisset</button>
                                        @if(!isset($country->id))
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
