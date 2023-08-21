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
                <div align="right" class="all-a">
                    @if($medicare_assistances->count())<a href="javascript:void(0);" class="btn btn-outline-danger bulk-delete btn-xs" style="display: none;">Bulk Delete</a>
                     <form id='bulk_delete_entity_form' method="POST" action="{{route('admin.terms.medicare-assistances.bulk-delete')}}" style="display: none" data-text="medicare assistance">
                              {{ csrf_field() }}
                              <input type="hidden" name="ids" id="ids" >

                              {{method_field('DELETE')}}

                          </form>@endif
                    <a href="{{route('admin.terms.medicare-assistances.create')}}" class="btn btn-outline-primary btn-xs">Add New Medicare Assistance</a></div>
            </div>

            <div class="card-body medicare_assistance_list entity-list">
                @if(Session::has('success'))
                {!!get_form_success_msg(Session::get('success'))!!}
                @endif
                
                <div class="table-responsive">

                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th> @if($medicare_assistances->count())<input type="checkbox" class="css-control-input mr-2 select-all">@endif S.No.</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Icon</th>
                                <th>Parent</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($medicare_assistances->count())
                            @foreach($medicare_assistances as $medicare_assistance)
                            <tr>
                                <td><input type="checkbox" class="css-control-input mr-2 select-id" name="id" value="{{$medicare_assistance->id}}">{{++$loop->index}}</td>
                                <td>{{$medicare_assistance->name}}</td>
                                <td>{{$medicare_assistance->slug}}</td>
                                <td>{!!get_fontawesome_icon_html($medicare_assistance->icon,'fa-lg')!!}</td>
                                <td>{{get_parent_term($medicare_assistances,$medicare_assistance->parent_id)}}</td>
                                <td>{{$medicare_assistance->medicare_assistance_type}}</td>
                                <td> <input data-id="{{$medicare_assistance->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-url=' {{route("admin.terms.changeStatusMedicareAssistance")}}' data-on="Active" data-off="InActive" {{ $medicare_assistance->status ? 'checked' : '' }}></td>
                                <td>{{get_time_format($medicare_assistance->created_at)}}</td>
                                <td>{{get_time_format($medicare_assistance->updated_at)}}</td>
                                <td>
                                    <a href="{{route('admin.terms.medicare-assistances.edit',$medicare_assistance->id)}}" class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('admin.terms.medicare-assistances.show',$medicare_assistance->id)}}" class="btn btn-info" title="View"><i class="fa fa-file"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-danger del_entity_form" title="Delete" item_id="{{$medicare_assistance->id}}" data-text="medicare assistance"><i class="fa fa-trash"></i></a>
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
          <form id='delete_entity_form' method="POST" action="{{route('admin.terms.medicare-assistances.index')}}" style="display: none">
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