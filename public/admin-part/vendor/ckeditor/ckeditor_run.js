// // jQuery('#setting_hotel_transport .format-setting-inner > a.option-tree-list-item-add').on('click',function(){
// // 	alert('here');
// // })

// jQuery(document).on('click', '.option-tree-list-item-add', function(e){
// 	//alert('here');


// });

jQuery(document).ready(function($){


    

   var input_html = '<input placeholder="Type to search" type="text" class="widefat form-control"  id="near_by_place_search" value="">';
   
    $('#setting_near_by_place_location').find('.description').html(input_html);
    

     $("#near_by_place_search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#setting_near_by_place_location .format-setting-inner p").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

     var input_html_tour = '<input placeholder="Country to search" type="text" class="widefat form-control" id="rs_filter_location_country_tour_search" value="">';
$('#setting_rs_filter_location_country_tour').find('.description').html(input_html_tour);

     $("#rs_filter_location_country_tour_search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#setting_rs_filter_location_country_tour .format-setting-inner p").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });



     $('#setting_rs_filter .list-list-item').each(function($k,$v){
        console.log($k);
     })
	$('#setting_hotel_transport, #setting_hotel_offer_package, #setting_hotel_activities_to_do, #setting_tourism_zone, #setting_save_your_pocket, #setting_place_to_visit, #setting_save_your_environment, #setting_how_to_reach, #setting_shopaholics_anonymous, #setting_faqs, #setting_things_to_take_care_of, #setting_hotel_emergency_links, #setting_by_aggregators, #setting_b_govt_subsidiaries, #setting_by_hotels, #setting_tourism_zone_pdf, #setting_save_your_pocket_pdf, #setting_important_notices_data, #setting_get_to_know, #setting_tour_tourism_zone_pdf').find('a.option-tree-list-item-add').on('click',function(){
        
             var get_existed_editor_fields_length = $(this).parent().find('textarea').length;
             var get_p_id = $(this).parent().parent().parent().parent().attr('id');
               // setTimeout(myGreeting(get_existed_editor_fields_length,this), 3000);
                var html = '<div id="loading_traveler"></div>';
                $('#'+get_p_id).append(html);
            setTimeout(function() {
             var new_id = $('#'+get_p_id).find('textarea').last().attr('id');
             // console.log(new_id);
   $('#'+new_id).ckeditor();
   $('#loading_traveler').remove();
}, 5000);


               // function myGreeting(get_length,ele) {
               //          console.log($(ele).find('#hotel_new_description_description_'+get_existed_editor_fields_length));
               //       $(ele).find('#hotel_new_description_description_'+get_existed_editor_fields_length).ckeditor();

               // } 

       });


    $('#setting_hotel_transport, #setting_hotel_offer_package, #setting_hotel_activities_to_do, #setting_tourism_zone, #setting_save_your_pocket, #setting_place_to_visit, #setting_save_your_environment, #setting_how_to_reach, #setting_shopaholics_anonymous, #setting_faqs, #setting_things_to_take_care_of, #setting_hotel_emergency_links, #setting_by_aggregators, #setting_b_govt_subsidiaries, #setting_by_hotels, #setting_tourism_zone_pdf, #setting_save_your_pocket_pdf, #setting_important_notices_data, #setting_get_to_know, #setting_tour_tourism_zone_pdf').each(function(){
        var textarea_all = $(this).find('textarea');
       // console.log(textarea_all);
        $.each(textarea_all,function(i, val){
        //  console.log($(val).attr('id'));
           $('#'+$(val).attr('id')).ckeditor();
        });

    });


});