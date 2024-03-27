@section('video_action', route('admin.settings.gallery-video-post'))
 <div class="modal fade" id="video-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Video</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <form action="@yield('video_action')" method="post" id="form-video-modal">

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label" for="name">Url
                    </label>
                    <div class="col-lg-10">
                     <input type="url" class="form-control" id="image_url" name="image_url" value="" placeholder="Enter a image url..">
                 </div>
             </div>
             <div class="form-group row">
                 <label class="col-lg-2 col-form-label" for="name">Name
                 </label>
                 <div class="col-lg-10">
                    <input type="text" class="form-control" id="name" name="name" value="" placeholder="Enter a name..">
                </div>
            </div> 

            <div class="form-group row">
                <label class="col-lg-2 col-form-label" for="name">Description
                </label>
                <div class="col-lg-10">
                 <textarea class="form-control" id="description" name="description" rows="2"></textarea>
             </div>
         </div>
               </form>
     </div>
     <div class="modal-footer">
        <button type="button" class="btn btn-secondary close-video" data-dismiss="modal" data-type="close" onclick="modalClose(this)">Close</button>
        <button type="button" class="btn btn-primary submit-video" onclick="SubmitVideo('#video-modal','add');">Submit</button>
    </div>
</div>
</div>
</div>