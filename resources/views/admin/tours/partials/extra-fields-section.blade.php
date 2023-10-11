<div class="card tour-extra-fields">
    <div class="card-header border-bottom">
        <h4 class="card-title">Extra Fields</h4>
    </div>

    <div class="card-body">

        <!-- Select Country -->
        @include('admin.partials.utils.select_box', ['items' => getCountries(), 'name'=> 'st_tours_country','selected'=>$tour->detail->st_tours_country ?? "",'label'=>'Select Country','required'=>true])


    </div>
</div>
