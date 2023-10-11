<!-- Gallery -->
@include('admin.partials.utils.media', ['name'=> 'gallery','label'=>'Gallery','desc'=>"This is a gallery option type",'value'=>$post->gallery ?? '','id' => "gallery",'smode'=>'multiple'])

<!-- Media(video URL or audio URL) -->
@include('admin.partials.utils.input', ['name'=> 'media','label'=>'Media(video URL or audio URL)','desc'=>'This field for Audio and Video Post Format','value'=>$post->media ?? '','id' => "",'control'=>'url'])
<!-- Media(video URL or audio URL) -->
@include('admin.partials.utils.input', ['name'=> 'link','label'=>'Link','desc'=>'This is a link option type','value'=>$post->link ?? '','id' => "",'control'=>'url'])