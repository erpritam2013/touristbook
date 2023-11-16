(function($){
     var base_url = $("#base-url").val();

     const processedLocationDetailHtml = function(data,id){
            if (data != '') {
             $(id).html(data);
            }
	}

	   // Function to show the loader
const showLoader = function() {
    $(".map-content-loading").show();
}

    // Function to hide the loader
const hideLoader = function() {
    $(".map-content-loading").hide();
}

	window.fetchDestinaitonDetail = function(ele){

    let get_id = $(ele).attr('href');
    let target_element = $(ele).data('target_element');
    let location_id = $('.destination-all-content').data('location_id');

    if (typeof target_element != 'undefined') {
        let endpoint = base_url + "/location-detail-fetch/"+target_element;
     
        $.ajax({
            type: "GET",
            dataType: "html",
            url: endpoint,
            data: {location_id},
             beforeSend: showLoader,
             complete: hideLoader,
            success: function (response) {
                processedLocationDetailHtml(response,get_id);
            },
            error:function(response) {
            	 alert('something went wrong!')
            }
        });
    }
	}

	let places = $('body #places');
	if (places.length != 0) {
		if ($(places).hasClass('active')) {
			let ele = $('a[href="#places"]');
			fetchDestinaitonDetail(ele);
		}
	}

	
})(jQuery);