@extends('admin.rooms.create')
@section('room_action', route('admin.rooms.update',$room->id))
@section('room_form_method')
{{method_field('PUT')}}
<input type="hidden" name="id" data-id="{{$room->id}}" id="room-id" value="{{$room->id}}">
@endsection