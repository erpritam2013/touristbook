@extends('admin.tours.create')
@section('tour_action', route('admin.tours.update',$tour->id))
@section('tour_form_method')
{{method_field('PUT')}}
<input type="hidden" name="id" data-id="{{$tour->id}}" id="tour-id" value="{{$tour->id}}" data-model="{{class_basename(get_class($tour))}}">
@endsection
@if(auth()->check())
@if(auth()->user()->isAdmin() || auth()->user()->isEditor())
@section('get_a_link')
{!!get_a_link($title,route('tour',$tour->slug),'view')!!}
@endsection
@endif 
@endif