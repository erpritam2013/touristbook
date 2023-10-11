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




}(jQuery))