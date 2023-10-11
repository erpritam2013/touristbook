@extends('admin.terms.tags.create')
@section('tag_action', route('admin.terms.tags.update',$tag->id))
@section('method_field')
{{method_field('PUT')}}
@endsection