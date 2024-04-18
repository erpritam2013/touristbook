<!-- Gallery -->
 {!!galleryTemplate([
             'name' => 'gallery',
             'label' => 'Gallery',
             'value' => $post->gallery ?? [],
             'id' => 'post-gallery',
             'desc'=>"This is a gallery option type",
             'smode' => 'multiple',
         ])!!}

<!-- Media(video URL or audio URL) -->
{!!inputTemplate(['name'=> 'media','label'=>'Media(video URL or audio URL)','desc'=>'This field for Audio and Video Post Format','value'=>$post->media ?? '','id' => "",'control'=>'url'])!!}
<!-- Media(video URL or audio URL) -->
{!!inputTemplate(['name'=> 'link','label'=>'Link','desc'=>'This is a link option type','value'=>$post->link ?? '','id' => "",'control'=>'url'])!!}