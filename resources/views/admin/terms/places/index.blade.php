
@extends('admin.layouts.main')
@section('title',$title)
@section('admin_head_css')
@parent
<!-- Datatable -->
<link href="{!! asset('admin-part/vendor/datatables/css/jquery.dataTables.min.css') !!}" rel="stylesheet">
{{--<link href="https://cdn.datatables.net/searchbuilder/1.5.0/css/searchBuilder.dataTables.min.css" rel="stylesheet">--}}
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('content')


<div class="container-fluid">
   @include('admin.layout-parts.breadcrumbs')
   <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$title}}</h4>
                <div align="right" class="all-a">
                    @if($places)<a href="javascript:void(0);" class="btn btn-outline-danger bulk-delete btn-xs" style="display: none;">Bulk Delete</a>
                     <form id='bulk_delete_entity_form' method="POST" action="{{route('admin.terms.places.bulk-delete')}}" style="display: none" data-text="place">
                              {{ csrf_field() }}
                              <input type="hidden" name="ids" id="ids" >

                              {{method_field('DELETE')}}

                          </form>@endif
                    <a href="{{route('admin.terms.places.create')}}" class="btn btn-outline-primary btn-xs">Add New Place</a>
                </div>
            </div>

            <div class="card-body place_list entity-list">
                @if(Session::has('success'))
                {!!get_form_success_msg(Session::get('success'))!!}
                @endif
                
                <div class="table-responsive">
               
                  {{ $dataTable->table() }}
            </div>
        </div>
          <form id='delete_entity_form' method="POST" action="{{route('admin.terms.places.index')}}" style="display: none">
                              {{ csrf_field() }}

                              {{method_field('DELETE')}}

                          </form>  
    </div>
</div>
</div>

</div>
@endsection
@section('admin_jscript')

@parent
<!-- Datatable -->
<script src="{!! asset('admin-part/vendor/datatables/js/jquery.dataTables.min.js') !!}"></script>

{{--<script src="https://cdn.datatables.net/searchbuilder/1.5.0/js/dataTables.searchBuilder.min.js"></script>--}}
<script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>

<script src="{!! asset('admin-part/js/plugins-init/datatables.init.js') !!}"></script>

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

  

    {!! $dataTable->scripts() !!}

@endsection