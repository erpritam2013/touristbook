<div class="card tour-extra-fields">
    <div class="card-header border-bottom">
        <h4 class="card-title">Extra Fields</h4>
    </div>

    <div class="card-body">

        <!-- Select Country -->
        {!!selectBoxTemplate( ['items' => getCountries(), 'name'=> 'st_tours_country','selected'=>$tour->detail->st_tours_country ?? "IN",'label'=>'Select Country','required'=>true,'attr'=>'onchange="showCountryZone()"','errors'=>$errors ?? ""])!!}

         <!-- Select Country Zone -->
       {!!selectBoxTemplate(['items' => [], 'name'=> 'country_zone_id','selected'=>$tour->country_zone_id ?? "",'label'=>'Select Country Zone','parent_class'=>'country-zone-id-section d-none'])!!}


    </div>
</div>
