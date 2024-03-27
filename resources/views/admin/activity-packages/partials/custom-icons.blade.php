<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Extra fields Activities</h4>
    </div>
    <div class="card-body">
     {!!selectBoxTemplate(['items' => $custom_icons, 'name'=> 'custom_icon','selected'=>$activity_package->custom_icon ?? "",'lebal'=>'Custom Icon'])!!}
    </div>
</div>