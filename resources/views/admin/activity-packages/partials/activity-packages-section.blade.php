<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Activity Packages Section</h4>
    </div>
    <div class="card-body">

        @include('admin.partials.utils.input', ['name'=> 'duration','label'=>'Duration','value'=>$activity_package->duration ?? '','id' => ""])

        @include('admin.partials.utils.input', ['name'=> 'price','label'=>'Price','value'=>$activity_package->price ?? "0.00",'id' => "",'type' => 'number'])

        @include('admin.partials.utils.textarea', ['name'=> 'amenities','label'=>'Amenities','value'=>$activity_package->amenities ?? '','id' => ""])

    </div>
</div>