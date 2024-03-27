 <div class="row page-titles mx-0">
    <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
            <h4>Hi, welcome back!</h4>
            <span class="ml-1">{{$title}}</span>
        </div>
    </div>

    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">

            <li class="breadcrumb-item {{ $breadcrumbs->isEmpty() ? 'active' : '' }}"><a href="/">Home</a></li>
            @foreach ($breadcrumbs as $key => $url)
              @if(!is_null($url) && !$loop->last)
              @if($key != 'admin')
              @if(!Route::has('admin.'.$key))
              @php  $url .= (substr($url, -1, 1) != "s")?$url.'s':'';@endphp
              @endif
              @endif
                <li class="breadcrumb-item"><a href="{{ url($url) }}">{{ ucwords(str_replace('-'," ",$key)) }}</a></li>
            @else
                <li class="breadcrumb-item active">{{ ucwords(str_replace('-'," ",$key)) }}</li>
            @endif
            @endforeach

        </ol>
    </div>
</div>