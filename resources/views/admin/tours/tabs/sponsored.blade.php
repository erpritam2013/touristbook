<!-- title -->
{!!inputTemplate(['name'=> 'sponsored[sponsored_title]','label'=>'Sponsored Title','value'=>$tour->detail->sponsored['sponsored_title'] ?? '','id' => ""])!!}

<!-- sponsored by -->
{!!inputTemplate(['name'=> 'sponsored[sponsored_by]','label'=>'Sponsored By','value'=>$tour->detail->sponsored['sponsored_by'] ?? '','control' => "url"])!!}

<!-- tour Included -->
{!!textareaTemplate(['name'=> 'sponsored[sponsored_description]','label'=>'Description','value'=>$tour->detail->sponsored['sponsored_description'] ?? '','rows'=>10])!!}