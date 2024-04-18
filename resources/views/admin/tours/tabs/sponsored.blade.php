<!-- title -->
@include('admin.partials.utils.input', ['name'=> 'sponsored[sponsored_title]','label'=>'Sponsored Title','value'=>$tour->detail->sponsored['sponsored_title'] ?? '','id' => ""])

<!-- sponsored by -->
@include('admin.partials.utils.input', ['name'=> 'sponsored[sponsored_by]','label'=>'Sponsored By','value'=>$tour->detail->sponsored['sponsored_by'] ?? '','control' => "url"])

<!-- tour Included -->
@include('admin.partials.utils.textarea', ['name'=> 'sponsored[sponsored_description]','label'=>'Description','value'=>$tour->detail->sponsored['sponsored_description'] ?? '','rows'=>10])