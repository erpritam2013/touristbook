<!-- Gallery -->
{!!mediaTemplate(['name'=> 'gallery','label'=>'Gallery','desc'=>"This is a gallery option type",'value'=>$page->gallery ?? '','id' => "gallery",'smode'=>'multiple'])!!}

<!-- Media(video URL or audio URL) -->
{!!inputTemplate(['name'=> 'media','label'=>'Media(video URL or audio URL)','desc'=>'This field for Audio and Video page Format','value'=>$page->media ?? '','id' => "",'control'=>'url'])!!}
<!-- Media(video URL or audio URL) -->
{!!inputTemplate(['name'=> 'link','label'=>'Link','desc'=>'This is a link option type','value'=>$page->link ?? '','id' => "",'control'=>'url'])!!}