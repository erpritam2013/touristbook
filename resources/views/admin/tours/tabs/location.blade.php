@if($locations->count())
<div class="card {{($locations->count() > 10)?'location-card':'location-card-padding'}}">
    <div class="card-header border-bottom">
        <h4 class="card-title">Locations</h4>
    </div>
    <div class="card-body">

        <div class="form-group row">
            <input type="text" class="form-control" id="search_location" placeholder="Search Location......">
            <div class="col-lg-12 location-list">   

            @include('admin.partials.utils.nested_checkbox_list', ['items' => $locations, 'name'=> 'location_id', 'selected' => $tour->locations->pluck('id')->toArray() ?? []])
            </div>
           
        </div>
    </div>
</div>
 @endif

 @include('admin.partials.utils.input', ['name'=> 'address','label'=>'Real tour address','desc'=>'Input your tour address detail','value'=>$tour->address ?? '','id' => "address",'class'=>'pac-target-input'])

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="map_address">tour address</label>
    <div class="col-lg-7">
        <input type="text" class="form-control" id="map_address" name="map_address" value="{{$tour->detail->map_address ?? ''}}">
    </div>
</div>

<h3>Location on map</h3>
<div id="map" style="width: 100%; height:350px;"></div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="latitude">Latitude</label>
    <div class="col-lg-7">
        <input type="number" class="form-control" id="latitude" name="latitude" value="{{$tour->detail->latitude ?? ''}}">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="longitude">Longitude</label>
    <div class="col-lg-7">
        <input type="number" class="form-control" id="longitude" name="longitude" value="{{$tour->detail->longitude ?? ''}}">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="zoom_level">Zoom Level</label>
    <div class="col-lg-7">
        <input type="number" class="form-control" id="zoom_level" name="zoom_level" value="{{$tour->detail->zoom_level ?? 1}}">
    </div>
</div>


