@extends('admin.layouts.main')
@section('title',$title)
@section('content')
<div class="container-fluid">
   @include('admin.layout-parts.breadcrumbs')
   <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$title}}</h4>
                <div align="right"class="all-a">
                    @if($categories)<a href="javascript:void(0);" class="btn btn-outline-danger bulk-delete btn-xs" style="display: none;">Bulk Delete</a>
                    <form id='bulk_delete_entity_form' method="POST" action="{{route('admin.terms.categories.bulk-delete')}}" style="display: none" data-text="category">
                      {{ csrf_field() }}
                      <input type="hidden" name="ids" id="ids" >

                      {{method_field('DELETE')}}

                  </form>@endif
                  <a href="{{route('admin.terms.categories.create')}}" class="btn btn-outline-primary btn-xs">Add New Category</a>
              </div>
          </div>

          <div class="card-body category_list entity-list">
            @if(Session::has('success'))
            {!!get_form_success_msg(Session::get('success'))!!}
            @endif
            
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
        <form id='delete_entity_form' method="POST" action="{{route('admin.terms.categories.index')}}" style="display: none">
          {{ csrf_field() }}

          {{method_field('DELETE')}}

      </form>  
  </div>
</div>
</div>

</div>
@endsection
