<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Page Type</h4>
    </div>

    <div class="card-body">

   
        <!-- Excerpt -->
      
 {!!selectBoxTemplate(['items' => config('global.page_types'), 'name'=> 'type','selected'=>$selected,'lebal'=>'Page Type'])!!}
       

    </div>
</div>
