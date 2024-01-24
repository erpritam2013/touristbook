(function($){
     var base_url = $("#base-url").val();

     const processedLocationDetailHtml = function(data,id){
            if (data != '') {
             $(id).html(data);
            }

            setTimeout(function() {
                
                $('body.destination-detail-page #tab-tourism_zone #tourism-zone-div .tab-content td *,body.destination-detail-page #tab-tourism_zone #tourism-zone-div .tab-content th *').removeAttr('style')
                let btgrid_row_col = $('body .btgrid .row .col');
                $.each(btgrid_row_col,function(indx,item){
                    if ($(item).find('.content').length == 0) {
                    $(item).remove();
                //     console.log({'empty-text':$(item).find('.content').text()});
                // console.log(item);
                    }else if($(item).find('.content').length != 0 && $(item).find('.content').text() == ""){
                        $(item).remove();
                    // console.log({'empty-text':$(item).find('.content').text()});
                    // console.log(item);
                    }
                })

                $('body .btgrid .row .col .content *').removeAttr('style');
                $('#places-description .div-desc *,#best-time-to-visit-description .div-desc *,#tab-get_to_know .st-overview .st-description *,#how_to_reach .st-how-to-reach-description .long-description *,#tourism-zone-div .div-desc *').removeAttr('style');
            }, 1000);
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

    window.fetchWeather = (ele) => {
        let get_id = $(ele).attr('href');
    //let target_element = $(ele).data('target_element');
   // let location_id = $('.destination-all-content').data('location_id');
     let params = new Object();
    
    let lat = $(ele).data('lat');
    let long = $(ele).data('long');


    // params.exclude = 'current';

    // params.exclude = 'minutely';

    // params.exclude = 'hourly';

    // params.exclude = 'daily';

    // params.exclude = 'alerts';
   if (lat != '' && long != '') {
    params.lat = lat;
    params.lon = long;
   }else if($(ele).data('address') != "") {

    params.address = $(ele).data('address');
}else{
    params.name = $(ele).data('name');
    
}
    params.apikey = 'f4127c3b16b99a5ebebcb2180ea42f51';
    params.mode = 'html';


    
        //let endpoint = base_url + "/location-detail-fetch/"+target_element;
     
        $.ajax({
            type: "GET",
            dataType: "html",
             url: 'https://api.openweathermap.org/data/2.5/weather',
             data:params,
             beforeSend: showLoader,
             complete: hideLoader,
            success: function (response) {
                processedLocationDetailHtml(response,get_id);
            },
            error:function(response,data,message) {
               
                let final_result = jQuery.parseJSON( response.responseText );
                  alert(final_result.message)
            }
        });
   
    }

	

})(jQuery);