$(document).ready(function () {

  var bulk_ids = [];
  // $('#icon').iconpicker();
  /* When input amenity type */
  var preloader = $('body div#preloader');

  /*term type js start*/
  $('body').on('input', '#term-type', function () {
    let userURL = $(this).data('url');
    let term_title = $(this).data('term_title');
    let term_name = $(this).attr('name');


    let term_type = $(this).children('option:selected').val();
    let existed_parent_id = $('#parent-id').data('existed_parent_id');
    let term_id = $("#term-id").data('id');
    let data = { term_type };
    if (typeof term_id != "undefined") {
      data = { term_type, 'id': term_id };
    }
    preloader.css({ 'z-index': 1 });
    preloader.show();
    let parent_id = $('#parent-id');
    parent_id.after(preloader);
    $.get(userURL, { term_type, 'id': term_id }, function (data) {
      $options = "";
      if (data.length != 0) {
        preloader.css({ 'z-index': 0 });
        preloader.hide();
        parent_id.find('option').remove();
        parent_id.append(new Option('Select ' + term_title + ' Parent', ""));
        $.each(data.data, function (index, value) {
          optionText = value.name;
          optionValue = value.id;

          if (typeof existed_parent_id != "undefined" && optionValue === parseInt(existed_parent_id)) {
            parent_id.append(new Option(optionText, optionValue, true, true));
          } else {

            parent_id.append(new Option(optionText, optionValue));
          }
        });
      } else {
        alert('something went wrong!');
      }
      //$(term_type).append(term_type);
    });
    $('.multi-select').select2();
  });

  /*term type js end*/


  /*delete entity type js start*/

  $('.entity-list').on('click', '.del_entity_form', function (event) {

    event.preventDefault();

    var id = $(this).attr('item_id');
    var text = $(this).data('text');

    if (confirm('Are You sure to delete this ' + text)) {

      var action = $('#delete_entity_form').attr('action');

      $('#delete_entity_form').attr('action', action + '/' + id);

      $('#delete_entity_form').submit();

    }

  });
  /*delete entity type js end*/
  /*bulk delete js start*/

  $('.entity-list').on('change', '.select-all', function (event) {

    if ($(this).is(':checked')) {
      $('.select-id').prop('checked', true);
      $('.all-a .bulk-delete').show();
    } else {

      $('.select-id').prop('checked', false);
      $('.all-a .bulk-delete').hide();
    }
  });
  $('.entity-list').on('change', '.select-id', function (event) {

    $('.select-id').each(function () {

      if (!$(this).is(':checked')) {
        $('.all-a .bulk-delete').hide();
        $('.select-all').prop('checked', false);
      } else {
        $('.all-a .bulk-delete').show();
      }
    });
  });

  $('.all-a').on('click', '.bulk-delete', function (event) {

    event.preventDefault();
    bulk_ids = [];
    // var id= $(this).attr('item_id');
    var text = $('#bulk_delete_entity_form').data('text');
    $('.select-id:checked').each(function () {
      bulk_ids.push(parseInt($(this).val()));
    })
    if (bulk_ids.length == 0) {
      alert('Please first check checkbox');
      return false;
    }

    var JsonBulk_ids = JSON.stringify(bulk_ids);
    $('#bulk_delete_entity_form input#ids').val(JsonBulk_ids);
    if (confirm('Are You sure to bulk delete this ' + text)) {

      // var action=$('#delete_entity_form').attr('action');

      // $('#delete_entity_form').attr('action', action);

      $('#bulk_delete_entity_form').submit();

    } else {
      bulk_ids = [];
      $('#bulk_delete_entity_form input#ids').val("");
    }

  });
  /*bulk delete js end*/
  /*term type js end*/

  /*change status js start*/
  $('.toggle-class').change(function () {
    var status = $(this).prop('checked') == true ? 1 : 0;
    var id = $(this).data('id');
    var ajaxurl = $(this).data('url');

    $.ajax({
      type: "GET",
      dataType: "json",
      url: ajaxurl,
      data: { 'status': status, id },
      success: function (data) {
        console.log(data.success)
      }
    });
  })
  /*change status js end*/



  

});
