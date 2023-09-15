<div class="form-group row">
    <div class="col-lg-12">
    <label  for="map_address">Location on map<br/><small>Kindly input Map API in Theme Settings > Other Options</small></label>
        <input type="text" class="form-control" id="map_address" name="map_address" value="{{$location->map_address ?? ''}}">
    </div>
</div>

<h3>Location on map</h3>
<div id="map" style="width: 100%; height:350px;"></div>

<div class="form-group row">
    <div class="col-lg-12">
    <label  for="latitude">Latitude</label>
        <input type="number" class="form-control" id="latitude" name="latitude" value="{{$location->latitude ?? ''}}">
    </div>
</div>

<div class="form-group row">
    <div class="col-lg-12">
    <label  for="longitude">Longitude</label>
        <input type="number" class="form-control" id="longitude" name="longitude" value="{{$location->longitude ?? ''}}">
    </div>
</div>

<div class="form-group row">
    <div class="col-lg-12">
    <label for="zoom_level">Zoom Level</label>
        <input type="number" class="form-control" id="zoom_level" name="zoom_level" value="{{$location->zoom_level ?? 1}}">
    </div>
</div>
<div class="form-group row">
    <div class="col-lg-12">
    <label for="map_type">Map Style</label>
        <input type="text" class="form-control" id="map_type" name="zoom_level" value="{{$location->map_type ?? ''}}" disabled>
    </div>
</div>


