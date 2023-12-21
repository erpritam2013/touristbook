@extends('admin.layouts.main')
@section('conversion_action', route('admin.conversions.store'))
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
                <a href="{{route('admin.conversions.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
            </div>
        </div>
        <div class="card-body">
          @if(Session::has('success'))
          {!!get_form_success_msg(Session::get('success'))!!}
          @endif
          <div class="form-validation">
            <form class="form-valide" id="facility-form" action="@yield('conversion_action')" method="post">
                {{ csrf_field() }}
                @section('method_field')
                @show
                <div class="row">
                    <div class="col-xl-12">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="currency_name">Currency Name
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10">
                                <select class="form-control single-select-placeholder-touristbook" id="currency_name" name="currency_name">
                                    <option value="">--Select--</option>
                                    @foreach($currencyList as $currencyKey=>$currencyName)
                                        <option value="{{$currencyKey}}" @if(old('currency_name', $conversion->currency_name ?? '') == $currencyKey) selected @endif >{{$currencyName}}</option>
                                    @endforeach
                                </select>

                                {!! get_form_error_msg($errors, 'currency_name') !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="country_code">Country
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10">
                                <select class="form-control single-select-placeholder-touristbook" id="country_code" name="country_code">
                                    <option value="">--Select--</option>
                                    @foreach($countryCodes as $countryCode)
                                        <option value="{{$countryCode->code}}" @if(old('country_code', $conversion->country_code ?? '') == $countryCode->code) selected @endif >{{$countryCode->countryname}}</option>
                                    @endforeach
                                </select>

                                {!! get_form_error_msg($errors, 'currency_code') !!}
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="conversion_rate">Conversion Rate
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10">
                                <input type="number" class="form-control" id="conversion_rate" name="conversion_rate" value="{{old('conversion_rate', $conversion->conversion_rate ?? '0')}}" >

                                {!! get_form_error_msg($errors, 'conversion_rate') !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="currency_symbol">Currency Symbol
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="currency_symbol" name="currency_symbol" value="{{old('currency_symbol', $conversion->currency_symbol ?? '')}}" >

                                {!! get_form_error_msg($errors, 'currency_symbol') !!}
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="status">Status
                            </label>
                            <div class="col-lg-10  {{setCheckboxActiveInactiveStyle(null,null,null,null, 'chacked','active-inactive')}}">

                                <label class="col-form-label {{setCheckboxActiveInactiveStyle('status', $conversion ?? "",'status',1, 'chacked','active')}}">
                                    <input type="radio" name="status" value="1" {!!get_edit_select_check_pvr_old_value('status', $conversion ?? "",'status',1, 'chacked')!!}>&nbsp;Active
                                </label>
                                <label class="col-form-label {{setCheckboxActiveInactiveStyle('status', $conversion ?? "",'status',0, 'chacked','inactive')}}">
                                    <input type="radio" name="status" {!!get_edit_select_check_pvr_old_value('status', $conversion ?? "",'status',0, 'chacked')!!} value="0">&nbsp;Inactive
                                </label>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="is_rtl">Is RTL</label>
                            <div class="col-lg-10">
                                <input type="checkbox" class="form-input" id="is_rtl" name="is_rtl" @if(old('is_rtl', $conversion->is_rtl ?? '0') == '1') checked @endif />

                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary">@isset($conversion->id)Update @else Save @endisset</button>
                        @if(!isset($conversion->id))
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
