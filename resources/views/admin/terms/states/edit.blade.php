@extends('admin.terms.states.create')
@section('state_action', route('admin.terms.states.update',$state->id))
@section('method_field')
{{method_field('PUT')}}
@endsection