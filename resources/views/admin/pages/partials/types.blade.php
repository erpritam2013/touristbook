<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Page Template</h4>
    </div>

    <div class="card-body">

   
        <!-- Page Type -->
      
 {!!selectBoxTemplate(['items' => $page_types, 'name'=> 'type','selected'=>null,'lebal'=>'Page Template','attr'=>'onchange="fetchPageTemplate(this)"'])!!}
       

    </div>
</div>
