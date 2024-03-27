(function () {

    let base_url = $('#base-url').val();
    let start = 5;
    const showLoader = function() {
        $(".map-content-loading").show();
    }

    // Function to hide the loader
    const hideLoader = function() {
        $(".map-content-loading").hide();
    }

    const alert_html = (msg,status) => {
       let alr_html = "";
       $('.msg-alert').remove();
       if (status == 'success') {

          alr_html += `<div class="alert alert-success alert-dismissible alert-alt solid fade show login-success msg-alert">`;
      }else{

       alr_html += `<div class="alert alert-danger alert-dismissible alert-alt solid fade show login-error msg-alert">`;
   }

   alr_html += `<button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="fa">&#xf00d;</i></span>`;
   if (status == 'success') {
    alr_html += `</button><strong>Success!</strong>&nbsp;${msg}</div>`;
}else{
    alr_html += `</button><strong>Error!</strong>&nbsp;${msg}</div>`;

}
return alr_html;
}
const comment_html = function(data){
  let html = "";
  html +=`<div class="media d-block d-sm-flex review">`;

  html +=`<div class="media-body">`;
  html +=`<h6 class="mt-2 mb-1 comment-author">${data.name}</h6>`;
  html +=`<div class="mb-2">`;
  if (data.star_rating > 0) {

  for (let i = 0; i < data.star_rating; i++) {     
      html +=`<i class="fa fa-xs fa-star text-primary"></i>`;
  }
  }
  html +=`</div>`;
  html +=`<p class="text-muted text-sm">${data.comments}</p>`;
  html +=`</div>`;
  html +=`</div>`;
  return html;
}
const login_status = function()
{
    $.get( "/ajax/login-status",function( data )
    {
        if (data.auth == false) {
          // $('.login-success').remove();
          // $('.login-error').remove();
          // $("#login-modal").modal("show");
         $('meta[name="csrf-token"]').attr('content',data.token);
         return true;
         // $("#login-modal").attr('data-csrf',data.token);
     }else{	
      return false;
  }
});
}

const postData = function(ajaxurl,form_data) { 

    return $.ajax({
        type: "POST",
        dataType: "json",
        url: ajaxurl,
        beforeSend: login_status(),
        headers: {

            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        data: form_data,
        beforeSend: showLoader,
        complete: hideLoader,
    });
}
const getData = function(ajaxurl,form_data) { 

    return $.ajax({
        type: "GET",
        dataType: "json",
        url: ajaxurl,
        data: form_data,
        beforeSend: showLoader,
        complete: hideLoader,
    });
}

async function loadMoreComments(endpoint,f_data){
  try {
    
    const res = await getData(endpoint,f_data);
    
    if (res.data.length > 0) {
        var html = '';
        for (var i = 0; i < res.data.length; i++) {
            html += comment_html(res.data[i]);
        }
                            //console.log(html);
                            //append data  without fade in effect
                            //$('#items_container').append(html);

                            //append data with fade in effect
        $('#reviews-list').append($(html).hide().fadeIn(1000));
        $('#load_more_button').html('Load More');
        $('#load_more_button').attr('disabled', false);
        start = res.next;
    } else {
        if ($('body').hasClass('post-detail-page')) {

        $('#load_more_button').html('No More Reviews Available');
        }else{
        $('#load_more_button').html('No More Comments Available');
        }
        $('#load_more_button').attr('disabled', true);
    }
} catch(err) {
    alert('something went wrong!');
    //console.log(err);
}
}

async function postDataByajax(endpoint,f_data) {
  try {
    const res = await postData(endpoint,f_data)
    if (!res.auth){
        window.location.reload();
        $('#comment-form').find('button.review-btn').before(alert_html(res.message,'error'));
    }

    if (res.already_existed){
        $('#comment-form')[0].reset();
        $('#comment-form').find('button.review-btn').before(alert_html(res.message,'error'));
    }else if(res.status){
        $('#comment-form')[0].reset();
    // $('#reviews-list').find('.review').first().before(comment_html(res.result));
        window.location.reload();
        $('#comment-form').find('button.review-btn').before(alert_html(res.message,'success'));
    }
    
    //processedLocationDetailHtml(res,t_id);
} catch(err) {
    alert('something went wrong!');
    //console.log(err);
}
}
$('#comment-form').submit(function(e){
	e.preventDefault();
	let form = $(this);
	let formData = $(this).serialize();
	let endpoint = $(this).attr('action');

    postDataByajax(endpoint,formData)
})

$('#load_more_button').on('click',function(e){
    e.preventDefault();
    let params = new Object();
    params.start = start;
    params.model_id = $(this).data('model_id');
    params.model_type = $(this).data('model_type');

    let endpoint = base_url+'/load-comments';

    loadMoreComments(endpoint,params)
})


})();