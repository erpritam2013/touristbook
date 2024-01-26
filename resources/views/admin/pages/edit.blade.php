@extends('admin.pages.create')
@section('page_action', route('admin.pages.update',$page->id))
@section('page_form_method')
{{method_field('PUT')}}
<input type="hidden" name="id" data-id="{{$page->id}}" id="page-id" value="{{$page->id}}">
@endsection
