<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Activity Options For Activity List</h4>
    </div>

    <div class="card-body">
            {!!selectBoxTemplate(['items' => $activities, 'name'=> 'activity_id[]','selected'=>$activity_list->activity_list->pluck('id')->toArray() ?? [],'lebal'=>'Activity'])!!}
    </div>
</div>