@extends('admin.posts.create')
@section('post_action', route('admin.posts.update',$post->id))
@section('post_form_method')
{{method_field('PUT')}}
<input type="hidden" name="id" data-id="{{$post->id}}" id="post-id" value="{{$post->id}}">
@endsection