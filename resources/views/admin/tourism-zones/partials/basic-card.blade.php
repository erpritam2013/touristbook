<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Basic</h4>
    </div>

    <div class="card-body">

        {!!inputTemplate(['name'=> 'title','label'=>'Title','value'=>$tourism_zone->title ?? '','id' => "",'required' => true,'col'=>true])!!}
        
        {{-- {!!textareaTemplate( ['name'=> 'description','label'=>'Description','value'=>$tourism_zone->description ?? '','id' => "",'col'=>true,'class'=>'ckeditor'])!!}--}}

    </div>
</div>