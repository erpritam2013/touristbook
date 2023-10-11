@extends('admin.layouts.main')
@section('title',$title)
@section('content')
<div class="container-fluid">
 @include('admin.layout-parts.breadcrumbs')

 <div class="row custom-icon-div">
    <div class="col-12">

        <div class="upload__box">
          <div class="upload__btn-box">
            <label class="upload__btn">
              <p>Upload Custom Icon</p>
              <input type="file" multiple="" data-max_length="20" class="upload__inputfile" accept="image/jpeg">
          </label>
      </div>
      <div class="upload__img-wrap"></div>
  </div>
</div>
<div class="col-12" style="padding: 5px 85px;">';
    <button type="button" class="btn btn-primary on_submit">Save</button>
 <!-- Progress bar --><div class="progress" style="
 margin: 15px 0px;
 "><div class="progress-bar"></div></div>
 <!-- Display upload status --><div id="uploadStatus"></div>
</div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$title}}</h4>
                <div align="right" class="all-a">
                    @if($custom_icons)<a href="javascript:void(0);" class="btn btn-outline-danger bulk-delete btn-xs" style="display: none;">Bulk Delete</a>
                    <form id='bulk_delete_entity_form' method="POST" action="{{route('admin.settings.custom-icon.bulk-delete')}}" style="display: none" data-text="activity zone">
                      {{ csrf_field() }}
                      <input type="hidden" name="ids" id="ids" >

                      {{method_field('DELETE')}}

                  </form>@endif
              </div>
          </div>

          <div class="card-body custom_icon_list entity-list">
            @if(Session::has('success'))
            {!!get_form_success_msg(Session::get('success'))!!}
            @endif

            <div class="table-responsive">
             {{ $dataTable->table() }}
         </div>
     </div>
     <form id='delete_entity_form' method="POST" action="{{route('admin.settings.custom-icons.index')}}" style="display: none">
      {{ csrf_field() }}

      {{method_field('DELETE')}}

  </form>  
</div>
</div>
</div>

</div>
@endsection
