@extends('admin.terms.term-activity-lists.create')
@section('term_activity_list_action', route('admin.terms.term-activity-lists.update',$term_activity_list->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id"
 value="{{$term_activity_list->id}}" data-id="{{$term_activity_list->id}}" id="term-id">
@endsection