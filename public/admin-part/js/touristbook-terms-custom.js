   $(document).ready(function () {

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

let loginForm = $("#ajax-login-form");
let login_action = $("#ajax-login-form").attr('action');
loginForm.submit(function(e){

    e.preventDefault();

    var formData = loginForm.serialize();
    $.ajax({
        type:'POST',
        url:login_action,
        dataType: 'json',
        headers: {'X-CSRF-TOKEN': $("#login-modal").attr('data-csrf')},
        data:formData,
        success:function(data){
                $('.login-success').remove();
                $('.login-error').remove();
               
            data.auth == false ? $("#login-modal").modal("show"): $(loginForm).before(alert_html('Successfully Logged','success'));
            $("#login-modal").modal("hide");
            
            
            
            
        },
        error: function (data) {
             $('.login-success').remove();
             $('.login-error').remove();
        
             if (data.status == 302) {
               
                $(loginForm).before(alert_html(data.responseJSON.email,'error'));
            }else{
                $(loginForm).before(alert_html('something went wrong!','error'));
                window.location.reload();
            }
        
        }
    });
});

const timer = function()
{
    console.log('here');
    $.get( "/ajax/login-status",function( data )
    {
        if (data.auth == false) {
          $('.login-success').remove();
          $('.login-error').remove();
          $("#login-modal").modal("show");
          $("#login-modal").attr('data-csrf',data.token);
      }else{
          $("#login-modal").modal("hide");
      }
  });
}

setInterval(function() {timer();}, 60000);

var bulk_ids = [];
     // $('#icon').iconpicker();
       /* When input amenity type */
var preloader = $('body div#preloader');
if ($('#get_image').length != 0) {

    get_image.onchange = evt => {
      const [file] = get_image.files

      if (file) {
        show_image.src = URL.createObjectURL(file)
    }
}
}

$('body .dataTables_paginate .paginate_button').on('click',function(){
   $('.toggle-class').bootstrapToggle()
});
const hideInput = (input_class,input_id,e_status) =>{

    if ($(`#${input_id}`).length != 0) {

        $(`.${input_class}`).addClass('d-none');
        $(`#${input_id}`).removeAttr('name');
        let existed_value = $(`#${input_id}`).data('existed_value');

        if (existed_value == "") {


            $(`#${input_id}`).val('');

        }else{

         $(`#${input_id}`).val(existed_value);

     }

 }
}

const callAjax = (ajaxurl,data) => {
   $.ajax({
    type: "GET",
    dataType: "json",
    url: ajaxurl,
    data: data,
    success: function(data){
      console.log(data.success)
  }
});
}

const showInput = (input_class,input_id) =>{
    $(`.${input_class}`).removeClass('d-none');
    $(`#${input_id}`).attr('name',input_id.replace('-','_'));
    let existed_value = $(`#${input_id}`).data('existed_value');
    if (existed_value == "") {
        $(`#${input_id}`).val('');
    }else{

        let existed_value = $(`#${input_id}`).data('existed_value');
        if (typeof existed_value != 'undefined') {

            $(`#${input_id}`).val(existed_value);
        }
        
    }
}
const showInputByType = (type) => {
    /*input show and hide by type change*/
    if (type == 'Location') {
        hideInput('icon','icon');
        hideInput('attachment','get_image');
        showInput('lebal-type','lebal-type');
    }else if(type == 'Tour'){
        hideInput('icon','icon');
        hideInput('lebal-type','lebal-type');
        showInput('attachment','get_image');
    }else{
        hideInput('attachment','get_image');
        hideInput('lebal-type','lebal-type');
        showInput('icon','icon');
    }
}


const checkbox_false = () =>{
    $('body .select-all').prop('checked',false);
}
const checkbox_true = () =>{
    $('body .select-all').prop('checked',true);
}

let type_form = $('#type-form');

if (type_form.length != 0) {

    let term_type_input = $('#term-type');
    if (term_type_input.length != 0) {
        let type_value = $(term_type_input).children('option:selected').val();
        if (type_value != "") {
            showInputByType(type_value);
        }
    }
}

$('body').on('change','select[name="touristbook-datatable_length"]',function(){
    checkbox_false();
    $('.all-a .bulk-delete').hide();
})
/*term type js start*/
$('body').on('change', '#term-type', function () {

  let first_option_text = {'text':$(this).children('option:first-child').text()}
  let userURL = $(this).data('url');
  let term_title = $(this).data('term_title');
  let term_name = $(this).attr('name');


  let term_type = $(this).children('option:selected').val();
  /*input show and hide by type change*/
  let type_form = $('#type-form');
  if (type_form.length != 0) {
      showInputByType(term_type);
  }
  let existed_parent_id = $('#parent-id').data('existed_parent_id');
  let term_id = $("#term-id").data('id');
  let data = {term_type};
  if (typeof term_id != "undefined") {
   data = {term_type,'id':term_id};
}
preloader.css({'z-index': 1});
preloader.show();
let parent_id = $('#parent-id');
parent_id.after(preloader);
$.get(userURL,{term_type,'id':term_id},function (data) {
    $options = "";
    if (data.length != 0) {
        preloader.css({'z-index': 0});
        preloader.hide();
        parent_id.find('option').remove();
        parent_id.append(new Option('Select '+term_title+' Parent', ""));
        $.each(data.data,function(index,value){
            optionText = value.name;
            optionValue = value.id;

            if (typeof existed_parent_id != "undefined" && optionValue === parseInt(existed_parent_id)) {
                parent_id.append(new Option(optionText, optionValue,true, true));
            }else{

                parent_id.append(new Option(optionText, optionValue));
            }
        });
    }else{
        alert('something went wrong!');
    }
            //$(term_type).append(term_type);
});



// $('body').on('click','.select2-selection__clear',function(){

//    $(this).closest('select').children('option:first-child').attr('selected','selected');
// })
// $('.single-select-placeholder-touristbook').select2({
//   placeholder: {
//           id: '-1', // the value of the option

//       },
//       allowClear: true
//   });
// delete first_option_text;
});



/*term type js end*/

/*list-activity_zones start js*/

// const runProgramStyle = (options) => {
//     options.each(function(key,ele){
//       if ($(ele).is(':selected')) {
//         showActivityProgramStyle(ele.value);
//     }

// });
// }
const runProgramStyle = (options) => {
    options.each(function(key,ele){
        if (typeof $(ele).data('target') != 'undefined') {
         let target = $(ele).data('target');
         if ($(ele).is(':selected')) {
           let value = $(ele).val();
           showProgramStyle(value,target);
       }
   }

});
}
const showProgramStyle = (value,target) => {
  if (value != "") {
    if (value == 'style1') {
       $(`.${target}-style1`).removeClass('d-none');
       $(`.${target}-style2`).addClass('d-none');
       $(`.${target}-style4`).addClass('d-none');
   }else if(value == 'style2'){
      $(`.${target}-style2`).removeClass('d-none');
      $(`.${target}-style1`).addClass('d-none');
      $(`.${target}-style4`).addClass('d-none');
  }else if (value == 'style3') {
   $(`.${target}-style1`).removeClass('d-none');
   $(`.${target}-style2`).addClass('d-none');
   $(`.${target}-style4`).addClass('d-none');
}else if (value == 'style4') {
   $(`.${target}-style4`).removeClass('d-none');
   $(`.${target}-style2`).addClass('d-none');
   $(`.${target}-style1`).addClass('d-none');
}
}else{
    $(`.${target}-style1`).addClass('d-none');
    $(`.${target}-style2`).addClass('d-none');
    $(`.${target}-style4`).addClass('d-none');
}
}

// let activity_program_style = $('body #activity-program-style');
// let activity_program_style_options = $(activity_program_style).children('option');
if ($('select').hasClass('program-style-select')) {
    let program_style_select_options = $('select.program-style-select').children('option');

// console.log($(program_style_select_options[0]).is(':checked'))

    runProgramStyle(program_style_select_options);
}
$('select').on('change',function(){
    if ($(this).hasClass('program-style-select')) {
      let program_style_select_options = $('select.program-style-select').children('option');
      runProgramStyle(program_style_select_options);
  }
});

// const showTourProgramStyle = (value) => {
//   if (value != "") {
//     if (value == 'style1') {
//      $(`.tour-program-style1`).removeClass('d-none');
//      $(`.tour-program-style2`).addClass('d-none');
//  }else if(value == 'style2'){
//   $(`.tour-program-style2`).removeClass('d-none');
//   $(`.tour-program-style1`).addClass('d-none');
// }else if (value == 'style3') {
//  $(`.tour-program-style1`).removeClass('d-none');
//  $(`.tour-program-style2`).addClass('d-none');
// }
// }else{
//     $(`.tour-program-style1`).addClass('d-none');
//     $(`.tour-program-style2`).addClass('d-none');
// }
// }

// let tour_program_style = $('body #tour-program-style');
// let tour_program_style_options = $(tour_program_style).children('option');

// runTourProgramStyle(tour_program_style_options);
// $(tour_program_style).on('change',function(){
//    runTourProgramStyle(tour_program_style_options);
// });


let activity_post_activity_zone_list = $('body .list-activity_zones').children('li.subform-card');

$('body .list-activity_zones').on('change','.activity_zones-url_link_status',function(){
 let value = $(this).children('option:selected').val();
 let activity_post_activity_zone_list = $(this).closest('.list-activity_zones').children('li.subform-card');
 let closest_parent = $(this).closest('li.subform-card');
 let activity_zones_slug = $(closest_parent).find('.activity_zones-slug');
 let activity_zones_file = $(closest_parent).find('.activity_zones-file');
 let activity_zones_web_link = $(closest_parent).find('.activity_zones-web_link');
 if (value != '') {

  if (value == 'slug') {

    $(activity_zones_slug).closest('.form-group').removeClass('d-none');
    $(activity_zones_file).closest('.form-group').addClass('d-none');
    $(activity_zones_web_link).closest('.form-group').addClass('d-none');

}
if (value == 'web-link') {
    $(activity_zones_slug).closest('.form-group').addClass('d-none');
    $(activity_zones_file).closest('.form-group').addClass('d-none');
    $(activity_zones_web_link).closest('.form-group').removeClass('d-none');
}
if (value == 'file') {
    $(activity_zones_slug).closest('.form-group').addClass('d-none');
    $(activity_zones_file).closest('.form-group').removeClass('d-none');
    $(activity_zones_web_link).closest('.form-group').addClass('d-none');
}
}else{
    $(activity_zones_slug).closest('.form-group').addClass('d-none');
    $(activity_zones_file).closest('.form-group').addClass('d-none');
    $(activity_zones_web_link).closest('.form-group').addClass('d-none');
}
});
// console.log(activity_post_activity_zone_list);
/*list-activity_zones end js*/

/*on off button start js*/

const show_st_external_booking_link = (v,ele) =>{
   if (v == 1) {
      $(`${ele}`).removeClass('d-none');
  }else if(v == 0){
      $(`${ele}`).addClass('d-none');
      $(`${ele}`).find('input').val('').trigger('change');
      $(`${ele}`).find('select').val('').trigger('change');
  }
}

if ($('input[type="radio"]').is(':checked') && typeof $('input[type="radio"]').data('target') != 'undefined') {
    if ($('input[type="radio"]:checked').val() == 1) {
      show_st_external_booking_link(1,$('input[type="radio"]:checked').data('target'));
  }
}


$('input[type="radio"]').on('input',function(){

    let current_input = $(this);
    let closest_parent = $(this).closest('.on-off-switch');
    let closest_a_i_parent = $(this).closest('.active-inactive-switch');
    let value = $(this).val();
    if (closest_parent.length == 1) {

      if (value == 1) {
       $(this).parent('label').removeClass('on-switch');
       $(this).parent('label').addClass('on-switch-checked');
       $(closest_parent).find('.off-switch-checked').addClass('off-switch');
       $(closest_parent).find('label').removeClass('off-switch-checked');
   }else if(value == 0){
       $(this).parent('label').removeClass('off-switch');
       $(this).parent('label').addClass('off-switch-checked');
       $(closest_parent).find('.on-switch-checked').addClass('on-switch');
       $(closest_parent).find('label').removeClass('on-switch-checked');
   }
}

if (closest_a_i_parent.length == 1) {

    if (value == 1) {
       $(this).parent('label').removeClass('active-switch');
       $(this).parent('label').addClass('active-switch-checked');
       $(closest_a_i_parent).find('.inactive-switch-checked').addClass('inactive-switch');
       $(closest_a_i_parent).find('label').removeClass('inactive-switch-checked');
   }else if(value == 0){
       $(this).parent('label').removeClass('inactive-switch');
       $(this).parent('label').addClass('inactive-switch-checked');
       $(closest_a_i_parent).find('.active-switch-checked').addClass('active-switch');
       $(closest_a_i_parent).find('label').removeClass('active-switch-checked');
   }
}

if ($(current_input).is(':checked') && typeof $(current_input).data('target') != 'undefined') {

  show_st_external_booking_link(value,$(current_input).data('target'));

}

});
/*on off button end js*/

/*search location input js start*/

$("#search_location").on("keyup", function() {
    let value = $(this).val().toLowerCase();
    $("body .location-list ul.checkbox-list li").filter(function() {

      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
  });
});
/*search location input js end*/
/*Add Term by ajax js start*/


$('body .card-footer.term-footer').on('click','.accordion__header',function(){
   let target_div_id = $(this).data('target');
   $(target_div_id).find('input').val('');
   $(target_div_id).find('select').val('').trigger('change');
});

$('body').on('click','.ajax-new-term-store',function(){
    console.log($(this).closest('.accordion__item').find('.accordion__header').data('target'));

    let current_div =  $(this);
    let parent_main_card_div = $(current_div).closest('.card-footer').parent('.card');
    if (parent_main_card_div.hasClass('term-card-padding')) {
      let li_count = parent_main_card_div.find('.card-body').find('.checkbox-list li').length;
      
      if (li_count > 10) {
       $(parent_main_card_div).addClass('term-card');
       $(parent_main_card_div).removeClass('term-card-padding');
   }
}

let parent_div = $(this).closest('.card-footer').prev('.card-body');
console.log(parent_div);
let target_div_id = $(this).closest('.accordion__item').find('.accordion__header').data('target');
let name = $(target_div_id).find('input').val();

if (name == "") {
  $('body').find('#name-error-term').remove();
  let msg = 'Please enter a name';
  let div_error = `<div id="name-error-term" class="invalid-feedback animated fadeInUp" style="display: block;">${msg}</div>`;
  $(target_div_id).find('input').after(div_error);
  setTimeout(function(){
    $('body').find('#name-error-term').remove();
},3000);
  return false;
}
let checkbox_input = $(parent_div).find('ul.checkbox-list').find('input[type="checkbox"]');
console.log(checkbox_input);
var selected_terms = [];
$.each(checkbox_input,function(i,ele){

 if ($(ele).prop('checked')==true) {
    selected_terms.push(parseInt($(ele).val()));
}
});


let term = $(target_div_id).data('term');
let field_name = $(target_div_id).data('field_name');
let term_type = $(target_div_id).data('term_type');
let post_type = $(target_div_id).data('term_post_type');
let ajaxurl = window.location.origin+'/admin/ajax-term-store';
let parent_id = $(target_div_id).find('select').children('option:selected').val();
let term_form_data = {name,parent_id,term,term_type,post_type,field_name,'selected_terms':JSON.stringify(selected_terms)};

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    }
});

    // console.log(term_form_data);return false;
$.ajax({
    type: "POST",
    dataType: 'json',
    url: ajaxurl,
    data: term_form_data,
    success: function(response){

        if (response.status == 200) {
          if (response.data.ul_html != "") {
            $(parent_div).find('ul.checkbox-list').remove();
            $(parent_div).append(response.data.ul_html)
        }
        if (response.data.new_term != "") {
            let optionText = response.data.new_term.name;
            let optionValue = response.data.new_term.id;
            $(target_div_id).find('select').append(new Option(optionText, optionValue));
        }
        console.log(response.msg);
        $(current_div).closest('.accordion__item').find('.accordion__header').addClass('collapsed');
        $(current_div).closest('.accordion__item').find('.accordion__body').removeClass('show');
        $(target_div_id).find('input').val('');
        $(target_div_id).find('select').val('');
    }

    if (response.status == 409) {
      $('body').find('#name-error-term').remove();
      let msg = response.msg;
      let div_error = `<div id="name-error-term" class="invalid-feedback animated fadeInUp" style="display: block;">${msg}</div>`;
      $(target_div_id).find('input').after(div_error);
      setTimeout(function(){
        $('body').find('#name-error-term').remove();
    },3000);
      return false;
  }  
},
error:function(response){
    alert('something went wrong!');
}
});
});


