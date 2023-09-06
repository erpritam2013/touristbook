@extends('admin.terms.facilities.create')
@section('facility_action', route('admin.terms.facilities.update',$facility->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id"
 value="{{$facility->id}}" data-id="{{$facility->id}}" id="term-id">
@endsection