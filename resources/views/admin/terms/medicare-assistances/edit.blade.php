@extends('admin.terms.medicare-assistances.create')
@section('medicare_assistance_action', route('admin.terms.medicare-assistances.update',$medicareAssistance->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id"
 value="{{$medicareAssistance->id}}" data-id="{{$medicareAssistance->id}}" id="term-id">
@endsection