@extends('admin.layouts.main')
@section('title',$title)
@section('content')
<div class="container-fluid">
 @include('admin.layout-parts.breadcrumbs')
 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$title}} ({{$locations}})</h4>
                <div align="right" class="all-a">
                    @if($locations)<a href="javascript:void(0);" class="btn btn-outline-danger bulk-delete btn-xs" style="display: none;">Bulk Delete</a>
                    <form id='bulk_delete_entity_form' method="POST" action="{{route('admin.location.bulk-delete')}}" style="display: none" data-text="location">
                      {{ csrf_field() }}
                      <input type="hidden" name="ids" id="ids" >

                      {{method_field('DELETE')}}

                  </form>@endif
                   <a href="{{ route('admin.location.trashed') }}" class="btn btn-danger btn-xs {{($trashed == 0)?'disabled':''}}">
                    <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Trash ({{ $trashed }})
                </a>
                  <a href="{{route('admin.locations.create')}}" class="btn btn-outline-primary btn-xs">Add New Location</a>
                   @if(isset(request()->user) && !empty(request()->user))
                  <a href="{{route('admin.locations.index')}}" class="btn btn-dark btn-xs"><i class="fa fa-arrow-right"></i> Back</a>
                  @endif
              </div>
          </div>

          <div class="card-body location_list entity-list">
            @if(Session::has('success'))
            {!!get_form_success_msg(Session::get('success'))!!}
            @endif
            @if(Session::has('error'))
            {!!print_error_message(Session::get('error'))!!}
            @endif
            <div class="table-responsive">
             {{ $dataTable->table() }}
         </div>
     </div>
     <form id='delete_entity_form' method="POST" action="{{route('admin.locations.index')}}" style="display: none">
      {{ csrf_field() }}

      {{method_field('DELETE')}}

  </form>  
</div>
</div>
</div>

</div>
@endsection
