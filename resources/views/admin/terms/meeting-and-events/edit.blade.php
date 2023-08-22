@extends('admin.terms.meeting-and-events.create')
@section('meeting_and_event_action', route('admin.terms.meeting-and-events.update',$meeting_and_event->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" data-id="{{$meeting_and_event->id}}" id="term-id">
@endsection