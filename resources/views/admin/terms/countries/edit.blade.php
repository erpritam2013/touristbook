@extends('admin.terms.countries.create')
@section('country_action', route('admin.terms.countries.update',$country->id))
@section('method_field')
{{method_field('PUT')}}
@endsection