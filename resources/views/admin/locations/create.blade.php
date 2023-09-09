@extends('admin.layouts.main')
@section('location_action', route('admin.locations.store'))
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
            <div class="card main-card">
                <div class="card-header">
                    <h4 class="card-title">{{$title}}</h4>
                    <div align="right">
                        <a href="{{route('admin.locations.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
                    </div>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                    {!!get_form_success_msg(Session::get('success'))!!}
                    @endif
                    <div class="form-validation">
                        <form class="form-valide" id="location-form" action="@yield('location_action')" method="post">
                            {{ csrf_field() }}
                            @section('method_field')
                            @show
                            <div class="row">
                                <div class="col-xl-8">
                                    @include('admin.locations.partials.basic-card', ['location'=>$location ?? null])

                                    @include('admin.locations.partials.location-settings', ['location'=>$location ?? null])

                                    @include('admin.locations.partials.extra-notes', ['location'=>$location ?? null])
                                    
                                </div>
                                <div class="col-xl-4">
                                    @include('admin.locations.partials.publish-card', ['location'=>$location ?? null])

                                    @include('admin.partials.cards.types', ['types'=> $types , 'selected'=>[]])

                                    @include('admin.partials.cards.places', ['places'=> $places , 'selected'=>[]])

                                    @include('admin.partials.cards.states', ['states'=> $states , 'selected'=>$location->state_id ?? null])

                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary">@isset($location->id)Update @else Save @endisset</button>
                            @if(!isset($location->id))
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