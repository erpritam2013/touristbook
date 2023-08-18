
@extends('admin.layouts.main')
@section('title',$title)
@section('admin_head_css')
@parent
<!-- Datatable -->
<link href="{!! asset('admin-part/vendor/datatables/css/jquery.dataTables.min.css') !!}" rel="stylesheet">
<link href="https://cdn.datatables.net/searchbuilder/1.5.0/css/searchBuilder.dataTables.min.css" rel="stylesheet">
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
                <div align="right"class="all-a">
                    @if($countries->count())<a href="javascript:void(0);" class="btn btn-outline-danger bulk-delete btn-xs" style="display: none;">Bulk Delete</a>
                     <form id='bulk_delete_entity_form' method="POST" action="{{route('admin.terms.countries.bulk-delete')}}" style="display: none" data-text="country">
                              {{ csrf_field() }}
                              <input type="hidden" name="ids" id="ids" >

                              {{method_field('DELETE')}}

                          </form>@endif
                    <a href="{{route('admin.terms.countries.create')}}" class="btn btn-outline-primary btn-xs">Add New Country</a>
                </div>
            </div>

            <div class="card-body country_list entity-list">
                @if(Session::has('success'))
                {!!get_form_success_msg(Session::get('success'))!!}
                @endif
                
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>@if($countries->count())<input type="checkbox" class="css-control-input mr-2 select-all">@endif S.No.</th>
                                <th>Country Code</th>
                                <th>Country Name</th>
                                <th>Code</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($countries->count())
                            @foreach($countries as $country)
                            <tr>
                                <td><input type="checkbox" class="css-control-input mr-2 select-id" name="id[]" value="{{$country->id}}">{{++$loop->index}}</td>
                                <td>{{$country->countrycode}}</td>
                                <td>{{$country->countryname}}</td>
                                <td>{{$country->code}}</td>
                                <td>{{get_time_format($country->created_at)}}</td>
                                <td>{{(!empty($country->updated_at))?get_time_format($country->updated_at):""}}</td>
                                <td>
                                    <a href="{{route('admin.terms.countries.edit',$country->id)}}" class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-danger del_entity_form" title="Delete" item_id="{{$country->id}}" data-text="country"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>

                           

                          @endforeach
                           
                          @endif
                          
                      </tbody>
                      {{--<tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </tfoot>--}}
                </table>
            </div>
        </div>
          <form id='delete_entity_form' method="POST" action="{{route('admin.terms.countries.index')}}" style="display: none">
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

<script src="https://cdn.datatables.net/searchbuilder/1.5.0/js/dataTables.searchBuilder.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>

<script src="{!! asset('admin-part/js/plugins-init/datatables.init.js') !!}"></script>

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endsection