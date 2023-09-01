<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="map_address">Hotel address</label>
    <div class="col-lg-7">
        <input type="text" class="form-control" id="map_address" name="map_address" value="{{$hotel->map_address ?? ''}}">
    </div>
</div>

<h3>Location on map</h3>
<div id="map" style="width: 100%; height:350px;"></div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="latitude">Latitude</label>
    <div class="col-lg-7">
        <input type="number" class="form-control" id="latitude" name="latitude" value="{{$hotel->latitude ?? ''}}">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="longitude">Longitude</label>
    <div class="col-lg-7">
        <input type="number" class="form-control" id="longitude" name="longitude" value="{{$hotel->longitude ?? ''}}">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-5 col-form-label" for="zoom_level">Zoom Level</label>
    <div class="col-lg-7">
        <input type="number" class="form-control" id="zoom_level" name="zoom_level" value="{{$hotel->zoom_level ?? 1}}">
    </div>
</div>


