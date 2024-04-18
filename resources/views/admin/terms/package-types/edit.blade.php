@extends('admin.terms.package-types.create')
@section('package_type_action', route('admin.terms.package-types.update',$package_type->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id"
 value="{{$package_type->id}}" data-id="{{$package_type->id}}" id="term-id">
@endsection