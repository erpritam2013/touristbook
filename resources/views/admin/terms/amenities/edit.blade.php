@extends('admin.terms.amenities.create')
@section('amenity_action', route('admin.terms.amenities.update',$amenity->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id"
 value="{{$amenity->id}}" data-id="{{$amenity->id}}" id="term-id">
@endsection