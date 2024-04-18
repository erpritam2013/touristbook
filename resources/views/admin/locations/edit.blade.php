
@extends('admin.locations.create')
@section('location_action', route('admin.locations.update',$location->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id" data-id="{{$location->id}}" id="location-id" value="{{$location->id}}">
@endsection
@if(auth()->check())
@if(auth()->user()->isAdmin() || auth()->user()->isEditor())
@section('get_a_link')
{!!get_a_link($title,route('location',$location->slug),'view')!!}
@endsection
@endif 
@endif