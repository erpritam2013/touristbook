@extends('admin.terms.categories.create')
@section('category_action', route('admin.terms.categories.update',$category->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id"
 value="{{$category->id}}" data-id="{{$category->id}}" id="term-id">
@endsection