/*Add Term by ajax js end*/


/*delete entity type js start*/

$('.entity-list').on('click', '.del_entity_form', function(event) {

    event.preventDefault();           

    let id= $(this).attr('item_id');
    let text= $(this).data('text');

    if(confirm('Are You sure to delete this '+text)){   

     let action=$('#delete_entity_form').attr('action');

     $('#delete_entity_form').attr('action', action+'/'+id);

     $('#delete_entity_form').submit();

 }

});
/*delete entity type js end*/ 
/*bulk delete js start*/ 

// $('.entity-list').on('change', '.select-all', function(event) {


// });

window.CustomSelectCheckboxAll = function(ele){
  if ($(ele).is(':checked')) {
      $('.select-id').prop('checked',true);
      $('.all-a .bulk-delete').show();
  }else{

    $('.select-id').prop('checked',false);
    $('.all-a .bulk-delete').hide();
}
}

window.CustomSelectCheckboxSingle = function(ele){
    let unchecked_cb = $('.select-id:not(:checked)').length;
    let checked_cb = $('.select-id:checked').length;
    console.log(unchecked_cb);
    console.log(checked_cb);
    $('.select-id').each(function(){

      if (!$(ele).is(':checked')) {
        if (unchecked_cb != 0) {
            if (checked_cb != 0) {
                $('.all-a .bulk-delete').show();
                checkbox_false();
            }else{

                $('.all-a .bulk-delete').hide();
                checkbox_false();
            }

        }
    }else{
        if (unchecked_cb == 0) {
            checkbox_true();
        }
        $('.all-a .bulk-delete').show();
    }
});


}
// $('.entity-list').on('change', '.select-id', function(event) {


