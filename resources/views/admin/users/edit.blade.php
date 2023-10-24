@extends('admin.users.create')
@section('user_action', route('admin.users.update',$user->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id"
 value="{{$user->id}}" data-id="{{$user->id}}" id="term-id">
@endsection
