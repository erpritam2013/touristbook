<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Basic</h4>
    </div>

    <div class="card-body">

        @include('admin.partials.utils.input', ['name'=> 'title','label'=>'Title','value'=>$activity_zone->title ?? '','id' => "",'required' => true,'col'=>true])
        
        {{-- @include('admin.partials.utils.textarea', ['name'=> 'description','label'=>'Description','value'=>$activity_zone->description ?? '','id' => "",'col'=>true,'class'=>'ckeditor'])--}}

    </div>
</div>