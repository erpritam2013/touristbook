@extends('admin.terms.accessibles.create')
@section('accessible_action', route('admin.terms.accessibles.update',$accessible->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id" data-id="{{$accessible->id}}" id="accessible-id" value="{{$accessible->id}}">
@endsection