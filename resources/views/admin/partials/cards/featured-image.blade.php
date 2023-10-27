<div class="card">
	<div class="card-header border-bottom">
		<h4 class="card-title">Featured Image Section</h4>
	</div>

	<div class="card-body">
		<!-- featured_image  -->
		@include('admin.partials.utils.media', ['name'=> 'featured_image','label'=>'Featured Image','value'=>$item->featured_image ?? '','id' => ""])
	</div>
</div>
