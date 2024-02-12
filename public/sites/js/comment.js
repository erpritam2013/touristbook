(function () {
 const alert_html = (msg,status) => {
       let alr_html = "";
       if (status == 'success') {

          alr_html += `<div class="alert alert-success alert-dismissible alert-alt solid fade show login-success">`;
      }else{

       alr_html += `<div class="alert alert-danger alert-dismissible alert-alt solid fade show login-error">`;
   }

   alr_html += `<button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>`;
   if (status == 'success') {
    alr_html += `</button><strong>Success!</strong>&nbsp;${msg}</div>`;
}else{
    alr_html += `</button><strong>Error!</strong>&nbsp;${msg}</div>`;

}
return alr_html;
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
        // beforeSend: showLoader,
        // complete: hideLoader,
    });
}

async function postDataByajax(endpoint,f_data) {
  try {
    const res = await postData(endpoint,f_data)
    console.log(res);


    //processedLocationDetailHtml(res,t_id);
} catch(err) {
    alert('something went wrong!');
    console.log(err);
}
}
$('#comment-form').submit(function(e){
	e.preventDefault();
	let form = $(this);
	let formData = $(this).serialize();
	let endpoint = $(this).attr('action');

    postDataByajax(endpoint,formData)
})
})();