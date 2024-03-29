@extends('admin.layouts.main')
@section('title',$title)
@section('content')
<div class="container-fluid">
 @include('admin.layout-parts.breadcrumbs')
 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$title}} ({{$tourism_zones}})</h4>
                <div align="right" class="all-a">
                    @if($tourism_zones)<a href="javascript:void(0);" class="btn btn-outline-danger bulk-delete btn-xs" style="display: none;">Bulk Delete</a>
                    <form id='bulk_delete_entity_form' method="POST" action="{{route('admin.tourism-zones.bulk-delete')}}" style="display: none" data-text="tourism zone">
                      {{ csrf_field() }}
                      <input type="hidden" name="ids" id="ids" >

                      {{method_field('DELETE')}}

                  </form>@endif
                   <a href="{{ route('admin.tourism-zone.trashed') }}" class="btn btn-danger btn-xs {{($trashed == 0)?'disabled':''}}">
                    <i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Trash ({{ $trashed }})
                    </a>
                  <a href="{{route('admin.tourism-zones.create')}}" class="btn btn-outline-primary btn-xs">Add New Tourism Zone</a>
                   @if(isset(request()->user) && !empty(request()->user))
                  <a href="{{route('admin.tourism-zones.index')}}" class="btn btn-dark btn-xs"><i class="fa fa-arrow-right"></i> Back</a>
                  @endif
              </div>
          </div>

          <div class="card-body tourism_zone_list entity-list">
            @if(Session::has('success'))
            {!!get_form_success_msg(Session::get('success'))!!}
            @endif
            
            <div class="table-responsive">
             {{ $dataTable->table() }}
         </div>
     </div>
     <form id='delete_entity_form' method="POST" action="{{route('admin.tourism-zones.index')}}" style="display: none">
      {{ csrf_field() }}

      {{method_field('DELETE')}}

  </form>  
</div>
</div>
</div>

</div>
@endsection