// });
const bulk_ids_fu = function(){
    bulk_ids = [];
    $('.select-id:checked').each(function(){
       bulk_ids.push(parseInt($(this).val()));
   })
}
$('.all-a').on('click', '.bulk-delete', function(event) {

    event.preventDefault();           
    
       // var id= $(this).attr('item_id');
    let text= $('#bulk_delete_entity_form').data('text');
    bulk_ids_fu();
    if (bulk_ids.length == 0) {
        alert('Please first check checkbox');
        return false;
    }

    let JsonBulk_ids = JSON.stringify(bulk_ids);
    $('#bulk_delete_entity_form input#ids').val(JsonBulk_ids);
    if(confirm('Are You sure to bulk delete this '+text)){   

         // let action=$('#delete_entity_form').attr('action');

         // $('#delete_entity_form').attr('action', action);

     $('#bulk_delete_entity_form').submit();

 }else{
    bulk_ids = [];
    $('#bulk_delete_entity_form input#ids').val("");
}

});
/*bulk delete js end*/
/*term type js end*/

        /*change status js start*/
$('body').on('change','.toggle-class',function() {
    let status = $(this).prop('checked') == true ? 1 : 0; 
    let id = $(this).data('id'); 
    let ajaxurl = $(this).data('url'); 
    let data = {'status': status, id};
    callAjax(ajaxurl,data);
})
if (typeof(CKEDITOR) != 'undefined') {    
    CKEDITOR.on('instanceReady',
     function( evt )
     {
        var editor = evt.editor;
        editor.on('maximize',function(){
            $('#main-wrapper').addClass('show');
        });
    });
}
        /*change status js end*/
// window.addTag = () =>{
//     let a_tag = '<a class="paginate_button d-none custom_paginate_button" aria-controls="touristbook-datatable" tabindex="0" data-dt-idx="8"></a>';
//     $('body .dataTables_paginate').find('.paginate_button').last().after(a_tag);
// }

// $('.proceed_page').on('click',function(){
//     let custom_page_no = $('#custom_page_no').val();
//     if (custom_page_no != "") {
//        let custom_paginate_button = $('body .dataTables_paginate').find('.custom_paginate_button').first();
//        $(custom_paginate_button).text(custom_page_no);
//        $(custom_paginate_button).trigger('click');
//     }
// })
});
