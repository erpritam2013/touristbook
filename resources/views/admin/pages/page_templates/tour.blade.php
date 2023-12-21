<div class="border p-2 mb-2">

 {!!inputTemplate( ["name" => 'extra_data[notes_title]', 'id' => 'notes-title','value'=>$page->extra_data["notes_title"] ?? '','label'=>'Title'])!!}

 {!!textareaTemplate(['name'=>'extra_data[notes_desc]','id'=>'notes-desc','value'=>$page->extra_data["notes_desc"] ?? '','label'=>'Notes','class'=>'tourist-editor','rows'=>12])!!}
</div>
<div class="border p-2 mb-2">
 {!!textareaTemplate(['name'=>'extra_data[important_note_tours]','id'=>'important-note-tours','value'=>$page->extra_data["important_note_tours"] ?? '','label'=>'Importent Notes','rows'=>10])!!}
</div>
<div class="border p-2 mb-2">
 {!!inputTemplate( ["type"=>"number","name" => 'extra_data[tour_min_price_filter]', 'id' => 'tour-min-price','value'=>$page->extra_data["tour_min_price_filter"] ?? '','label'=>'Tour Minium Price'])!!}

 {!!inputTemplate( ["type"=>"number","name" => 'extra_data[tour_max_price_filter]', 'id' => 'tour-max-price','value'=>$page->extra_data["tour_max_price_filter"] ?? '','label'=>'Tour Maximum Price'])!!}
</div>
<div class="border p-2 mb-2">
 
  <!-- Select Country -->
        {!!selectBoxTemplate( ['items' => getCountries(), 'name'=> 'extra_data[rs_filter_location_country_tour]','selected'=>$page->extra_data["rs_filter_location_country_tour"] ?? '','label'=>'Select Country'])!!}
</div>