@extends('admin.activity-zones.create')
@section('activity_zone_action', route('admin.activity-zones.update',$activity_zone->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id" data-id="{{$activity_zone->id}}" id="activity_zone-id" value="{{$activity_zone->id}}">
@endsection