
@extends('admin.locations.create')
@section('location_action', route('admin.locations.update',$location->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id" data-id="{{$location->id}}" id="location-id" value="{{$location->id}}">
@endsection