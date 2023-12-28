<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Tags</h4>
    </div>
    <div class="card-body">
            @include('admin.partials.utils.select_box', ['items' => $tags, 'name'=> 'tag_id[]','selected'=>$selected,'lebal'=>'Choose Tag','multiple'=>true])
  
    </div>
</div>
