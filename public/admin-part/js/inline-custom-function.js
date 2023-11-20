(function($){
"use strict"

    var preloader = $('body div#preloader');
/*on range chnage calling*/	
window.rangeValue = (ele) =>{
      let id = ele.id;
      // $('body #show-range-input').value(ele.value);
      // document.getElementById(`${id}-range-input-show`).value = ele.value;

const rangeInputs = ele;
const numberInput = document.getElementById(`${id}_range_input_show`);
let isRTL = document.documentElement.dir === 'rtl'

function handleInputChange(e) {
  let target = e.target
  if (e.target.type !== 'range') {
    target = document.getElementById('range')
  } 
  const min = target.min
  const max = target.max
  const val = target.value
  let percentage = (val - min) * 100 / (max - min)
  if (isRTL) {
    percentage = (max - val) 
  }
  
  target.style.backgroundSize = percentage + '% 100%'
}
// console.log(rangeInputs)
// rangeInputs.forEach(input => {
//   input.addEventListener('input', handleInputChange)
// });

Array.prototype.forEach.call(rangeInputs, input => {
	console.log(input);
  input.addEventListener('input', handleInputChange)
});

numberInput.addEventListener('input', handleInputChange)

// Handle element change, check for dir attribute value change
function callback(mutationList, observer) {  mutationList.forEach(function(mutation) {
    if (mutation.type === 'attributes' && mutation.attributeName === 'dir') {
      isRTL = mutation.target.dir === 'rtl'
    }
  })
}

// Listen for body element change
const observer = new MutationObserver(callback)
observer.observe(document.documentElement, {attributes: true})
}

window.inputCondition = (ele) => {
	console.log(ele.name);
	console.log('activity_program_style');
}

function displayPopup() {
	console.log('activity_program_style');
}



/*country select show activity zone start js*/
window.showActivityZone = () => {
	 let id = $("#activity-id").data('id');
     let country = $('.activity-extra-fields #country').children('option:selected').val();
    let activity_zone_section = $('.activity-extra-fields #activity-zone-id');
     if (activity_zone_section.length != 0) {
        
    if (country != "" && typeof country != 'undefined') {

    $('.activity-zone-id-section').removeClass('d-none');
    let userURL = '/admin/activity/country/activity-zones';
    let fields_data = {};
    if (typeof id != 'undefined') {

       fields_data.id = id;
    }
    fields_data.country = country;
    console.log(fields_data);
    $.get(userURL,fields_data,function (data) {
    // let options = "";
    if (data.length != 0) {
        let existed_activity_zone_id = data.existed_value;
        preloader.css({'z-index': 0});
        preloader.hide();
        activity_zone_section.find('option').remove();
        activity_zone_section.append(new Option('Select Activity Zone', ""));
        $.each(data.data,function(index,value){
            let optionText = value.title;
            let optionValue = value.id;

            if (typeof existed_activity_zone_id != "undefined" && optionValue === parseInt(existed_activity_zone_id)) {
                activity_zone_section.append(new Option(optionText, optionValue,true, true));
            }else{

                activity_zone_section.append(new Option(optionText, optionValue));
            }
        });
    }else{
        alert('something went wrong!');
    }

});
}else{
	activity_zone_section.closest('.activity-zone-id-section').addClass('d-none');
	activity_zone_section.find('option').remove();
}
     }

};

showActivityZone();
/*country select show activity zone end js*/

/*country select show country zone start js*/
window.showCountryZone = () => {
     let id = $("#tour-id").data('id');
     let country = $('.tour-extra-fields #st-tours-country').children('option:selected').val();
    let country_zone_section = $('.tour-extra-fields #country-zone-id');
     //console.log(country_zone_section);
     if (country_zone_section.length != 0) {
        
    if (country != "" && typeof country != 'undefined') {

    $('.country-zone-id-section').removeClass('d-none');
    let userURL = '/admin/tour/country/country-zones';
    let fields_data = {};
    if (typeof id != 'undefined') {

       fields_data.id = id;
    }
    fields_data.country = country;
    console.log(fields_data);
    $.get(userURL,fields_data,function (data) {
    // let options = "";
    if (data.length != 0) {
        let existed_country_zone_id = data.existed_value;
        preloader.css({'z-index': 0});
        preloader.hide();
        country_zone_section.find('option').remove();
        country_zone_section.append(new Option('Select country Zone', ""));
        $.each(data.data,function(index,value){
            let optionText = value.title;
            let optionValue = value.id;

            if (typeof existed_country_zone_id != "undefined" && optionValue === parseInt(existed_country_zone_id)) {
                country_zone_section.append(new Option(optionText, optionValue,true, true));
            }else{

                country_zone_section.append(new Option(optionText, optionValue));
            }
        });
    }else{
        alert('something went wrong!');
    }

});
}else{
    country_zone_section.closest('.country-zone-id-section').addClass('d-none');
    country_zone_section.find('option').remove();
}
     }

};
showCountryZone();

const ShowVideos = function(get_response){
      
      let galery_video_div = $('#gallery-video');
      $(galery_video_div).html(get_response);
}

window.SubmitVideo = function(ele,type){
    if (type == 'add') {
    console.log(type);
    let modal_id = $(ele);
    var formData = $(modal_id).find('#form-video-modal').serialize();
    let image_url = $(modal_id).find('#image_url');
    
    if (image_url.val() == "") {
         $('#image_url-error').remove();
        let error_html = '<div id="image_url-error" class="invalid-feedback animated fadeInUp" style="display: block;">Please enter a video url</div>';
        image_url.after(error_html);
        return false;
    }else{
        $('#image_url-error').remove();
    }
    // let method = "POST";
    var action = $(modal_id).find('#form-video-modal').attr('action');
    }else if(type == 'remove'){
       // let method = "DELETE"; 
     console.log('panding..');
     return false;
    }
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        dataType: "html",
        url: action,
        data: formData,
        // beforeSend: showLoader,
        // complete: hideLoader,
        success: function (data) {
           ShowVideos(data);

       },
       error:function(data){
         alert('something went wrong!');
      },
  });
}

// $('.submit-video').on('click',function(){
//     console.log('hre');
//     let type = $(this).data('type');
//     let modal_id = $('#video-modal');
//     if (type == 'add') {
//         SubmitVideo(modal_id,type);

//     }else if (type == 'remove') {
//        return false;
//     }else if(type == 'close'){
//       $(modal_id).find('#form-video-modal')[0].reset();
//     }
// })

}(jQuery))