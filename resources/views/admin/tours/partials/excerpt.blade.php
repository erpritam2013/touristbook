 <div class="card">
    <div class="card-header border-bottom">
        <h4 class="card-title">Excerpt Section</h4>
    </div>

    <div class="card-body">

   
        <!-- Excerpt -->
      
 @include('admin.partials.utils.textarea', ['name'=> 'excerpt','label'=>'Excerpt','rows'=>5,'value'=>$tour->excerpt ?? '','id' => ""])
       

    </div>
</div>


