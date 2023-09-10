<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">States</h4>
    </div>
    <div class="card-body">
       <div class="form-group row">
            @include('admin.partials.utils.select_box', ['items' => $states, 'name'=> 'state_id[]','selected'=>$selected,'lebal'=>'State'])
        </div>
    </div>
</div>
