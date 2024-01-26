$(document).ready(function ($) {
    var base_url = $("#base-url").val();

    var preloader = $('body div#preloader');
    var no_modal = false;


    const showLoader = function() {
        $('.nav-pills .nav-link.active:after').css({'position':'relative'})
        preloader.css({'display':'block','z-index':9999});

    }

    // Function to hide the loader
    const hideLoader = function() {

        preloader.css({'display':'none','z-index':0});
        $('.nav-pills .nav-link.active:after').css({'position':'absolute'})
    }

    const showImagePrevHtml = function(tb_data){

        console.log(Object.keys(tb_data).length != 0);
        let html = '';
        if (Object.keys(tb_data).length != 0) {

           html +='<div class="form-group row">';
           html +='<img src="'+tb_data.imageUrl+'" width="250" height="250">';
           html +='</div>';
           html +='<div class="form-group row">';
           html +='<label>Title</label>';
           html +='<input class="form-control" id="tb-image-name-prev" readonly value="'+tb_data.title+'">';
           html +='</div>';
           html +='<div class="form-group row">';
           html +='<label>Image Url</label>';
           html +='<textarea class="form-control" id="tb-image-url-prev" readonly rows="5" title="'+tb_data.url+'">'+tb_data.url+'</textarea>';
           html +='</div>';
           html +='<div class="form-group row">';
           html +=`<button onclick="CopyToClipboard(document.getElementById('tb-image-url-prev'))" class="btn btn-sm btn-info">Copy Url to Clipboard</button>`;
           html +='<span class="prev-success d-none" aria-hidden="true" style="padding: 5px;color: green;">Copied!</span>';
           html +='</div>';
       }else{
          html += '<div class="show-prev-image-data">Show Image Preview!</div>';
      }
      return html;
  }

  $('.nav-link').on('click',function(){

    if ($(this).attr('href') == '#upload-media') {
        let obj_image = new Object();
        $('#tb-image-prev').html(showImagePrevHtml(obj_image));
    }
})
  $("#file-modal").on("hidden.bs.modal", function () {
    let obj_image = new Object();
    $('#tb-image-prev').html(showImagePrevHtml(obj_image));
});

  var base_admin_url = $("#base-admin-url").val();



    // Map Variable

  const addressTextboxSingle = document.getElementById("address");

  var addressTextbox = document.getElementById("map_address");

  var latitudeTextbox = document.getElementById("latitude");

  var longitudeTextbox = document.getElementById("longitude");

  var zoomTextbox = document.getElementById("zoom_level");



  var mapElem = document.getElementById("map");



  let touristEditorsElems = $(".tourist-editor");



    let mediaMode = "multiple"; // single / multiple

    let selectedImages = [];



    // Markers on Map : Assuming there will be one Map on a Page

    var markers = [];



    // Change Indexes of Subform

    const subformIndexChanges = (text, idx) => {

        let pattern = /\[(\d+)\]/g; // pattern [<number>] TODO: think better Solution

        let intentionPattern = /\-tsign-(\d+)\-tsign-/g;



        let updatedText = text

        .replace(pattern, `[${idx}]`)

        .replace(intentionPattern, `-tsign-${idx}-tsign-`);



        return updatedText;

    };



    const isJSON = (something) => {

        if (typeof something != 'string')

         something = JSON.stringify(something);



     try {

        JSON.parse(something);

        return true;

    } catch (e) {

        return false;

    }

}



    // Change Subform Ordering

const changeSubformOrder = (parentElem) => {

    let liElements = parentElem.find("li");

    liElements.each((idx, liElem) => {

        $(liElem)

        .find("input, textarea")

        .each((controlIdx, control) => {

            let controlElem = $(control);

            let updatedName = subformIndexChanges(

                controlElem.attr("name"),

                idx

                );

            let updatedId = subformIndexChanges(

                controlElem.attr("id"),

                idx

                );

            controlElem.attr("name", updatedName);

            controlElem.attr("id", updatedId);

        });

    });

    parentElem.attr("index", liElements.length);

};



var btnAddSubForm = $(".btn-add-subform");


// if (btnAddSubForm.length > 0) {

        // Fetch HTML from Server

const fetchSubForm = (type, targetElem) => {

    let template_url = base_admin_url + "/template/" + type;

    preloader = $(`body #preloader_card_${type}`);
    $.ajax({

        type: "GET",

        dataType: "json",
        beforeSend: showLoader,
        complete: hideLoader,
        url: template_url,
        success: function (data) {

            if (data.html) {

                processedSubForm(data.html, targetElem);

            }

        },

    });

};



        // Processed and Append HTML

const processedSubForm = (html, targetElem) => {

    let recentUsedIndex = parseInt(targetElem.attr("index"));

    let newIndex = recentUsedIndex + 1;

    let cardTitlePattern = '<span class="card-title-text">(.*?)</span>';



            // Change Based on Pattern

    let newHtmlContent = subformIndexChanges(html, newIndex);

    const match = new RegExp(cardTitlePattern).exec(newHtmlContent);

    if (match) {

        const newSubHtml = '<span class="card-title-text"></span>';

        newHtmlContent = newHtmlContent.replace(match[0], newSubHtml);

    }



    targetElem.append(newHtmlContent);

    targetElem.attr("index", newIndex);



            // Ck Editor Added
    setTimeout(function() {

        //preloader.css({'display':'none','z-index':0});

        targetElem.find(".tourist-editor").each((idx, te) => {

            if (!$(te).next().hasClass("cke")) CKEDITOR.replace(te);

        });
    }, 3000);



            // Sortable

    if (targetElem.hasClass("ui-sortable")) {

                // Refresh

        targetElem.sortable("refresh");

    } else {

                // Create

        targetElem.sortable({

            update: function (event, ui) {

                changeSubformOrder(targetElem);

            },

        });

    }

};



        // Button Clicked Event

btnAddSubForm.on("click", function () {

    elemRef = $(this);

    //preloader.css({'display':'block','z-index':1});

    let subformType = elemRef.attr("subform-type");

    let targetSelector = elemRef.attr("target-selector");

    let targetElem = $(targetSelector);



            // Call Ajax Call

    fetchSubForm(subformType, targetElem);

});





        // Delete the Card

$("body").on("click", ".delete-card", function () {

    if (confirm('Are you sure you want to remove this?')) {



        $(this).parents(".subform-card").first().remove();

    }else{

        return false;

    }

});



        // Edit the Card

$("body").on("click", ".edit-card", function () {

    let super_parent = $(this).closest('.list-types').children('li.subform-card');

    let parent = $(this).parents('.subform-card');

    $.each(super_parent,function(key,ele){

        if (parent.index() != key) {

            $(ele).find('.card-body').hide();

        }

    });

    $(this)

    .parents(".subform-card")

    .first()

    .find(".card-body")

    .first()

    .toggle();

});



        // Title Added

$("body").on(

    "keyup",

    ".subform-card .card-body input[type=text]",

    function () {

        $(this)

        .parents(".subform-card")

        .each(function () {

                        // TODO: Dynamic par is missing

            $(this)

            .find(".card-title-text")

            .text(($(this).find("input[type=text]").val().length > 30)?$(this).find("input[type=text]").val().substring(0,30) + '.....':$(this).find("input[type=text]").val());

        });

    }

    );



        // Sortable Initialized

let cardListElm = $(".list-types");

if (cardListElm.length > 0) {

    cardListElm.sortable({

        update: function (event, ui) {

            changeSubformOrder($(this));

        },

    });

}

    //} // If Block Ends



    // ------------------- CK Editor Setup -----------------------
setTimeout(function() {

    if (touristEditorsElems.length > 0) {
        touristEditorsElems.each(function (idx, te) {

            CKEDITOR.replace(te);

        });

    }
}, 3000);



    // Initialize Map

let iconBase = '/admin-part/images/map/';

function initMap() {

    if(mapElem) {

        map = new google.maps.Map(mapElem, {

                zoom: 1, // Default

                center: new google.maps.LatLng(30.704649, 76.717873),

                mapTypeId: "terrain",

            });



            //console.log(google.maps.places);

    }

}







    // Call InitMap if Exists

if (mapElem) {

    initMap();

}



    // Set markup on Map

const setMarkupOnMap = (geometryList) => {

    if (map) {

        if (markers.length > 0) {

                // Clear all markers.

            markers.forEach(function (marker) {

                marker.setMap(null);

            });

        }



        geometryList.forEach((latLng) => {

                // Add to Markers for Further access

            markers.push(

                new google.maps.Marker({

                    position: new google.maps.LatLng(

                        latLng.latitude,

                        latLng.longitude

                        ),

                    map: map,

                       // icon: iconBase + 'map_marker.png'

                })

                );

        });



            // Listen for the marker's position change event.

        let lastAddedMarker = markers[markers.length - 1];

        map.setCenter(lastAddedMarker.getPosition());

    }

};



    // Set Zoom Level

const setZoomLevel = (level) => {

    map.setZoom(level);

};



    // Place Changed

const onPlaceChanged = () => {

    console.log("Place Changed Trigger");

    let latitude = latitudeTextbox.value;

    let longitude = longitudeTextbox.value;

    let zoomLevel = parseInt(zoomTextbox.value);



    let geometryList = [

    {

        latitude,

        longitude,

    },

    ];



    setMarkupOnMap(geometryList);

    setZoomLevel(zoomLevel);

};

$(zoomTextbox).on('input',function(){
    onPlaceChanged();
});

if(addressTextbox){



        // Autocompletion Addres Bar

    var autocomplete = new google.maps.places.Autocomplete(addressTextbox, {

        types: ["geocode"],

    });

        // Autocompletion Addres Bar

    new google.maps.places.Autocomplete(addressTextboxSingle, {

        types: ["geocode"],

    });



        // Event listener for the autocomplete object.

    autocomplete.addListener("place_changed", function () {

            // Get the selected place.

        const place = autocomplete.getPlace();

            // Set the address textbox to the selected place's address.

        addressTextbox.value = place.formatted_address;



        let latitude = place.geometry.location.lat();

        let longitude = place.geometry.location.lng();



        latitudeTextbox.value = latitude;

        longitudeTextbox.value = longitude;



        onPlaceChanged();

    });

}







if(latitudeTextbox) latitudeTextbox.onchange = onPlaceChanged;

if(longitudeTextbox) longitudeTextbox.onchange = onPlaceChanged;

if(zoomTextbox) zoomTextbox.onchange = onPlaceChanged;

if(zoomTextbox) zoomTextbox.onkeyup = onPlaceChanged;
setTimeout(function() {
    if(zoomTextbox) zoomTextbox.onchange()
}, 1000)




    // Media JS



function hasValueForKey(array, key, value) {

    for (const object of array) {

      if (object.hasOwnProperty(key) && object[key] == value) {

        return true;

    }

}



return false;

}



// Function to create pagination links

function createPaginationFromLinks(links) {

    const paginationList = document.getElementById('paginationList');

    paginationList.innerHTML = '';



    links.forEach((item) => {

      const listItem = document.createElement('li');

      listItem.classList.add('page-item');



      if (item.url) {

        const link = document.createElement('a');

        link.classList.add('page-link');

        link.href = item.url;

        link.textContent = item.label.replace("&raquo;", "\u00bb").replace("&laquo;", "\u00ab");

        if (item.active) {

          listItem.classList.add('active');

      }

      listItem.appendChild(link);

  } else {

    listItem.classList.add('disabled');

    listItem.innerHTML = `<span class="page-link">${item.label}</span>`;

}



paginationList.appendChild(listItem);

});

}



const fillImagesToList = (filesWrapper) => {

    //console.log("filesWrapper", filesWrapper)

    let files = filesWrapper.data

    let mediaListHtml = ''

    if(files.length > 0) {

        console.log("Entering", files)

        files.forEach((file, idx) => {

           // console.log(selectedImages);

         //   console.log(hasValueForKey(selectedImages, 'id', file.id))

            let active_class = hasValueForKey(selectedImages, 'id', file.id) ? 'active' : ''



            mediaListHtml += `

            <div class="col-md-1 mt-4 file  ${active_class} " style="background-image: url(${file.thumbnail})">


            <a href="javascript:void(0);" data-id="${file.id}" data-url="${file.original_url}" class="file-thumb" data-name="${file.name}">

            <img src="${file.thumbnail}" class="img-responsive img-holder" />





            </a>

            </div>`;

        });

    }

    $('.file-list').html(mediaListHtml)

        // TODO: Refresh Pagination

    createPaginationFromLinks(filesWrapper.links)

}







$('.file-pagination').on("click", ".page-link", function() {

    let href = $(this).attr('href');

    loadImages(href);

    return false

})



$('#file-search-box').on("keyup", function() {



    let searchTxt = $(this).val()



    loadImages(null, searchTxt)



});







$('.file-list').on("click", ".file", function() {



    let fileId = $(this).find('a').first().attr('data-id');

    let fileUrl = $(this).find('a').first().attr('data-url')
    let fileName = $(this).find('a').first().attr('data-name')
    let tb_image_prev_data = new Object();
    if(!$(this).hasClass('active')) {

            // adding
       tb_image_prev_data.title = fileName;
       tb_image_prev_data.imageUrl = fileUrl;
       tb_image_prev_data.url = fileUrl;

       $('#tb-image-prev').html(showImagePrevHtml(tb_image_prev_data));

       if(mediaMode == "single") {

                // Remove active class from All

        $(this).parent().find('.file').removeClass('active');

        $(this).addClass('active')

        selectedImages = [{

            'id': fileId,

            'url': fileUrl,

        }];

    }else {

                // Multiple Selection
        console.log('select',typeof selectedImages);
        $(this).addClass('active')

        selectedImages.push({

            'id': fileId,

            'url': fileUrl,

        })

    }



}else {

            // removing
   $('#tb-image-prev').html(showImagePrevHtml(tb_image_prev_data));
   if(mediaMode == "single") {

                // Remove active class from All

    $(this).parent().find('.file').removeClass('active');

    selectedImages = [];

}else {

                // Multiple Selection

    $(this).removeClass('active')

    if(selectedImages.length > 0){

        selectedImages = selectedImages.filter((selectedImg, idx) => {

            return selectedImg.id != fileId

        })
    }

}

}



        // TODO: Assign selectedImages to target Element



})



const loadImages = (url = null, searchTxt = '') => {

    let image_url = (url != null) ? url : base_admin_url + "/files/load-images";
    preloader = $('body div#preloader-file');
    $.ajax({

        type: "GET",

        dataType: "json",

        data: {

            searchTxt: searchTxt

        },
        beforeSend: showLoader,
        complete: hideLoader,

        url: image_url,

        success: function (data) {

            fillImagesToList(data)

        },

    });

};



$("#fileElem").on("change", function(e) {

    handleFiles(e.currentTarget.files);

})

$("#fileElemAdd").on("change", function(e) {
    no_modal = true;
    handleFiles(e.currentTarget.files);

});

$('#add-new-media').on('click',function(){
    $('#drop-area').toggle();
})



    // Draggable Feature

var dropArea = document.getElementById("drop-area");



    // dropArea.addEventListener("dragenter", handlerFunction, false);

    // dropArea.addEventListener("dragleave", handlerFunction, false);

    // dropArea.addEventListener("dragover", handlerFunction, false);

    // dropArea.addEventListener("drop", handlerFunction, false);



    // Reset Default Nature

["dragenter", "dragover", "dragleave", "drop"].forEach(

    (eventName) => {

        dropArea.addEventListener(eventName, preventDefaults, false);

    }

    );



function preventDefaults(e) {

    e.preventDefault();

    e.stopPropagation();

}



    // Set and Unset Highlighter

['dragenter', 'dragover'].forEach(eventName => {

    dropArea.addEventListener(eventName, highlight, false)

});



["dragleave", "drop"].forEach(eventName => {

    dropArea.addEventListener(eventName, unhighlight, false)

});



function highlight(e) {

    dropArea.classList.add('highlight')

}



function unhighlight(e) {

    dropArea.classList.remove('highlight')

}



    // Handle Drop File Event

dropArea.addEventListener('drop', handleDrop, false)



function handleDrop(e) {

    let dt = e.dataTransfer

    let files = dt.files



    handleFiles(files)

}



    // Implement Progress Bar

let uploadProgress = []

let progressBar = document.getElementById('media-progress-bar')



function initializeProgress(numFiles) {

    progressBar.value = 0

    uploadProgress = []



    for (let i = numFiles; i > 0; i--) {

        uploadProgress.push(0)

    }

}



function updateProgress(fileNumber, percent) {

    uploadProgress[fileNumber] = percent

    let total = uploadProgress.reduce((tot, curr) => tot + curr, 0) / uploadProgress.length

    progressBar.value = total

}



    // Preview Files

function previewFile(file) {

    let reader = new FileReader()

    reader.readAsDataURL(file)

    reader.onloadend = function() {

      let img = document.createElement('img')

      img.src = reader.result

      let galleryElem = document.getElementById('gallery')

      if(galleryElem){

          galleryElem.appendChild(img)

      }

  }

}





    // Handling Files

const handleFiles = (files) => {

    files = [...files]

    initializeProgress(files.length)

    files.forEach(uploadFile)

    files.forEach(previewFile)

}



const changeTabToFileList = () => {

    $('a[href="#list-media"]').tab('show');

}

const sortable_gallery_fun = () => {
    let cardListElm = $(".image-list");

    if (cardListElm.length > 0) {

        cardListElm.sortable({

            update: function (event, ui) {

            //changeSubformOrder($(this));

            },

        });

    }
}



function uploadFile(file, i) {

    let url = base_admin_url + '/files/upload'

    let xhr = new XMLHttpRequest()

    let formData = new FormData()

    xhr.open('POST', url, true)

    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest')

    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"))



        // Update progress (can be used to show progress indicator)

    xhr.upload.addEventListener("progress", function(e) {

        updateProgress(i, (e.loaded * 100.0 / e.total) || 100)

    })

    xhr.addEventListener('readystatechange', function(e) {

        if (xhr.readyState == 4 && xhr.status == 200) {

                updateProgress(i, 100) // <- Add this

                // Refresh the Listing
                if (!no_modal) {

                    loadImages()

                // Tab Change

                    changeTabToFileList()
                }

                // Reset Progressbar
                

                updateProgress(i, 0)

                                //without modal upload media
                if (no_modal) {
                    window.location.reload();
                }



            }

            else if (xhr.readyState == 4 && xhr.status != 200) {

            // Error. Inform the user

            }

        })



        //   formData.append('upload_preset', 'ujpu6gyk')

    formData.append('file', file)

    xhr.send(formData)

}

$(".submit-media").on("click", function() {

    let targetElem = $(this)[0].targetElem

    let jsonStringify = JSON.stringify(selectedImages)

    if(targetElem.attr('smode') == "single") {

        // jsonStringify = selectedImages[0].url;



        if(selectedImages.length != 0){

            targetElem.parent().find('.media-txt-only').first().val(selectedImages[0].url);

        }else{

            targetElem.parent().find('.media-txt-only').first().val('');

        }

    }



    targetElem.attr("selectedImages", jsonStringify)

    targetElem.parent().find('.gallery-input').first().val(jsonStringify)



    let imageHtml = '';
    
    imageHtml +='<div class="row">';

    console.log("Selected Images", selectedImages)
    if(selectedImages.length > 0){
        selectedImages.forEach((imageObj, idx) => {

            imageHtml +='<div class="col-xl-3">';

            imageHtml += `<img src="${imageObj.url}" class="img" height="100" width="100" id="image-path-${imageObj.id}" />`

            imageHtml +='</div>';

        })
    }
    if (targetElem.attr('smode') == "multiple") {
       imageHtml +='<button type="button" class="sortable-gallery" data-input_target="'+targetElem.parent().find('.gallery-input').first().attr('name')+'" onclick="sortable_gallery(this)">Sort Item</button>';
   }
   imageHtml +='</div>';

   targetElem.parent().find(".media-preview").first().html(imageHtml)



   $("#file-modal").modal("hide");



})

//let sortable_gallery = $('.sortable-gallery');
let sortable_gallery_done = $('.done-sort-gallery');
window.remove_image = function(ele){
    if (confirm('are you sure remove this image')) {
        $(ele).parent().remove();
        let cardListElm = $(".image-list");
        cardListElm.sortable("refresh")
    }
}

window.sortable_gallery = function(ele){
   $("#sort-gallery-modal").modal("show");

   let parent = $(ele).closest('.gallery-controls');
   let input_value = parent.find('.gallery-input').first().val();
   if (isJSON(input_value) && (input_value != '' || input_value != null)) {


    
    let inputImages = $.parseJSON(input_value);
    let imageHtml = "";
    imageHtml +='<div class="row image-list">';
    if(inputImages.length > 0){
        inputImages.forEach((imageObj, idx) => {
            if (imageObj != null) {

                imageHtml +=`<div class="col-xl-3 image-list-item" data-id="${imageObj.id}" data-url="${imageObj.url}">`;

                imageHtml += `<img src="${imageObj.url}" class="img" height="100" width="100" id="image-path-${imageObj.id}" />`

                imageHtml +='<i class="fa fa-remove remove-image" onclick="remove_image(this)"></i>';
                imageHtml +='</div>';
            }


        })
    }

    imageHtml +='</div>';
    $("#sort-gallery-modal").find(".sort-gallery").first().html(imageHtml);
    $("#sort-gallery-modal").find(".done-sort-gallery").first().attr('data-input_target',parent.find('.gallery-input').first().attr('id'));


    sortable_gallery_fun();
}
}


sortable_gallery_done.on('click',function(){
    let image_list_item = $('#sort-gallery-modal .sort-gallery .image-list .image-list-item');

    let image_list = [];
    $(image_list_item).each((idx,imageObj ) => {
     

       image_list.push({'id':$(imageObj).data('id'),'url':$(imageObj).data('url')});
       
   });

    let jsonStringify = JSON.stringify(image_list);

    let target_element = $(`#${$(this).data('input_target')}`);

    
    target_element.val(jsonStringify);

    $(target_element).closest('.gallery-controls').find('.add-gallery-btn').first().attr("selectedImages", jsonStringify);

    let imageHtml_2 = '';
    
    imageHtml_2 +='<div class="row">';


    if(image_list.length > 0){
        image_list.forEach((imageObj_2, idx_2) => {

         
            imageHtml_2 +='<div class="col-xl-3">';

            imageHtml_2 += `<img src="${imageObj_2.url}" class="img" height="100" width="100" id="image-path-${imageObj_2.id}" />`

            imageHtml_2 +='</div>';

        })
    }
    
    imageHtml_2 +='<button type="button" class="sortable-gallery" data-input_target="'+$(this).data('input_target')+'" onclick="sortable_gallery(this)">Sort Item</button>';
    
    imageHtml_2 +='</div>';

    $(target_element).closest('.gallery-controls').find(".media-preview").first().html(imageHtml_2)

    
    $("#sort-gallery-modal").find(".sort-gallery").first().html("");
    $("#sort-gallery-modal").modal("hide");
    


    
});

let mediaSelector = ".add-media-btn, .add-gallery-btn"
let mediaRemove = '.remove-media-btn';


// $("body").on("click", mediaRemove, function(){

//     alert('remove');
// });

    // Specifically for Subform

$("body").on("click", mediaSelector, function(){

        // Grab Selected File (If Any)

        // Change in Model DOM

        // Model Open

    
    $("#file-modal").modal("show");

        // Store Element

    $("#file-modal").find(".submit-media").first()[0].targetElem =$(this)

        // TODO: Set Selected Items

    let sImages = $.trim($(this).attr("selectedImages"))

    selectedImages = [];

        // console.log("SImage Type", typeof sImages)
        //  console.log("SImage Val", sImages)

    if(isJSON(sImages)) {

        selectedImages = JSON.parse(sImages)

        // console.log("S-Images", selectedImages)
        // console.log("S-Images Type", typeof selectedImages)

    }else{

        selectedImages = sImages;

    }

        // TODO: Set Mode (Single/Multi)

    mediaMode = $(this).attr("smode")

    // console.log("mediaMode", mediaMode)



        // Load Images / Refresh Images

    loadImages();

});

const convertToSlug = function(Text) {
  return Text.toLowerCase()
  .replace(/ /g, "-")
  .replace(/[^\w-]+/g, "");
}


const processedPageTemplateHtml = function(data,id){
    if (data != '') {
       $(`body ${id}`).html(data);
       $('#page-extra-data').on("click",'.btn-add-subform', function () {

        elemRef = $(this);

        //preloader.css({'display':'block','z-index':1});

        let subformType = elemRef.attr("subform-type");

        let targetSelector = elemRef.attr("target-selector");

        let targetElem = $(targetSelector);



            // Call Ajax Call

        fetchSubForm(subformType, targetElem);

        }); // On Click Event Block Ends

       setTimeout(function() {

        $(`body ${id}`).find(".tourist-editor").each((idx, te) => {

            if (!$(te).next().hasClass("cke")) CKEDITOR.replace(te);

        });

        mapElem = document.getElementById("map");
        if (mapElem) {

            initMap();
        }
        addressTextbox = document.getElementById("map_address");
        latitudeTextbox = document.getElementById("latitude");
        longitudeTextbox = document.getElementById("longitude");
        zoomTextbox = document.getElementById("zoom_level");
        if(addressTextbox){



        // Autocompletion Addres Bar

            var autocomplete = new google.maps.places.Autocomplete(addressTextbox, {

                types: ["geocode"],

            });


        // Event listener for the autocomplete object.

            autocomplete.addListener("place_changed", function () {

            // Get the selected place.

                var place = autocomplete.getPlace();
                

            // Set the address textbox to the selected place's address.
                addressTextbox.value = place.formatted_address;



                let latitude = place.geometry.location.lat();
                

                let longitude = place.geometry.location.lng();



                latitudeTextbox.value = latitude;

                longitudeTextbox.value = longitude;



                onPlaceChanged();

            });
            if (latitudeTextbox != "" && longitudeTextbox != "") {
               onPlaceChanged();
           }
           $(zoomTextbox).on('input',function(){
            onPlaceChanged();
        });

       }
       
   }, 1000);



   }else{
    $(`body ${id}`).children().remove();
}

}
const getData = function(ajaxurl,s_params) { 
    return $.ajax({
        type: "GET",
        dataType: "html",
        url: ajaxurl,
        data:s_params,
        beforeSend: showLoader,
        complete: hideLoader,
    });
}

async function fetchDataByajax(t_endpoint,t_params) {
  try {
    const res = await getData(t_endpoint,t_params)
    processedPageTemplateHtml(res,'#page-extra-data');
} catch(err) {
    console.log(err);
}
}

const fetchPageTemplate = function(ele){

    let target_element = $(ele).children('option:selected').val();
    //let target_element = $(ele).data('target_element');
    //let location_id = $('.destination-all-content').data('location_id');

    if (typeof target_element != 'undefined') {
        if (target_element != '') {
            target_element = convertToSlug(target_element);
            let endpoint = base_url + "/extra-data/"+target_element;
            let id = $('#page-id').val();
            let params = new Object();
            if (typeof id != 'undefined') {
                params.id = id;
            }

            fetchDataByajax(endpoint,params);

        }else{
            $(`body #page-extra-data`).children().remove();
        }
    }else{
        $(`body #page-extra-data`).children().remove();
    }
}

let pageType = $('body #page-type');

if (pageType.children('option:selected').val() != "") {
    fetchPageTemplate(pageType);
}
$(pageType).on('change',function(){
   fetchPageTemplate(this);

});


// if($(mediaSelector).length > 0) {

//     // Load Image on load

//     loadImages();

// }



});

