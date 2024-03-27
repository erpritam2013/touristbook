@extends('admin.layouts.main')
@section('title',$title)
@section('content')
<div class="container-fluid">
   @include('admin.layout-parts.breadcrumbs')
   <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$title}} ({{$trashed_count}})</h4>
                <div align="right" class="all-a">
                    @if($trashed_count)
                    <a href="javascript:void(0);" class="btn btn-outline-danger bulk-force-delete btn-xs" style="display: none;">Bulk Delete</a>
                    <form id='bulk_force_delete_entity_form' method="POST" action="{{route('admin.activity-list.bulk-force-delete')}}" style="display: none" data-text="page">
                      {{ csrf_field() }}
                      <input type="hidden" name="fd_ids" id="fd-ids" >

                      {{method_field('DELETE')}}

                  </form>
                    <a href="javascript:void(0);" class="btn btn-outline-primary bulk-restore btn-xs" style="display: none;">Bulk Restore</a>
                    <form id='bulk_restore_entity_form' method="POST" action="{{route('admin.activity-list.restore-bulk')}}" style="display: none" data-text="page">
                      {{ csrf_field() }}
                      <input type="hidden" name="ids" id="ids" >

                  </form>
                  <a href="javascript:void(0);" class="btn btn-outline-danger btn-xs"  onclick="confirm('Are You Want To Empty Trash')?jQuery('#empty_trashed_entity_form').submit():false">Empty Trash</a>
                    <form id='empty_trashed_entity_form' method="POST" action="{{route('admin.activity-list.empty-trashed')}}" style="display: none" data-text="post">
                      {{ csrf_field() }}
                      {{method_field('DELETE')}}
                  </form>
                  <form id='all_restore_entity_form' method="POST" action="{{route('admin.activity-list.restore-all')}}" style="display: none" data-text="page">
                      {{ csrf_field() }}

                  </form>
                  <a href="javascript:void(0);" class="btn btn-info btn-xs {{($trashed_count == 0)?'disabled':''}}" id="restore_all_entity_form" data-text="page">
                    Restore All ({{ $trashed_count }})
                </a>
                  @endif
                <a href="{{route('admin.activity-lists.index')}}" class="btn btn-dark btn-xs"><i class="fa fa-arrow-right"></i> Back</a>
                
            </div>
        </div>

        <div class="card-body activity_list entity-list">
            @if(Session::has('success'))
            {!!get_form_success_msg(Session::get('success'))!!}
            @endif
            @if(Session::has('error'))
            {!!get_form_error_msg(Session::get('error'))!!}
            @endif
            
            <div class="table-responsive">
               {{ $dataTable->table() }}
           </div>
       </div>
       <form id='restore_entity_form' method="POST" action="{{route('admin.activity-list.trashed')}}" style="display: none">
          {{ csrf_field() }}

          {{method_field('PUT')}}

      </form>  
       <form id='delete_entity_form' method="POST" action="{{route('admin.activity-lists.index')}}" style="display: none">
          {{ csrf_field() }}

          {{method_field('DELETE')}}

      </form>  
  </div>
</div>
</div>

</div>
@endsection
