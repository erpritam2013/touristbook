
@if($locations->count())
<div class="card {{($locations->count() > 10)?'location-card':'location-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Locations</h4>
    </div>
    <div class="card-body">

        <div class="form-group row">
            <input type="text" class="form-control" id="search_location" placeholder="Search Location......">
            <div class="col-lg-12 location-list">   

            @include('admin.partials.utils.nested_checkbox_list', ['items' => $locations, 'name'=> 'location_id', 'selected' => $room->locations->pluck('id')->toArray() ?? []])
            </div>
           
        </div>
    </div>
</div>
 @endif

 @include('admin.partials.utils.input', ['name'=> 'address','label'=>'Room address','desc'=>'Enter full address of room','value'=>$room->address ?? '','id' => "address",'class'=>'pac-target-input'])



