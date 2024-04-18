{{--{!!inputTemplate(['name'=>'extra_data[important_note_title]','label'=>'Imaportant Note Title','value'=>$page->extra_data['important_note_title'] ?? '','id'=>'important-note-title'])!!}--}}

{!!textareaTemplate(['name'=>'extra_data[important_note]','label'=>'Imaportant Note','value'=>$page->extra_data['important_note'] ?? '','id'=>'important-note','class'=>'tourist-editor'])!!}

{!!mediaTemplate(['name'=>'extra_data[map_image]','label'=>'Map Image','value'=>$page->extra_data['map_image'] ?? '','id'=>'map-image'])!!}