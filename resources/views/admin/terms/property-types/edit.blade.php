@extends('admin.terms.property-types.create')
@section('property_type_action', route('admin.terms.property-types.update',$property_type->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id"
 value="{{$property_type->id}}" data-id="{{$property_type->id}}" id="term-id">
@endsection