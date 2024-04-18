@extends('admin.terms.languages.create')
@section('language_action', route('admin.terms.languages.update',$language->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id" data-id="{{$language->id}}" id="language-id" value="{{$language->id}}">
@endsection