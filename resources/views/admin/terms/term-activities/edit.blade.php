@extends('admin.terms.term-activities.create')
@section('term_activity_action', route('admin.terms.term-activities.update',$term_activity->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" data-id="{{$term_activity->id}}" id="term-id">
@endsection