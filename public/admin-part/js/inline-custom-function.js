(function($){
    "use strict"
    var base_url = $("#base-url").val();
    var preloader = $('body div#preloader');
    var gallery_videos = new Array();; 
/*on range chnage calling*/	

    const showLoader = function() {
        $("#preloader").show();
    }

    // Function to hide the loader
    const hideLoader = function() {
        $("#preloader").hide();
    }
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

$('#vg-location-id').on('change',function(){
    let location = $(this).children('option:selected').text();
    $('#vg-name').val(location);
})



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
  // console.log(get_response);
  let galery_video_div = $('#gallery-videos');
  $(galery_video_div).html(get_response);
}

const filterArray = (arr) => {
   let get_result = [];
   for (var i = 0; i < arr.length; i++) {
    get_result[arr[i].name] = arr[i].value;
}
return get_result;
}

const matchArrayValue = (get_arr,value) => {
 console.log(get_arr);
 let result = false;
 get_arr.filter(function(v,i) {
    if (v.image_url == value) {
        result = true;
    } 
});   
 return result;
}
const isJSON = function(something) {
    if (typeof something != 'string')
        something = JSON.stringify(something);

    try {
        JSON.parse(something);
        return true;
    } catch (e) {
        return false;
    }
}

const showErrorHtml = function(image_url,err,get_html=false){
   $('#image_url-error').remove();
   let error_html = '<div id="image_url-error" class="invalid-feedback animated fadeInUp" style="display: block;">'+err+'</div>';
   if (!get_html) {
    image_url.after(error_html);
}else{

    let htmlObject = $(error_html);
    image_url.after( htmlObject[0]);
}
}

window.RomoveVideo = function(ele) {
    if (confirm('Are Sure Remove this Video')) {
        SubmitVideo(ele,'remove')
    }else{
        return false;
    }
}

const CardbodyIndexChanges = (text, idx) => {

        let pattern = /\[(\d+)\]/; // pattern [<number>] TODO: think better Solution

        let intentionPattern = /\-vsign-(\d+)/;



        let updatedText = text

        .replace(pattern, `[${idx}]`)

        .replace(intentionPattern, `-vsign-${idx}`);



        return updatedText;

    };

    const changeCardbodyOrder = (parentElem) => {

        let cardbodyElements = parentElem.find(".card-body");

        cardbodyElements.each((idx, liElem) => {

            $(liElem)

            .find("input, textarea")

            .each((controlIdx, control) => {

                let controlElem = $(control);

                let updatedName = CardbodyIndexChanges(

                    controlElem.attr("name"),

                    idx

                    );

                let updatedId = CardbodyIndexChanges(

                    controlElem.attr("id"),

                    idx

                    );

                controlElem.attr("name", updatedName);

                controlElem.attr("id", updatedId);

            });

        });

        parentElem.attr("index", cardbodyElements.length);

    };

    const convertArrayToObject = function(arr){
        let obj = new Object();
        for (var i = 0; i < arr.length; i++) {

            obj[i] = Object.assign({},arr[i]);
        }
        return obj;
    }

    window.SubmitVideo = function(ele=null,type=null){
        var formData_2 = new Object();

        var action ='';
        if (type == 'add') {

            let modal_id = $(ele);
            var formData = $(modal_id).find('#form-video-modal').serializeArray();
            // formData_2 = $(modal_id).find('#form-video-modal').serialize();
            let image_url = $(modal_id).find('#image_url');

            if (image_url.val() == "") {
        //  $('#image_url-error').remove();
        // let error_html = '<div id="image_url-error" class="invalid-feedback animated fadeInUp" style="display: block;">Please enter a video url</div>';
        // image_url.after(error_html);
                showErrorHtml(image_url,'Please enter a video url');
                return false;
            }else{
                $('#image_url-error').remove();
            }
            let gallery_videos_count = gallery_videos.length; 
            if (gallery_videos.length == 0) {
               gallery_videos.push(filterArray(formData));

               formData_2.gallery_videos = JSON.stringify(convertArrayToObject(gallery_videos));

           }else{ 
            if (matchArrayValue(gallery_videos,filterArray(formData).image_url)) {

               showErrorHtml(image_url,'This video already added!');
               return false;
           }else{  
               gallery_videos_count = gallery_videos.length; 
               gallery_videos.push(filterArray(formData))

               formData_2.gallery_videos = JSON.stringify(convertArrayToObject(gallery_videos));
               formData_2.video_index = gallery_videos_count;
           }

       }
    // let method = "POST";
       action = $(modal_id).find('#form-video-modal').attr('action');
   }else if(type == 'remove'){
    let video_id = $(ele).data('video_id');
    if (video_id != "") {
      formData_2.action = 'remove';
      formData_2.video_id = video_id;
  }else{
    let video_div = $(ele).parent().parent().parent().remove();
    let video_index = $(ele).data('video_index');
    action = $(ele).data('gallery_video_action');
   // changeCardbodyOrder($(ele).parent().parent().parent().parent());
    let removeItem = $(ele).parent().find('#image_url-vsign-'+video_index).val();
    let newgallery_videos = $.grep(gallery_videos, function(value) {
       return value.image_url != removeItem;
   });
    gallery_videos = newgallery_videos;
    //formData_2.video_index = video_index;
    formData_2.gallery_videos = JSON.stringify(convertArrayToObject(gallery_videos));
}
}

if ($('body #video-gallery-id').length) {
    action = $('body #video-gallery-id').data('gallery_video_action');
    formData_2.id = $('body #video-gallery-id').val();
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
    data: formData_2,
        // beforeSend: showLoader,
        // complete: hideLoader,
    success: function (response) {
     if (isJSON(response)) {
         let final_result = jQuery.parseJSON( response );
         showErrorHtml(image_url,final_result.error,true);
         let removeItem = $(image_url).val();
         let newgallery_videos = $.grep(gallery_videos, function(value) {
           return value.image_url != removeItem;
       });
         gallery_videos = newgallery_videos;
         return false;
     }
     if (type == 'add') {

        $('body #form-video-modal')[0].reset();
        $('#video-modal').modal('hide');
    }
    ShowVideos(response);

},
error:function(response){
   alert('something went wrong!');
},
});
}

if ($('body #video-gallery-id').length) {
 SubmitVideo();
}
window.modalClose = function(ele){
    $('#image_url-error').remove();
    $('body #form-video-modal')[0].reset();
}
window.CopyToClipboard = (elem) => {

     var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
          succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
  
  // Alert the copied text
  $('.prev-success').removeClass('d-none');
  setTimeout(function(){
  $('.prev-success').addClass('d-none');
  },3000)
    return succeed;
  //alert("Copied the text: " + copyText.text);
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
window.searchTerm = function(ele){
 let value = $(ele).val().toLowerCase();
 let term = $(ele).data('term');
    $(`body .${term} ul.checkbox-list li`).filter(function() {

      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
  });
}

}(jQuery))