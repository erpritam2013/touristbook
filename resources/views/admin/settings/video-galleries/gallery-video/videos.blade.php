  <div class="col-xl-3">
     <div class="card">
        <div class="card-body">
           <form action="javascript:void(0)" method="post" id="edit-gallery-video-0">

             {!!mediaTemplate([
             'name' => 'thumb_url',
             'label' => 'Video Thumb',
             'value' => '',
             'id' => '',
             ])!!}

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
         <div class="form-group row">
            <label class="col-lg-2 col-form-label" for="name">Url
            </label>
            <div class="col-lg-10">
               <input type="url" class="form-control" id="image_url" name="image_url" value="" placeholder="Enter a image url..">
            </div>
         </div>
         <button type="submit" class="btn btn-primary" onclick="EditVideo(this)" data-index="0">Edit Video</button>
         <button type="button" class="btn btn-light"  onclick="RomoveVideo(this)" data-gallery_video_id="1">Remove Video</button>

      </form>
   </div>
</div>
</div>