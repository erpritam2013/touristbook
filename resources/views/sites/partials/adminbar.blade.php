<div id="touristbook-adminbar">
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <ul class="navbar-nav left-top-navbar">
        <li class="nav-item dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-dashboard"></i>&nbsp;&nbsp;Tourist Book</a>
          <ul class="dropdown-menu">
            
            <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li><a href="{{route('admin.settings.theme-settings.index')}}">Theme Settings</a></li>
            <li><a href="{{route('admin.settings.media-object.index')}}">Media List</a></li>
            <li><a href="{{route('admin.settings.custom-icons.index')}}">Custom Icon</a></li>
            <li><a href="{{route('admin.settings.video-galleries.index')}}">Video Gallery</a></li>
           
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-plus"></i>&nbsp;&nbsp;New</a>
          <ul class="dropdown-menu">
            <li><a href="{{route('admin.posts.create')}}">Post</a></li>
            <li><a href="{{route('admin.pages.create')}}">Page</a></li>
            <li><a href="{{route('admin.hotels.create')}}">Hotel</a></li>
            <li><a href="{{route('admin.activities.create')}}">Activity</a></li>
            <li><a href="{{route('admin.tours.create')}}">Tour</a></li>
            <li><a href="{{route('admin.locations.create')}}">Location</a></li>
            <li><a href="{{route('admin.users.create')}}">User</a></li>
            <li><a href="{{route('admin.country-zones.create')}}">Country Zone</a></li>
            <li><a href="{{route('admin.activity-zones.create')}}">Activity Zone</a></li>
            <li><a href="{{route('admin.tourism-zones.create')}}">Tourism Zone</a></li>
            <li><a href="{{route('admin.activity-lists.create')}}">Activity List</a></li>
            <li><a href="{{route('admin.activity-packages.create')}}">Activity Package</a></li>
            <li><a href="{{route('admin.rooms.create')}}">Room</a></li>
          </ul>
        </li>
        <li class="nav-item">
          @yield('get_a_link')    
        </li>
      </ul>
      <div class="float-left" style="margin-right: -101px;">

       @if(auth()->check())
       @if(auth()->user()->isAdmin() || auth()->user()->isEditor())
       @php
       $user_image = null;

       if(isJson(auth()->user()->image)){
        auth()->user()->image = json_decode(auth()->user()->image,true);
      }
      $user_image = (!empty(auth()->user()->image) && isset(auth()->user()->image[0]['id']))?getConversionUrl(auth()->user()->image[0]['id']):null;


      @endphp
      <ul class="navbar-nav left-top-navbar right-navbar">
        <li class="nav-item dropdown">
          <a href="{{route('admin.profile')}}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span>{{ucwords(auth()->user()->name)}}</span>&nbsp;&nbsp;<img src="{{$user_image ?? asset('sites\images\dummy-user.jpeg')}}" width="16" height="16"></a>
          <ul class="dropdown-menu">

            <li>
              <a href="{{route('admin.profile')}}">
                <span class="display-user-name">{{ucwords(auth()->user()->name)}}</span>
                <img src="{{$user_image ?? asset('sites\images\dummy-user.jpeg')}}" width="64" height="64" class="float-left p-2">
              </a>
            </li>
            <li><a href="{{route('admin.users.edit',auth()->user()->id)}}">Edit Profile</a></li>
            <li> <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="icon-key"></i>
              <span class="ml-2">Logout </span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form></li>

          </ul>
        </li>

      </ul>
      @endif 
      @endif
    </div>
  </div>
</nav>


</div>