$(document).ready(function () {
    // Map Variable
    const addressTextbox = document.getElementById('map_address');
    const latitudeTextbox = document.getElementById('latitude');
    const longitudeTextbox = document.getElementById('longitude');
    const zoomTextbox = document.getElementById('zoom_level');

    // Markers on Map : Assuming there will be one Map on a Page
    var markers = [];


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
            // Update HTML
            let pattern = /\[(\d+)\]/g; // pattern [<number>] TODO: think better Solution
            let cardTitlePattern = '<span class="card-title-text">(.*?)</span>';

            // Change Pattern
            let newHtmlContent = html.replace(pattern, "[" + newIndex + "]");
            const match = new RegExp(cardTitlePattern).exec(newHtmlContent);
            if(match) {
                const newSubHtml = '<span class="card-title-text"></span>';
                newHtmlContent = newHtmlContent.replace(match[0], newSubHtml);
            }



            targetElem.append(newHtmlContent)
            targetElem.attr("index", newIndex)



            // Sortable
            if(targetElem.hasClass('ui-sortable')) {
                // Refresh
                targetElem.sortable('refresh')
            }else {
                // Create
                targetElem.sortable({
                    cancel: ".unsortable",
                    update: function() {}
                });
            }

        }

        // let myEditor;
        // $("body").on("dblclick", ".ck-editor", function() {
        //     $(this).parents(".subform-card").first().addClass("unsortable");
        //     console.log("#"+$(this).attr("id"))
        //     myEditor = ClassicEditor
        //                 .create( document.querySelector( "#"+$(this).attr("id") ) )
        //                 .catch( error => {
        //                     console.error( error );
        //                 } );
        //     // editors.push(myEditor)
        // })

        // $("body").on("blur", ".ck-editor", function() {
        //     myEditor.destroy().then(editor => $(this).removeClass("unsortable"))
        // })

        // document.querySelector( '.ck-editor' ).addEventListener('dblclick', function() {
        //     $(this).addClass('unsortable');
        //     myEditor = InlineEditor
        //       .create( document.querySelector( '#editor' ) )
        //       .catch( error => {
        //           console.error( error );
        //       }).then(editor => myEditor = editor)
        // });

        // document.querySelector( '#editor' ).addEventListener('blur', function() {
        //     myEditor.destroy().then(editor => $(this).removeClass('unsortable'))
        // });


        // Button Clicked Event
        btnAddSubForm.on("click", function () {
            elemRef = $(this)
            let subformType = elemRef.attr("subform-type")
            let targetSelector = elemRef.attr("target-selector")
            let targetElem = $(targetSelector)

            if (targetElem.find(".subform-card").length <= 0) {
                // Call Ajax Call
                fetchSubForm(subformType, targetElem)
            } else {
                // Grab First Element
                let html = targetElem.find(".subform-card")[0].outerHTML
                processedSubForm(html, targetElem)
            }


        }) // On Click Event Block Ends

        // Delete the Card
        $('body').on('click', '.delete-card', function() {
            if (confirm('Are you sure you want to remove this?')) {
               $(this).parents('.subform-card').first().remove();
            }else{
                return false;
            }
        });

        // Edit the Card
        $('body').on('click', '.edit-card', function() {
            let $target = $(this).parents('.subform-card').first().find('.card-body').first().toggle();
            $('.subform-card .card-body').not($target).hide();
        });

        // Title Added
        $('body').on('keyup', '.subform-card .card-body input[type=text]', function() {
            $(this).parents('.subform-card').each(function() {
                // TODO: Dynamic par is missing
                $(this).find('.card-title-text').text($(this).find('input[type=text]').val());
            });
        });

        // Sortable Added
        // TODO: It might require each (iteration)
        let cardListElm = $('.list-types')
        if(cardListElm.length > 0) {
            cardListElm.sortable({
                update: function() {}
            });
        }





    } // If Block Ends


    // Initialize Map
    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 1, // Default
            center: new google.maps.LatLng(30.704649, 76.717873),
            mapTypeId: "terrain",
        });

        console.log(google.maps.places)
    }
    // TODO: Call If I need to Load Map
    initMap();

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
