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
               
                <div align="right">
                     <a ref="javascript:void(0);" class="btn btn-danger del_entity_form" title="Permanent Delete" item_id="'.$media->id.'" data-text="media" style="color:#fff">Delete Media</a>
                </div>
          </div>

          <div class="card-body used-media-list">
            @if(Session::has('success'))
            {!!get_form_success_msg(Session::get('success'))!!}
            @endif
             @if($tours->isNotEmpty())
            <div class="row">
                <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Packages</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>#id</th>
                                                <th>Name</th>
                                                <th>View</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($tours as $tour)
                                            <tr>
                                                <td>#{{$tour->id}}</td>
                                                <td>{{$tour->name}}</td>
                                                <td><a href="{{route('tour',$tour->slug ?? '')}}" class="btn btn-info" target="_blank">View</a></td>
                                                <td><a href="{{route('admin.tours.edit',$tour->id)}}" class="btn btn-primary" target="_blank" >Edit</a></td>
                                                
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @endif
             @if($locations->isNotEmpty())
            <div class="row">
                <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Locations</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>#id</th>
                                                <th>Name</th>
                                                <th>View</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($locations as $location)
                                            <tr>
                                                <td>#{{$location->id}}</td>
                                                <td>{{$location->name}}</td>
                                                <td><a href="{{route('location',$location->slug ?? '')}}" class="btn btn-info" target="_blank">View</a></td>
                                                <td><a href="{{route('admin.locations.edit',$location->id)}}" class="btn btn-primary" target="_blank" >Edit</a></td>
                                                
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @endif
             @if($hotels->isNotEmpty())
            <div class="row">
                <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Hotels</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>#id</th>
                                                <th>Name</th>
                                                <th>View</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($hotels as $hotel)
                                            <tr>
                                                <td>#{{$hotel->id}}</td>
                                                <td>{{$hotel->name}}</td>
                                                <td><a href="{{route('hotel',$hotel->slug ?? '')}}" class="btn btn-info" target="_blank">View</a></td>
                                                <td><a href="{{route('admin.hotels.edit',$hotel->id)}}" class="btn btn-primary" target="_blank" >Edit</a></td>
                                                
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @endif
            @if($activities->isNotEmpty())
            <div class="row">
                <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Activities</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>#id</th>
                                                <th>Name</th>
                                                <th>View</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($activities as $activity)
                                            <tr>
                                                <td>#{{$activity->id}}</td>
                                                <td>{{$activity->name}}</td>
                                                <td><a href="{{route('activity',$activity->slug ?? '')}}" class="btn btn-info" target="_blank">View</a></td>
                                                <td><a href="{{route('admin.activities.edit',$activity->id)}}" class="btn btn-primary" target="_blank" >Edit</a></td>
                                                
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @endif
             @if($rooms->isNotEmpty())
            <div class="row">
                <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Rooms</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>#id</th>
                                                <th>Name</th>
                                                {{--<th>View</th>--}}
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($rooms as $room)
                                            <tr>
                                                <td>#{{$room->id}}</td>
                                                <td>{{$room->name}}</td>
                                                {{--<td><a href="{{route('room',$room->slug ?? '')}}" class="btn btn-info" target="_blank">View</a></td>--}}
                                                <td><a href="{{route('admin.rooms.edit',$room->id)}}" class="btn btn-primary" target="_blank" >Edit</a></td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @endif
             @if($tourism_zones->isNotEmpty())
            <div class="row">
                <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Tourism Zones</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>#id</th>
                                                <th>Name</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($tourism_zones as $tourism_zone)
                                            <tr>
                                                <td>#{{$tourism_zone->id}}</td>
                                                <td>{{$tourism_zone->title}}</td>
                                        <td><a href="{{route('admin.tourism-zones.edit',$tourism_zone->id)}}" class="btn btn-primary" target="_blank" >Edit</a></td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @endif
             @if($activity_zones->isNotEmpty())
            <div class="row">
                <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Activity Zones</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>#id</th>
                                                <th>Name</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($activity_zones as $activity_zone)
                                            <tr>
                                                <td>#{{$activity_zone->id}}</td>
                                                <td>{{$activity_zone->title}}</td>
                                                <td><a href="{{route('admin.activity-zones.edit',$activity_zone->id)}}" class="btn btn-primary" target="_blank" >Edit</a></td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @endif
             @if($country_zones->isNotEmpty())
            <div class="row">
                <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Country Zones</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>#id</th>
                                                <th>Name</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($country_zones as $country_zone)
                                            <tr>
                                                <td>#{{$country_zone->id}}</td>
                                                <td>{{$country_zone->title}}</td>
                                                <td><a href="{{route('admin.country-zones.edit',$country_zone->id)}}" class="btn btn-primary" target="_blank" >Edit</a></td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @endif
             @if($posts->isNotEmpty())
            <div class="row">
                <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Posts</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>#id</th>
                                                <th>Name</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($posts as $post)
                                            <tr>
                                                <td>#{{$post->id}}</td>
                                                <td>{{$post->name}}</td>
                                                <td><a href="{{route('admin.posts.edit',$post->id)}}" class="btn btn-primary" target="_blank" >Edit</a></td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @endif
             @if($pages->isNotEmpty())
            <div class="row">
                <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Pages</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>#id</th>
                                                <th>Name</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($pages as $page)
                                            <tr>
                                                <td>#{{$page->id}}</td>
                                                <td>{{$page->name}}</td>
                                                <td><a href="{{route('admin.pages.edit',$page->id)}}" class="btn btn-primary" target="_blank" >Edit</a></td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @endif
            
            
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
