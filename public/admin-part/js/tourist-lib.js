$(document).ready(function () {
    // Map Variable
    const addressTextbox = document.getElementById('map_address');
    const latitudeTextbox = document.getElementById('latitude');
    const longitudeTextbox = document.getElementById('longitude');
    const zoomTextbox = document.getElementById('zoom_level');

    const mapElem = document.getElementById("map");

    let touristEditorsElems = $(".tourist-editor")

    // Markers on Map : Assuming there will be one Map on a Page
    var markers = [];

    // Change Indexes of Subform
    const subformIndexChanges = (text, idx) => {
        let pattern = /\[(\d+)\]/g; // pattern [<number>] TODO: think better Solution
        let intentionPattern = /\-tsign-(\d+)\-tsign-/g;

        let updatedText = text.replace(pattern, `[${idx}]`).replace(intentionPattern, `-tsign-${idx}-tsign-`)

        return updatedText
    }

    // Change Subform Ordering
    const changeSubformOrder = (parentElem) => {

        let liElements = parentElem.find('li')
        liElements.each((idx, liElem) => {
            $(liElem).find("input, textarea").each((controlIdx, control) => {
                let controlElem = $(control)
                let updatedName = subformIndexChanges(controlElem.attr("name"), idx)
                let updatedId = subformIndexChanges(controlElem.attr("id"), idx)
                controlElem.attr("name", updatedName);
                controlElem.attr("id", updatedId);
            })

        })
        parentElem.attr("index", liElements.length)

    }

    var base_admin_url = $('#base-admin-url').val()
    let btnAddSubForm = $(".btn-add-subform")
    if (btnAddSubForm.length > 0) {
        // Fetch HTML from Server
        const fetchSubForm = (type, targetElem) => {
            let template_url = base_admin_url + '/template/' + type
            $.ajax({
                type: "GET",
                dataType: "json",
                url: template_url,
                success: function (data) {
                    if (data.html) {
                        processedSubForm(data.html, targetElem)
                    }
                }
            });

        }

        // Processed and Append HTML
        const processedSubForm = (html, targetElem) => {
            let recentUsedIndex = parseInt(targetElem.attr('index'));
            let newIndex = recentUsedIndex + 1
            let cardTitlePattern = '<span class="card-title-text">(.*?)</span>';

            // Change Based on Pattern
            let newHtmlContent = subformIndexChanges(html, newIndex)
            const match = new RegExp(cardTitlePattern).exec(newHtmlContent);
            if(match) {
                const newSubHtml = '<span class="card-title-text"></span>';
                newHtmlContent = newHtmlContent.replace(match[0], newSubHtml);
            }

            targetElem.append(newHtmlContent)
            targetElem.attr("index", newIndex)

            // Ck Editor Added
            targetElem.find(".tourist-editor").each((idx, te) => {
                if(!$(te).next().hasClass("cke"))
                    CKEDITOR.replace(te)
            })

            // Sortable
            if(targetElem.hasClass('ui-sortable')) {
                // Refresh
                targetElem.sortable('refresh')
            }else {
                // Create
                targetElem.sortable({
                    update: function(event, ui) {
                        changeSubformOrder(targetElem)
                    }
                });
            }

        }


        // Button Clicked Event
        btnAddSubForm.on("click", function () {
            elemRef = $(this)
            let subformType = elemRef.attr("subform-type")
            let targetSelector = elemRef.attr("target-selector")
            let targetElem = $(targetSelector)

            // Call Ajax Call
            fetchSubForm(subformType, targetElem)
        }) // On Click Event Block Ends

        // Delete the Card
        $('body').on('click', '.delete-card', function() {
            $(this).parents('.subform-card').first().remove();
        });

        // Edit the Card
        $('body').on('click', '.edit-card', function() {
            $(this).parents('.subform-card').first().find('.card-body').first().toggle();
        });

        // Title Added
        $('body').on('keyup', '.subform-card .card-body input[type=text]', function() {
            $(this).parents('.subform-card').each(function() {
                // TODO: Dynamic par is missing
                $(this).find('.card-title-text').text($(this).find('input[type=text]').val());
            });
        });

        // Sortable Initialized
        let cardListElm = $('.list-types')
        if(cardListElm.length > 0) {
            cardListElm.sortable({
                update: function(event, ui) {
                    changeSubformOrder($(this))
                }
            });
        }

    } // If Block Ends

    // ------------------- CK Editor Setup -----------------------
    if(touristEditorsElems.length > 0) {
        touristEditorsElems.each(function(idx, te) {
            CKEDITOR.replace(te)
        })
    }



    // Initialize Map
    function initMap() {
        map = new google.maps.Map(mapElem, {
            zoom: 1, // Default
            center: new google.maps.LatLng(30.704649, 76.717873),
            mapTypeId: "terrain",
        });

        console.log(google.maps.places)
    }

    // Call InitMap if Exists
    if(mapElem) {
        initMap();
    }

    // Set markup on Map
    const setMarkupOnMap = (geometryList) => {
        if(map) {
            if(markers.length > 0) {
                // Clear all markers.
                markers.forEach(function(marker) {
                    marker.setMap(null);
                });
            }

            geometryList.forEach((latLng) => {
                // Add to Markers for Further access
                markers.push(new google.maps.Marker({
                    position: new google.maps.LatLng(latLng.latitude, latLng.longitude),
                    map: map
                }))
            })

            // Listen for the marker's position change event.
            let lastAddedMarker = markers[markers.length - 1];
            map.setCenter(lastAddedMarker.getPosition());
        }
    }

    // Set Zoom Level
    const setZoomLevel = (level) => {
        map.setZoom(level);
    }

    // Place Changed
    const onPlaceChanged = () => {
        console.log("Place Changed Trigger")
        let latitude = latitudeTextbox.value;
        let longitude = longitudeTextbox.value;
        let zoomLevel = parseInt(zoomTextbox.value);

        let geometryList = [
            {
                latitude,
                longitude
            }
        ]

        setMarkupOnMap(geometryList)
        setZoomLevel(zoomLevel)

    }

    // Autocompletion Addres Bar
    const autocomplete = new google.maps.places.Autocomplete((addressTextbox),
        { types: ['geocode'] });

      // Event listener for the autocomplete object.
      autocomplete.addListener('place_changed', function() {
        // Get the selected place.
        const place = autocomplete.getPlace();
        // Set the address textbox to the selected place's address.
        addressTextbox.value = place.formatted_address;

        let latitude = place.geometry.location.lat();
        let longitude = place.geometry.location.lng();

        latitudeTextbox.value = latitude
        longitudeTextbox.value = longitude

        onPlaceChanged()
    });

    latitudeTextbox.onchange = onPlaceChanged
    longitudeTextbox.onchange = onPlaceChanged
    zoomTextbox.onchange = onPlaceChanged
    zoomTextbox.onkeyup = onPlaceChanged

})
