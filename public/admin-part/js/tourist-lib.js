$(document).ready(function () {
    var base_admin_url = $("#base-admin-url").val();

    // Map Variable
    const addressTextboxSingle = document.getElementById("address");
    const addressTextbox = document.getElementById("map_address");
    const latitudeTextbox = document.getElementById("latitude");
    const longitudeTextbox = document.getElementById("longitude");
    const zoomTextbox = document.getElementById("zoom_level");

    const mapElem = document.getElementById("map");

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

    let btnAddSubForm = $(".btn-add-subform");
    if (btnAddSubForm.length > 0) {
        // Fetch HTML from Server
        const fetchSubForm = (type, targetElem) => {
            let template_url = base_admin_url + "/template/" + type;
            $.ajax({
                type: "GET",
                dataType: "json",
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
            targetElem.find(".tourist-editor").each((idx, te) => {
                if (!$(te).next().hasClass("cke")) CKEDITOR.replace(te);
            });

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
            let subformType = elemRef.attr("subform-type");
            let targetSelector = elemRef.attr("target-selector");
            let targetElem = $(targetSelector);

            // Call Ajax Call
            fetchSubForm(subformType, targetElem);
        }); // On Click Event Block Ends

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
    } // If Block Ends

    // ------------------- CK Editor Setup -----------------------
    if (touristEditorsElems.length > 0) {
        touristEditorsElems.each(function (idx, te) {
            CKEDITOR.replace(te);
        });
    }

    // Initialize Map
    let iconBase = '/admin-part/images/map/';
    function initMap() {
        if(mapElem) {
            map = new google.maps.Map(mapElem, {
                zoom: 1, // Default
                center: new google.maps.LatLng(30.704649, 76.717873),
                mapTypeId: "terrain",
            });

            console.log(google.maps.places);
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

    if(addressTextbox){

        // Autocompletion Addres Bar
        const autocomplete = new google.maps.places.Autocomplete(addressTextbox, {
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

    // Media JS

    function hasValueForKey(array, key, value) {
        for (const object of array) {
          if (object.hasOwnProperty(key) && object[key] == value) {
            return true;
        }
    }

    return false;
}

const fillImagesToList = (filesWrapper) => {
    let files = filesWrapper.data
    let mediaListHtml = ''
    if(files.length > 0) {
        console.log("Entering")
        files.forEach((file, idx) => {
            console.log(hasValueForKey(selectedImages, 'id', file.id))
            let active_class = hasValueForKey(selectedImages, 'id', file.id) ? 'active' : ''

            mediaListHtml += `
            <div class="col-md-3 file  ${active_class} " style="background-image: url(${file.original_url})">
            <a href="javascript:void(0);" data-id="${file.id}" data-url="${file.original_url}" class="file-thumb">
            <img src="${file.original_url}" class="img-responsive img-holder" />
            </a>
            </div>
            `
        });
    }
    $('.file-list').html(mediaListHtml)
        // TODO: Refresh Pagination

}



$('.file-list').on("click", ".file", function() {

    let fileId = $(this).find('a').first().attr('data-id');
    let fileUrl = $(this).find('a').first().attr('data-url')

    if(!$(this).hasClass('active')) {
            // adding
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
            $(this).addClass('active')
            selectedImages.push({
                'id': fileId,
                'url': fileUrl,
            })
        }

    }else {
            // removing
        if(mediaMode == "single") {
                // Remove active class from All
            $(this).parent().find('.file').removeClass('active');
            selectedImages = []
        }else {
                // Multiple Selection
            $(this).removeClass('active')
            selectedImages = selectedImages.filter((selectedImg, idx) => {
                return selectedImg.id != fileId
            })
        }
    }

        // TODO: Assign selectedImages to target Element

})

const loadImages = () => {
    let image_url = base_admin_url + "/files/load-images";
    $.ajax({
        type: "GET",
        dataType: "json",
        url: image_url,
        success: function (data) {
            fillImagesToList(data)
        },
    });
};

$("#fileElem").on("change", function(e) {
    handleFiles(e.currentTarget.files);
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
                loadImages()
                // Tab Change
                changeTabToFileList()
                // Reset Progressbar
                updateProgress(i, 0)


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
    targetElem.attr("selectedImages", JSON.stringify(selectedImages))
    targetElem.parent().find('.gallery-input').first().val(JSON.stringify(selectedImages))

    let imageHtml = '';
    imageHtml +='<div class="row">';
    selectedImages.forEach((imageObj, idx) => {
        imageHtml +='<div class="col-xl-3">';
        imageHtml += `<img src="${imageObj.url}" class="img" height="100" width="100" id="image-path-${imageObj.id}" />`
        imageHtml +='</div>';
    })
    imageHtml +='</div>';
    targetElem.parent().find(".media-preview").first().html(imageHtml)

    $("#file-modal").modal("hide");

})

let mediaSelector = ".add-media-btn, .add-gallery-btn"

    // Specifically for Subform
$("body").on("click", mediaSelector, function(){
        // Grab Selected File (If Any)
        // Change in Model DOM
        // Model Open
    $("#file-modal").modal("show");
        // Store Element
    $("#file-modal").find(".submit-media").first()[0].targetElem =$(this)
        // TODO: Set Selected Items
    let sImages = $(this).attr("selectedImages")
    selectedImages = []
    if(sImages) {
        selectedImages = JSON.parse(sImages)
    }


        // TODO: Set Mode (Single/Multi)
    mediaMode = $(this).attr("smode")
    console.log("mediaMode", mediaMode)

        // Load Images / Refresh Images
    loadImages();
});

if($(mediaSelector).length > 0) {
    // Load Image on load
    loadImages();
}

});
