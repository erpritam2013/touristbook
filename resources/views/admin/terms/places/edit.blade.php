@extends('admin.terms.places.create')
@section('place_action', route('admin.terms.places.update',$place->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" data-id="{{$place->id}}" id="term-id">
@endsection