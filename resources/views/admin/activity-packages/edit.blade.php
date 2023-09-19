@extends('admin.activity-packages.create')
@section('activity_package_action', route('admin.activity-packages.update',$activity_package->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id" data-id="{{$activity_package->id}}" id="activity_package-id" value="{{$activity_package->id}}">
@endsection