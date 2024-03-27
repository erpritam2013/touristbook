 
    <div class="row post-lists"> 

    @if($posts->isNotEmpty())
      <!-- blog item-->
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4">
        
        @include('sites.partials.breadcrumb',['location_route'=>"",'location_name'=> '','post_name'=>ucwords($title ?? '')])
      </div>
      
      @foreach($posts as $post)
      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4 post-item">
        <div class="card shadow  h-100"><a href="{{route('blog',$post->slug)}}">
           @php $featured_image = (!empty($post->featured_image) && isset($post->featured_image[0]['id']))?getConversionUrl($post->featured_image[0]['id'],'600x450'):null;@endphp
          <img src="{{$featured_image ?? asset('sites/images/dummy/600x450.jpg')}}" alt="post-image" class="post-image" width="768" height="368">               
        </a>
          <div class="card-body">
            <h5 class="my-2"><a href="{{route('blog',$post->slug)}}" class="post-title text-dark">{{shortDescription($post->name ?? '',35)}}</a></h5>
            <p class="text-gray-500 text-sm my-3 post-desc"><i class="far fa-clock mr-2"></i>{{date('M d, Y',strtotime($post->created_at))}}</p>
            {{--<p class="my-2 text-muted text-sm">{{shortDescription($post->excerpt ?? '',45)}}</p>--}}
            <a href="{{route('blog',$post->slug)}}" class="btn btn-link pl-0 post-read-more">Read more</a> </div>
        </div>
      </div>
      @endforeach

      @else
<h2>No Result Found</h2>
      @endif
   
    </div>
  
 