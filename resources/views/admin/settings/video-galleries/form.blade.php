<form class="form-valide" id="video_gallery-form" action="@yield('video_gallery_action')" method="POST">
    {{ csrf_field() }}
    @yield('video_gallery_form_method')
    <div class="row">
        <div class="col-xl-12">
            @include('admin.settings.video-galleries.partials.basic-card', ['video_gallery'=>$video_gallery ?? null])

            @include('admin.settings.video-galleries.partials.gallery-videos', ['video_gallery'=>$video_gallery ?? null])
        </div>
     
    </div>


    <button type="submit" class="btn btn-primary">@isset($video_gallery->id)Update @else Save @endisset</button>
    @if(!isset($video_gallery->id))
    <button type="button" class="btn btn-light" onclick="window.location.replace('{{ url()->previous() }}')">Cancel</button>
    @endif

</form> <!-- Form End -->
