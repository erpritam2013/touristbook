jQuery(document).ready(function ($) {
  ImgUpload();

  function ImgUpload() {
    var imgWrap = "";
    var imgArray = [];

    $('.upload__inputfile').each(function () {
      $(this).on('change', function (e) {
        var allowedTypes = ['image/jpg','image/jpeg'];

        imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
        var maxLength = $(this).attr('data-max_length');

        var files = e.target.files;
        var filesArr = Array.prototype.slice.call(files);
        var iterator = 0;
        filesArr.forEach(function (f, index) {

          if (!f.type.match('image.*')) {
            return;
          }
          if(!allowedTypes.includes(f.type)){
            alert('Please select a valid file (JPEG/JPG).');
            return;
          }



          if (imgArray.length > maxLength) {
            alert('please select maximum 100 images');
            return false;
          } else {
            var len = 0;
            for (var i = 0; i < imgArray.length; i++) {
              if (imgArray[i] !== undefined) {
                len++;
              }
            }
            if (len > maxLength) {
              return false;
            } else {
              $(this).index(imgArray);
              imgArray.push(f);
              var reader = new FileReader();
              reader.onload = function (e) {

                var html = "<div class='upload__img-box' data-id='"+index+"'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                imgWrap.append(html);
                iterator++;
              }
              reader.readAsDataURL(f);
            }
          }
        });
      });
    });

    $('body').on('click', ".upload__img-close", function (e) {
      var file = $(this).parent().data("file");
      for (var i = 0; i < imgArray.length; i++) {
        if (imgArray[i].name === file) {
          imgArray.splice(i, 1);
          break;
        }
      }
      $(this).parent().parent().remove();

    });

    $('.on_submit').on('click',function(e){
     e.preventDefault();

     // var change_images = [];
     
     window.intervalId;
     if (imgArray.length != 0) {
      send_ajax();
         //form_data.append('files', imgArray);
     //   intervalId = window.setInterval(function(){

     //    var upload__img = $('.upload__img-wrap .upload__img-box').first();
     //    var get_index = $(upload__img).data('id');

     //    if (upload__img.length != 0) {


     //    }else{
     //     clearInterval(intervalId);
     //     return false;
     //   }


     // }, 2000);
    }else{
     alert('Please select image first');
     return false;
   }
 });

    function send_ajax() {
      var url_href = window.location.href;
      var origin   = window.location.origin;
      var upload__img = $('.upload__img-wrap .upload__img-box').first();
      //var get_index = Number($(upload__img).data('id'));
      if (upload__img.length != 0) {
        var  form_data = new FormData();
        var image = imgArray[0];
        if (typeof image == 'undefined') {
          if (confirm('are you countinue')) {
            send_ajax();
          }else{
            return false;
          }

        }
        form_data.append('action', 'custom_icon_image_upload');
        form_data.append('icon',image);

        $.ajax({
          xhr: function() {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function(evt) {
              if (evt.lengthComputable) {
                var percentComplete = ((evt.loaded / evt.total) * 100);
                $(".progress-bar").width(percentComplete + '%');
                $(".progress-bar").html(percentComplete+'%');
              }
            }, false);
            return xhr;
          },
          type: 'POST',
          url: url_href,
          data: form_data,
          contentType: false,
          cache: false,
          processData:false,
          headers: {
        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    },
          beforeSend: function(){
            $(".progress-bar").width('0%');
            $('#uploadStatus').html('<img src="'+origin+'/admin-part/images/loader/loading.gif" width="60"/>');
          },
          error:function(){
            // $('#uploadStatus').html('<p class="alert alert-outline-danger alert-dismissible fade show">File upload failed, please try again.<span><i class="mdi mdi-close"></i></span></p>');

        $('#uploadStatus').html('<div class="alert alert-outline-danger alert-dismissible fade show"><button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span> </button><strong>Error!</strong> File upload failed, please try again.</div>');
          },
          success: function(resp){
            if(resp.success){
              imgArray.splice(0,1);
              $(upload__img).remove();
              // $('#uploadStatus').html('<p style="color:#28A74B;font-size: 18px;padding: 11px;border: 1px solid;">File has uploaded successfully!</p>');

              $('#uploadStatus').html('<div class="alert alert-outline-success alert-dismissible fade show"><button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span> </button><strong>Success</strong> File has uploaded successfully!</div>');
              send_ajax();
            }else if(!resp.success){

              if (typeof resp.data != "undefined") {
                var ht = "";
                ht += '<div class="alert alert-outline-danger alert-dismissible fade show p-close"><button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span> </button><strong>Error!</strong> This Image Already Existed!</div>';
                ht += '<div class="p-close" style="width: 100px!important;">';
                ht += $(upload__img).html();
                ht += '</div>';
                console.log();
                $('#uploadStatus').html(ht);

                 imgArray.splice(0,1);
              $(upload__img).remove();
                setTimeout(() => {
                  $('.p-close').remove();
                }, 2000);
                return false;
              }

              // $('#uploadStatus').html('<p style="color:#EA4335;font-size: 18px;padding: 11px;border: 1px solid;">Please select a valid file to upload.</p>');
              $('#uploadStatus').html('<div class="alert alert-outline-danger alert-dismissible fade show"><button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span> </button><strong>Error!</strong> Please select a valid file to upload.!</div>');

            }else if(resp.err){
              // $('#uploadStatus').html('<p style="color:#EA4335;font-size: 18px;padding: 11px;border: 1px solid;">Image Not Added!</p>');
              $('#uploadStatus').html('<div class="alert alert-outline-danger alert-dismissible fade show"><button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span> </button><strong>Error!</strong> Image Not Added!</div>');
            }
            
          }
        });

      }else{
        $('.upload__img-wrap .upload__img-box').first().remove();
        alert('all icons uploaded');
        window.location.reload();
        return false;
      }

    }

    $('.remove-icon').on('click',function(e){

      if (confirm('do want to delete this icon')) {
        var icon_id = $(this).data('id');
        var url_href = window.location.href;
        var origin   = window.location.origin;
        var  form_data = new FormData();
        form_data.append('icon_id', icon_id);
        form_data.append('action', 'custom_icon_image_delete');
        e.preventDefault();
        $.ajax({

          type: 'POST',
          url: url_href,
          data: form_data,
          contentType: false,
          cache: false,
          processData:false,
          beforeSend: function(){
                    //$(".progress-bar").width('0%');
            $('#uploadStatus').html('<img src="'+origin+'/admin-part/images/loader/loading.gif"/ width="60">');
          },
          error:function(){
            // $('#uploadStatus').html('<p style="color:#EA4335;">Something Want Wrong!</p>');
            $('#uploadStatus').html('<div class="alert alert-outline-danger alert-dismissible fade show"><button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span> </button><strong>Error!</strong> Something Want Wrong!</div>');
          },
          success: function(resp){
            if(resp.success){
              // $('#uploadStatus').html('<p style="color:#28A74B;font-size: 18px;padding: 11px;border: 1px solid;">File Deleted successfully!</p>');
              $('#uploadStatus').html('<div class="alert alert-outline-success alert-dismissible fade show"><button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span> </button><strong>Success</strong> File Deleted successfully!</div>');
              $('button[data-id="'+icon_id+'"]').parent().parent().remove();
              window.location.reload();
            }else if(resp.success){
              // $('#uploadStatus').html('<p style="color:#EA4335;font-size: 18px;padding: 11px;border: 1px solid;">Already Deleted!</p>');
              $('#uploadStatus').html('<div class="alert alert-outline-success alert-dismissible fade show"><button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span> </button><strong>Success</strong> Already Deleted!</div>');
            }
          }

        })
      }else{
        return false;
      }
    });


  }


 // new $.fn.dataTable.FixedHeader( table );
});