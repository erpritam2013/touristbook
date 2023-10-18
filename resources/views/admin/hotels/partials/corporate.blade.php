<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Corporate Address Section</h4>
    </div>

    <div class="card-body">
       <!--corporateAddress -->
@include('admin.partials.utils.input', ['name'=> 'hotel_attributes[corporateAddress]','label'=>'Add Corporate Address','value'=>$hotel->hotel_attributes['corporateAddress'] ?? '','id' => "corporateAddress"])

    </div>
</div>
