@extends('admin.terms.occupancies.create')
@section('occupancy_action', route('admin.terms.occupancies.update',$occupancy->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id"
 value="{{$occupancy->id}}" data-id="{{$occupancy->id}}" id="term-id">
@endsection