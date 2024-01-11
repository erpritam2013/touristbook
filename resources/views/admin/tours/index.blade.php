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
                <div align="right" class="all-a">
                {{--<div class="form-group row">

                    <label class="col-lg-4">Page No.</label>
                     <input type="number" id="custom_page_no" class="form-control col-lg-4">&nbsp;
                     <button class="btn btn-primary col-lg-3 proceed_page" type="button">proceed</button>
                </div>--}}

                    @if($tours)<a href="javascript:void(0);" class="btn btn-outline-danger bulk-delete btn-xs" style="display: none;">Bulk Delete</a>
                    <form id='bulk_delete_entity_form' method="POST" action="{{route('admin.tours.bulk-delete')}}" style="display: none" data-text="tour">
                      {{ csrf_field() }}
                      <input type="hidden" name="ids" id="ids" >

                      {{method_field('DELETE')}}

                  </form>@endif

                  <a href="{{route('admin.tours.create')}}" class="btn btn-outline-primary btn-xs">Add New Activity</a>
              </div>
          </div>

          <div class="card-body activity_list entity-list">
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
     <form id='delete_entity_form' method="POST" action="{{route('admin.tours.index')}}" style="display: none">
      {{ csrf_field() }}

      {{method_field('DELETE')}}

  </form>  
</div>
</div>
</div>

</div>
@endsection
