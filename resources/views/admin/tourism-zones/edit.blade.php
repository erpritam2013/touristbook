@extends('admin.tourism-zones.create')
@section('tourism_zone_action', route('admin.tourism-zones.update',$tourism_zone->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id" data-id="{{$tourism_zone->id}}" id="tourism_zone-id" value="{{$tourism_zone->id}}">
@endsection