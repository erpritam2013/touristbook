@extends('admin.activity-lists.create')
@section('activity_list_action', route('admin.activity-lists.update',$activity_list->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id" data-id="{{$activity_list->id}}" id="activity_list-id" value="{{$activity_list->id}}">
@endsection