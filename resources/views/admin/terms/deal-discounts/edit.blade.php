@extends('admin.terms.deal-discounts.create')
@section('deal_discount_action', route('admin.terms.deal-discounts.update',$deal_discount->id))
@section('method_field')
{{method_field('PUT')}}
<input type="hidden" name="id"
 value="{{$deal_discount->id}}" data-id="{{$deal_discount->id}}" id="term-id">
@endsection