@extends('admin.country-zones.create')
@section('country_zone_action', route('admin.country-zones.update',$country_zone->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id" data-id="{{$country_zone->id}}" id="country_zone-id" value="{{$country_zone->id}}">
@endsection