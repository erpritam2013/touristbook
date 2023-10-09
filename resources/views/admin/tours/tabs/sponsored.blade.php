<!-- title -->
@include('admin.partials.utils.input', ['name'=> 'sponsored[title]','label'=>'Sponsored Title','value'=>$tour->detail->sponsored['title'] ?? '','id' => ""])

<!-- sponsored by -->
@include('admin.partials.utils.input', ['name'=> 'sponsored[sponsored_by]','label'=>'Sponsored By','value'=>$tour->detail->sponsored['sponsored_by'] ?? '','control' => "url"])

<!-- tour Included -->
@include('admin.partials.utils.textarea', ['name'=> 'sponsored[description]','label'=>'Tour Included','value'=>$tour->detail->sponsored['description'] ?? '','rows'=>10])