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
                <div class="col">
                       <div id="drop-area" style="display: none;" class="m-1">
                    <form class="my-form">
                      <p>Upload multiple files with the file dialog or by dragging and dropping images onto the dashed region</p>
                      <input type="file" id="fileElemAdd" multiple style="display:none;">
                      <label class="button" for="fileElemAdd">Select some files</label>
                    </form>
                    <progress id="media-progress-bar" class="w-100" max=100 value=0 style="height:40px;"></progress>
                  </div>
                </div>
                <div align="right">
                     <a href="javascript:void(0);" class="btn btn-outline-primary btn-xs" id="add-new-media">Add New Media</a>
                </div>
          </div>

          <div class="card-body room_list entity-list">
            @if(Session::has('success'))
            {!!get_form_success_msg(Session::get('success'))!!}
            @endif
            
            <div class="table-responsive">
             {{ $dataTable->table() }}
         </div>
     </div>
     <form id='delete_entity_form' method="POST" action="{{route('admin.settings.media-object.index')}}" style="display: none">
      {{ csrf_field() }}

      {{method_field('DELETE')}}

  </form>  
</div>
</div>
</div>

</div>
@endsection
