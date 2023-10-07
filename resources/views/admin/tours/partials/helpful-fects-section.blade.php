<div class="card tour-extra-fields">
    <div class="card-header border-bottom">
        <h4 class="card-title">Helpful Facts Section</h4>
    </div>

    <div class="card-body">

        <!-- Select Country -->
        @include('admin.partials.utils.textarea', ['value' => $tour->detail->helpful_facts ?? trim($helpful_facts), 'name'=> 'helpful_facts','label'=>'Helpful Facts'])


    </div>
</div>
