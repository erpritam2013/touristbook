<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Activity Options For Activity List</h4>
    </div>

    <div class="card-body">
        @include('admin.partials.utils.select_box', ['items' => $activities, 'name'=> 'activity_id','selected'=>$activity->value ?? "",'lebal'=>'Activity'])
    </div>
</div>