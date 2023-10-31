<div class="modal fade bd-example-modal-xl" id="file-modal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">File</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="custom-tab-1">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#upload-media">Upload</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#list-media">Files</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="upload-media" role="tabpanel">
                            <div class="pt-4">
                                <div id="drop-area">
                                    <form class="my-form">
                                        <p>Upload multiple files with the file dialog or by dragging and dropping images onto the dashed region</p>
                                        <input type="file" id="fileElem" multiple >
                                        <label class="button" for="fileElem">Select some files</label>
                                    </form>
                                    <progress id="media-progress-bar" class="w-100" max=100 value=0 style="height:40px;"></progress>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-media">
                            <div class="pt-4">
                                <div class="file-search">
                                    <input type="text" class="form-control" placeholder="Search" id="file-search-box" />
                                </div>
                                <div class="file-list row"></div>
                                <div class="file-pagination" id="paginationList"></div>
                            </div>
                        </div>

                    </div>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary submit-media">Submit</button>
            </div>
        </div>
    </div>
</div>

<style>

#drop-area {
  border: 2px dashed #ccc;
  border-radius: 20px;
  width: auto;
  font-family: sans-serif;
  margin: 100px auto;
  padding: 20px;
}
#drop-area.highlight {
  border-color: purple;
}
p {
  margin-top: 0;
}
.my-form {
  margin-bottom: 10px;
}
#gallery {
  margin-top: 10px;
}
#gallery img {
  width: 150px;
  margin-bottom: 10px;
  margin-right: 10px;
  vertical-align: middle;
}
.button {
  display: inline-block;
  padding: 10px;
  background: #ccc;
  cursor: pointer;
  border-radius: 5px;
  border: 1px solid #ccc;
}
.button:hover {
  background: #ddd;
}
#fileElem {
  display: none;
}

</style>
