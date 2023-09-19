<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Activity Options For Activity Package</h4>
    </div>

    <div class="card-body">
            @include('admin.partials.utils.select_box', ['items' => $activities, 'name'=> 'activity_id[]','selected'=>[],'lebal'=>'Activity'])
    </div>
</div>