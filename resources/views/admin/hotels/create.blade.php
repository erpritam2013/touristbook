@extends('admin.layouts.main')
@section('hotel_action', route('admin.hotels.store'))
@section('title',$title)
@section('admin_head_css')
<link rel="stylesheet" href="{!! asset('admin-part/vendor/select2/css/select2.min.css') !!}">
@parent
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
                        <a href="{{route('admin.hotels.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
                    </div>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                    {!!get_form_success_msg(Session::get('success'))!!}
                    @endif
                    <div class="form-validation">
                        <form class="form-valide" id="hotel-form" action="@yield('hotel_action')" method="post">
                            {{ csrf_field() }}
                            @section('method_field')
                            @show
                            <div class="row">
                                <div class="col-xl-8">
                                    @include('admin.hotels.partials.basic-card', ['hotel'=>$hotel ?? null])

                                    @include('admin.hotels.partials.hotel-info-card', ['hotel'=>$hotel ?? null])
                                </div>
                                <div class="col-xl-4">
                                    @include('admin.hotels.partials.publish-card', ['hotel'=>$hotel ?? null])

                                    @include('admin.partials.cards.facilities', ['facilities'=> $facilities , 'selected'=>[]])

                                    @include('admin.partials.cards.amenities', ['amenities'=> $amenities , 'selected'=>[]])

                                    @include('admin.partials.cards.medicares', ['medicares'=> $medicares , 'selected'=>[]])

                                    @include('admin.partials.cards.top-services', ['topServices'=> $topServices , 'selected'=>[]])

                                    @include('admin.partials.cards.places', ['places'=> $places , 'selected'=>[]])
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary">@isset($hotel->id)Update @else Save @endisset</button>
                            @if(!isset($hotel->id))
                            <button type="button" class="btn btn-light" onclick="window.location.replace('{{ url()->previous() }}')">Cancel</button>
                            @endif

                        </form> <!-- Form End -->
                    </div> <!-- Form Validation Tag End -->
                </div> <!-- Card Body End -->
            </div> <!-- Card -->
        </div> <!-- 12 Div End -->
    </div> <!-- Row Div End -->
</div> <!-- Container Fluid End -->

    @endsection
    @section('admin_jscript')
    @parent
    <!-- Jquery Validation -->
    <script src="{!! asset('admin-part/vendor/jquery-validation/jquery.validate.min.js') !!}"></script>
    <!-- Form validate init -->
    <script src="{!! asset('admin-part/js/plugins-init/jquery.validate-init.js') !!}"></script>
    <script src="{!! asset('admin-part/vendor/select2/js/select2.full.min.js') !!}"></script>
    <script src="{!! asset('admin-part/js/plugins-init/select2-init.js') !!}"></script>
    @endsection