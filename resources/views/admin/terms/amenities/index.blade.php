
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
   @include('admin.layouts.breadcrumbs')
   <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$title}}</h4>
                <div align="right"><a href="{{route('admin.terms.amenities.create')}}" class="btn btn-outline-primary btn-xs">Add New Amenity</a></div>
            </div>

            <div class="card-body amenity_list">
                @if(Session::has('success'))
                {!!get_form_success_msg(Session::get('success'))!!}
                @endif
                
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
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
                            @if($amenities->count())
                            @foreach($amenities as $amenity)
                            <tr>
                                <td>{{$amenity->name}}</td>
                                <td>{{$amenity->slug}}</td>
                                <td>{!!get_fontawesome_icon_html($amenity->icon,'fa-lg')!!}</td>
                                <td>{{get_parent_term($amenities,$amenity->parent_amenity)}}</td>
                                <td>{{$amenity->amenity_type}}</td>
                                <td> <input data-id="{{$amenity->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $amenity->status ? 'checked' : '' }}></td>
                                <td>{{get_time_format($amenity->created_at)}}</td>
                                <td>{{get_time_format($amenity->updated_at)}}</td>
                                <td>
                                    <a href="{{route('admin.terms.amenities.edit',$amenity->id)}}" class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('admin.terms.amenities.show',$amenity->id)}}" class="btn btn-info" title="View"><i class="fa fa-file"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-danger del_fac_form" title="Delete" item_id="{{$amenity->id}}"><i class="fa fa-trash"></i></a>
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
          <form id='del_amenity_form' method="POST" action="{{route('admin.terms.amenities.index')}}" style="display: none">
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
<script type="text/javascript">

   

  $(function() {

     $('.amenity_list').on('click', '.del_fac_form', function(event) {

        event.preventDefault();           

             var id= $(this).attr('item_id');

        if(confirm('Are You sure to delete this amenity')){   

               var action=$('#del_amenity_form').attr('action');

               $('#del_amenity_form').attr('action', action+'/'+id);

              $('#del_amenity_form').submit();

      }

  });

    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var amenity_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{route("admin.terms.changeStatus")}}',
            data: {'status': status, 'amenity_id': amenity_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })
</script>
@endsection