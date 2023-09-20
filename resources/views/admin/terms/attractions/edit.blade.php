@extends('admin.terms.attractions.create')
@section('attraction_action', route('admin.terms.attractions.update',$attraction->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id" data-id="{{$attraction->id}}" id="attraction-id" value="{{$attraction->id}}">
@endsection