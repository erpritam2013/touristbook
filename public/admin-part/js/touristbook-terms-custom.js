   $(document).ready(function () {

    var bulk_ids = [];
     // $('#icon').iconpicker();
       /* When input amenity type */
    var preloader = $('body div#preloader');
            /*amenity type js start*/
    $('body').on('input', '#amenity-type', function () {
      var userURL = $(this).data('url');


      var amenity_type = $(this).children('option:selected').val();
      var existed_parent_amenity = $('#amenity-parent').data('existed_parent_amenity');
      var amenity_id = $("#amenity-id").data('id');
      var data = {amenity_type};
      if (typeof amenity_id != "undefined") {
         data = {amenity_type,'id':amenity_id};
     }
     preloader.css({'z-index': 1});
     preloader.show();
     var amenity_parent = $('#amenity-parent');
     amenity_parent.after(preloader);
     $.get(userURL,{amenity_type,'id':amenity_id},function (data) {
        $options = "";
        if (data.length != 0) {
            preloader.css({'z-index': 0});
            preloader.hide();
            amenity_parent.find('option').remove();
            amenity_parent.append(new Option('Select amenity Parent', ""));
            $.each(data.data,function(index,value){
                optionText = value.name;
                optionValue = value.id;

                if (typeof existed_parent_amenity != "undefined" && optionValue === parseInt(existed_parent_amenity)) {
                    amenity_parent.append(new Option(optionText, optionValue,true, true));
                }else{

                    amenity_parent.append(new Option(optionText, optionValue));
                }
            });
        }else{
            alert('something went wrong!');
        }
            //$(amenity_type).append(amenity_type);
    });
     $('.multi-select').select2();
 });


   
/*amenity type js end*/
/*facility type js start*/
  $('body').on('input', '#facility-type', function () {
              var userURL = $(this).data('url');

              
              var facility_type = $(this).children('option:selected').val();
              var existed_parent_facitity = $('#facility-parent').data('existed_parent_facitity');
              var facility_id = $("#facility-id").data('id');
              var data = {facility_type};
              if (typeof facility_id != "undefined") {
               data = {facility_type,'id':facility_id};
           }
            preloader.css({'z-index': 1});
            preloader.show();
            var facility_parent = $('#facility-parent');
            facility_parent.after(preloader);
           $.get(userURL,{facility_type,'id':facility_id},function (data) {
            $options = "";
            if (data.length != 0) {
                preloader.css({'z-index': 0});
                preloader.hide();
             facility_parent.find('option').remove();
             facility_parent.append(new Option('Select Facility Parent', ""));
             $.each(data.data,function(index,value){
                optionText = value.name;
                optionValue = value.id;
               
                if (typeof existed_parent_facitity != "undefined" && optionValue === parseInt(existed_parent_facitity)) {
                    facility_parent.append(new Option(optionText, optionValue,true, true));
                }else{

                facility_parent.append(new Option(optionText, optionValue));
                }
            });
         }else{
            alert('something went wrong!');
         }
            //$(facility_type).append(facility_type);
     });
           $('.multi-select').select2();
       });

/*facility type js end*/
/*medicare assistance type js start*/

 $('body').on('input', '#medicare-assistance-type', function () {
              var userURL = $(this).data('url');

              
              var medicare_assistance_type = $(this).children('option:selected').val();
              var existed_parent_facitity = $('#medicare-assistance-parent').data('existed_parent_facitity');
              var medicare_assistance_id = $("#medicare-assistance-id").data('id');
              var data = {medicare_assistance_type};
              if (typeof medicare_assistance_id != "undefined") {
               data = {medicare_assistance_type,'id':medicare_assistance_id};
           }
            preloader.css({'z-index': 1});
            preloader.show();
            var medicare_assistance_parent = $('#medicare-assistance-parent');
            medicare_assistance_parent.after(preloader);
           $.get(userURL,{medicare_assistance_type,'id':medicare_assistance_id},function (data) {
            $options = "";
            if (data.length != 0) {
                preloader.css({'z-index': 0});
                preloader.hide();
             medicare_assistance_parent.find('option').remove();
             medicare_assistance_parent.append(new Option('Select Medicare Assistance Parent', ""));
             $.each(data.data,function(index,value){
                optionText = value.name;
                optionValue = value.id;
               
                if (typeof existed_parent_facitity != "undefined" && optionValue === parseInt(existed_parent_facitity)) {
                    medicare_assistance_parent.append(new Option(optionText, optionValue,true, true));
                }else{

                medicare_assistance_parent.append(new Option(optionText, optionValue));
                }
            });
         }else{
            alert('something went wrong!');
         }
            //$(medicare-assistance_type).append(medicare-assistance_type);
     });
           $('.multi-select').select2();
       });
/*medicare assistance type js end*/
    
/*top service type js start*/  

  $('body').on('input', '#top-service-type', function () {
              var userURL = $(this).data('url');

              
              var top_service_type = $(this).children('option:selected').val();
              var existed_parent_top_service = $('#top-service-parent').data('existed_parent_top_service');
              var top_service_id = $("#top-service-id").data('id');
              var data = {top_service_type};
              if (typeof top_service_id != "undefined") {
               data = {top_service_type,'id':top_service_id};
           }
            preloader.css({'z-index': 1});
            preloader.show();
            var top_service_parent = $('#top-service-parent');
            top_service_parent.after(preloader);
           $.get(userURL,{top_service_type,'id':top_service_id},function (data) {
            $options = "";
            if (data.length != 0) {
                preloader.css({'z-index': 0});
                preloader.hide();
             top_service_parent.find('option').remove();
             top_service_parent.append(new Option('Select Top Service Parent', ""));
             $.each(data.data,function(index,value){
                optionText = value.name;
                optionValue = value.id;
               
                if (typeof existed_parent_top_service != "undefined" && optionValue === parseInt(existed_parent_top_service)) {
                    top_service_parent.append(new Option(optionText, optionValue,true, true));
                }else{

                top_service_parent.append(new Option(optionText, optionValue));
                }
            });
         }else{
            alert('something went wrong!');
         }
            //$(top_service_type).append(top_service_type);
     });
           $('.multi-select').select2();
       });
/*top service type js end*/

  /*place type js start*/  

  $('body').on('input', '#place-type', function () {
              var userURL = $(this).data('url');

              
              var place_type = $(this).children('option:selected').val();
              var existed_parent_place = $('#place-parent').data('existed_parent_place');
              var place_id = $("#place-id").data('id');
              var data = {place_type};
              if (typeof place_id != "undefined") {
               data = {place_type,'id':place_id};
           }
            preloader.css({'z-index': 1});
            preloader.show();
            var place_parent = $('#place-parent');
            place_parent.after(preloader);
           $.get(userURL,{place_type,'id':place_id},function (data) {
            $options = "";
            if (data.length != 0) {
                preloader.css({'z-index': 0});
                preloader.hide();
             place_parent.find('option').remove();
             place_parent.append(new Option('Select Place Parent', ""));
             $.each(data.data,function(index,value){
                optionText = value.name;
                optionValue = value.id;
               
                if (typeof existed_parent_place != "undefined" && optionValue === parseInt(existed_parent_place)) {
                    place_parent.append(new Option(optionText, optionValue,true, true));
                }else{

                place_parent.append(new Option(optionText, optionValue));
                }
            });
         }else{
            alert('something went wrong!');
         }
            //$(place_type).append(place_type);
     });
           $('.multi-select').select2();
       });
/*place type js end*/

/*meeting and event type js start*/  

  $('body').on('input', '#meeting-and-event-type', function () {
              var userURL = $(this).data('url');

              
              var meeting_and_event_type = $(this).children('option:selected').val();
              var existed_parent_meeting_and_event = $('#meeting-and-event-parent').data('existed_parent_meeting_and_event');
              var meeting_and_event_id = $("#meeting-and-event-id").data('id');
              var data = {meeting_and_event_type};
              if (typeof meeting_and_event_id != "undefined") {
               data = {meeting_and_event_type,'id':meeting_and_event_id};
           }
            preloader.css({'z-index': 1});
            preloader.show();
            var meeting_and_event_parent = $('#meeting-and-event-parent');
            meeting_and_event_parent.after(preloader);
           $.get(userURL,{meeting_and_event_type,'id':meeting_and_event_id},function (data) {
            $options = "";
            if (data.length != 0) {
                preloader.css({'z-index': 0});
                preloader.hide();
             meeting_and_event_parent.find('option').remove();
             meeting_and_event_parent.append(new Option('Select Meeting And Event Parent', ""));
             $.each(data.data,function(index,value){
                optionText = value.name;
                optionValue = value.id;
               
                if (typeof existed_parent_meeting_and_event != "undefined" && optionValue === parseInt(existed_parent_meeting_and_event)) {
                    meeting_and_event_parent.append(new Option(optionText, optionValue,true, true));
                }else{

                meeting_and_event_parent.append(new Option(optionText, optionValue));
                }
            });
         }else{
            alert('something went wrong!');
         }
            //$(meeting_and_event_type).append(meeting_and_event_type);
     });
           $('.multi-select').select2();
       });
/*meeting_and_event type js end*/

 /*accessible type js start*/  

  $('body').on('input', '#accessible-type', function () {
              var userURL = $(this).data('url');

              
              var accessible_type = $(this).children('option:selected').val();
              var existed_parent_accessible = $('#accessible-parent').data('existed_parent_accessible');
              var accessible_id = $("#accessible-id").data('id');
              var data = {accessible_type};
              if (typeof accessible_id != "undefined") {
               data = {accessible_type,'id':accessible_id};
           }
            preloader.css({'z-index': 1});
            preloader.show();
            var accessible_parent = $('#accessible-parent');
            accessible_parent.after(preloader);
           $.get(userURL,{accessible_type,'id':accessible_id},function (data) {
            $options = "";
            if (data.length != 0) {
                preloader.css({'z-index': 0});
                preloader.hide();
             accessible_parent.find('option').remove();
             accessible_parent.append(new Option('Select accessible Parent', ""));
             $.each(data.data,function(index,value){
                optionText = value.name;
                optionValue = value.id;
               
                if (typeof existed_parent_accessible != "undefined" && optionValue === parseInt(existed_parent_accessible)) {
                    accessible_parent.append(new Option(optionText, optionValue,true, true));
                }else{

                accessible_parent.append(new Option(optionText, optionValue));
                }
            });
         }else{
            alert('something went wrong!');
         }
            //$(accessible_type).append(accessible_type);
     });
           $('.multi-select').select2();
       });
/*accessible type js end*/

   /*property type js start*/  

  $('body').on('input', '#property-type-type', function () {
              var userURL = $(this).data('url');

              
              var property_type_type = $(this).children('option:selected').val();
              var existed_parent_property_type = $('#property-type-parent').data('existed_parent_property_type');
              var property_type_id = $("#property-type-id").data('id');
              var data = {property_type_type};
              if (typeof property_type_id != "undefined") {
               data = {property_type_type,'id':property_type_id};
           }
            preloader.css({'z-index': 1});
            preloader.show();
            var property_type_parent = $('#property-type-parent');
            property_type_parent.after(preloader);
           $.get(userURL,{property_type_type,'id':property_type_id},function (data) {
            $options = "";
            if (data.length != 0) {
                preloader.css({'z-index': 0});
                preloader.hide();
             property_type_parent.find('option').remove();
             property_type_parent.append(new Option('Select Property Type Parent', ""));
             $.each(data.data,function(index,value){
                optionText = value.name;
                optionValue = value.id;
               
                if (typeof existed_parent_property_type != "undefined" && optionValue === parseInt(existed_parent_property_type)) {
                    property_type_parent.append(new Option(optionText, optionValue,true, true));
                }else{

                property_type_parent.append(new Option(optionText, optionValue));
                }
            });
         }else{
            alert('something went wrong!');
         }
            
     });
           $('.multi-select').select2();
       });
/*property type js end*/

/*delete entity type js start*/

$('.entity-list').on('click', '.del_entity_form', function(event) {

        event.preventDefault();           

        var id= $(this).attr('item_id');
        var text= $(this).data('text');

        if(confirm('Are You sure to delete this '+text)){   

         var action=$('#delete_entity_form').attr('action');

         $('#delete_entity_form').attr('action', action+'/'+id);

         $('#delete_entity_form').submit();

     }

 });
/*delete entity type js end*/ 
/*bulk delete js start*/ 

$('.entity-list').on('change', '.select-all', function(event) {
      
      if ($(this).is(':checked')) {
      $('.select-id').prop('checked',true);
      $('.all-a .bulk-delete').show();
  }else{

    $('.select-id').prop('checked',false);
    $('.all-a .bulk-delete').hide();
  }
});
$('.entity-list').on('change', '.select-id', function(event) {
      
      $('.select-id').each(function(){

      if (!$(this).is(':checked')) {
        $('.all-a .bulk-delete').hide();
        $('.select-all').prop('checked',false);
      }else{
        $('.all-a .bulk-delete').show();
      }
      });
});

$('.all-a').on('click', '.bulk-delete', function(event) {

        event.preventDefault();           
        bulk_ids = [];
       // var id= $(this).attr('item_id');
        var text= $('#bulk_delete_entity_form').data('text');
        $('.select-id:checked').each(function(){
           bulk_ids.push(parseInt($(this).val()));
        })
        if (bulk_ids.length == 0) {
            alert('Please first check checkbox');
            return false;
        }

        var JsonBulk_ids = JSON.stringify(bulk_ids);
        $('#bulk_delete_entity_form input#ids').val(JsonBulk_ids);
        if(confirm('Are You sure to bulk delete this '+text)){   
          
         // var action=$('#delete_entity_form').attr('action');

         // $('#delete_entity_form').attr('action', action);

         $('#bulk_delete_entity_form').submit();

     }else{
        bulk_ids = [];
        $('#bulk_delete_entity_form input#ids').val("");
     }

 });
/*bulk delete js end*/
/*facility type js end*/

        /*change status js start*/
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var id = $(this).data('id'); 
        var ajaxurl = $(this).data('url'); 

        $.ajax({
            type: "GET",
            dataType: "json",
            url: ajaxurl,
            data: {'status': status, id},
            success: function(data){
              console.log(data.success)
          }
      });
    })
        /*change status js end*/

});
