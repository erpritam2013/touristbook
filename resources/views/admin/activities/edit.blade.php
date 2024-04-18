@extends('admin.activities.create')
@section('activity_action', route('admin.activities.update',$activity->id))
@section('activity_form_method')
{{method_field('PUT')}}
<input type="hidden" name="id" data-id="{{$activity->id}}" id="activity-id" value="{{$activity->id}}">
@endsection
@if(auth()->check())
@if(auth()->user()->isAdmin() || auth()->user()->isEditor())
@section('get_a_link')
{!!get_a_link($title,route('activity',$activity->slug),'view')!!}
@endsection
@endif 
@endif