@extends('admin.activities.create')
@section('tour_action', route('admin.activities.update',$tour->id))
@section('tour_form_method')
{{method_field('PUT')}}
<input type="hidden" name="id" data-id="{{$tour->id}}" id="tour-id" value="{{$tour->id}}">
@endsection