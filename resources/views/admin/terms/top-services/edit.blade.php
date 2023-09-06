@extends('admin.terms.top-services.create')
@section('top_service_action', route('admin.terms.top-services.update',$top_service->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id"
 value="{{$top_service->id}}" data-id="{{$top_service->id}}" id="top-service-id">
@endsection