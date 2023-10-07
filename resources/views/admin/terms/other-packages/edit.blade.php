@extends('admin.terms.other-packages.create')
@section('other_package_action', route('admin.terms.other-packages.update',$other_package->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id"
 value="{{$other_package->id}}" data-id="{{$other_package->id}}" id="term-id">
@endsection