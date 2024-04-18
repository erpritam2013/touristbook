<div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title" >Page Template</h4>
    </div>

    <div class="card-body" id="page-type-card-body">

   
        <!-- Page Type -->
      
 {!!selectBoxTemplate(['items' => $page_types, 'name'=> 'type','selected'=>$page->type ?? null,'lebal'=>'Page Template','id'=>'page-type'])!!}
       

    </div>
</div>
