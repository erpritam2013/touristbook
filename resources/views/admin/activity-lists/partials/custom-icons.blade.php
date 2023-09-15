<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Extra fields Activities</h4>
    </div>
    <div class="card-body">

     @include('admin.partials.utils.select_box', ['items' => $custom_icons, 'name'=> 'custom_icon','selected'=>[],'lebal'=>'Custom Icon'])


    </div>
</div>