<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Icon Activity List</h4>
    </div>
    <div class="card-body">

     @include('admin.partials.utils.select_box', ['items' => $custom_icons, 'name'=> 'custom_icon','selected'=>$activity_list->custom_icon,'lebal'=>'Custom Icon'])


    </div>
</div>