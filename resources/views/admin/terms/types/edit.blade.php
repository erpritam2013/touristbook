@extends('admin.terms.types.create')
@section('type_action', route('admin.terms.types.update',$type->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id"
 value="{{$type->id}}" data-id="{{$type->id}}" id="term-id">
@endsection