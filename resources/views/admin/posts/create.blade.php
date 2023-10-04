@extends('admin.layouts.main')
@section('room_action', route('admin.rooms.store'))
@section('room_form_method', method_field('POST'))
@section('title',$title)
@section('content')
<div class="container-fluid">
  @include('admin.layout-parts.breadcrumbs')
    <div class="row">
        <div class="col-lg-12">
            <div class="card main-card">
                <div class="card-header">
                    <h4 class="card-title">{{$title}}</h4>
                    <div align="right">
                        <a href="{{route('admin.rooms.index')}}" class="btn btn-dark"><i class="fa fa-arrow-right"></i> Back</a>
                    </div>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                    {!!get_form_success_msg(Session::get('success'))!!}
                    @endif
                    <div class="form-validation">
                     
                        @include('admin.rooms.form', [
                            'room' => $room,
                            'facilities' => $facilities,
                            'types' => $types,
                            'hotels' => $hotels,
                        ])

                    </div> <!-- Form Validation Tag End -->
                </div> <!-- Card Body End -->
            </div> <!-- Card -->
        </div> <!-- 12 Div End -->
    </div> <!-- Row Div End -->
</div> <!-- Container Fluid End -->
@endsection
