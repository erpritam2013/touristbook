(function($){
"use strict"
/*on range chnage calling*/	
window.rangeValue = (ele) =>{

      // $('body #show-range-input').value(ele.value);
      document.getElementById("show_range_input").value = ele.value;
}

window.inputCondition = (ele) => {
	console.log(ele.name);
	console.log('activity_program_style');
}

}(jQuery))