<!-- Gallery -->
@include('admin.partials.utils.media', ['name'=> 'gallery','label'=>'Gallery','desc'=>"This is a gallery option type",'value'=>$page->gallery ?? '','id' => "gallery",'smode'=>'multiple'])

<!-- Media(video URL or audio URL) -->
@include('admin.partials.utils.input', ['name'=> 'media','label'=>'Media(video URL or audio URL)','desc'=>'This field for Audio and Video page Format','value'=>$page->media ?? '','id' => "",'control'=>'url'])
<!-- Media(video URL or audio URL) -->
@include('admin.partials.utils.input', ['name'=> 'link','label'=>'Link','desc'=>'This is a link option type','value'=>$page->link ?? '','id' => "",'control'=>'url'])