(function () {
    var base_url = $("#base-url").val();
    const moreLi = $(".more-li");
    const resultInfo = $("#result-info");
    var map;
    var markerIcon = {
        anchor: new google.maps.Point(22, 16),
        url: '/sites/images/marker.png',
    }
    var markers = [];

    moreLi.on("click", function () {
        $(this).parent().find(".li-hide").removeClass("li-hide");
        $(this).remove();
    });

    // Function to show the loader
    function showLoader() {
        $(".map-content-loading").show();
    }

    // Function to hide the loader
    function hideLoader() {
        $(".map-content-loading").hide();
    }

    // Set up AJAX loader
    $.ajaxSetup({

    });

    const compiledCheckboxes = (selector) => {
        let checkedValues = [];
        // Loop through each checkbox
        $(selector + ":checked").each(function () {
            checkedValues.push($(this).val());
        });

        // Join the checked values into a comma-separated string
        return checkedValues.join(",");
    };

    const getSelectedPrice = () => {
        const selectedPriceElem = $("input[name=price]:checked");
        return selectedPriceElem.val();
    };

    // Fetch Parameter for search
    const fetchParameters = () => {
        params = {};
        // Fetch Range If any
        let selectedPriceRange = getSelectedPrice();
        if (selectedPriceRange) {
            params.range = selectedPriceRange;
        }
        // Fetch Property Types If any
        let selectedPropertyTypes = compiledCheckboxes(
            ".filter-property-types"
        );
        if (selectedPropertyTypes) {
            params.propertyTypes = selectedPropertyTypes;
        }

        // Fetch Amenities If any
        let selectedAmenities = compiledCheckboxes(".filter-amenities");
        if (selectedAmenities) {
            params.amenities = selectedAmenities;
        }

        // Fetch Medicares If any
        let selectedMedicares = compiledCheckboxes(".filter-medicare");
        if (selectedMedicares) {
            params.medicares = selectedMedicares;
        }

        // Fetch Meetings If any
        let selectedMeeting = compiledCheckboxes(".filter-meeting");
        if (selectedMeeting) {
            params.meeting = selectedMeeting;
        }

        // Fetch Deals If any
        let selectedDeals = compiledCheckboxes(".filter-deal");
        if (selectedDeals) {
            params.deals = selectedDeals;
        }

        // Fetch Activities If any
        let selectedActivities = compiledCheckboxes(".filter-activities");
        if (selectedActivities) {
            params.activities = selectedActivities;
        }

        // Location or State Search
        let sourceType = $("input[name=source_type]").val();
        let sourceId = $("input[name=source_id]").val();
        let searchTerm = $("#input-search-box").val();

        if(sourceType){
            params.sourceType = sourceType
        }
        if(sourceId){
            params.sourceId = sourceId
        }
        if(searchTerm){
            params.searchTerm = searchTerm
        }

        return params;
    };

    function calculateZoomLevel() {
        // Get the bounds of all of the markers.
        var bounds = new google.maps.LatLngBounds();
        for (var i = 0; i < markers.length; i++) {
          bounds.extend(markers[i].getPosition());
        }

        // Calculate the zoom level required to fit all of the markers on the map.
        // var zoomLevel = map.getBoundsZoomLevel(bounds);
        var zoomLevel = 9;

        return zoomLevel;
      }

    // Process the Result
    const processedResultInfo = (html) => {
        resultInfo.html(html);
        if(markers.length > 0) {
            for(let i=0; i<markers.length; i++) {
                markers[i].setMap(null);
            }
        }
        markers = []
        setTimeout(()=>{
            $('.listroBox').each(function() {
                let longitude = $(this).attr("longitude");
                let latitude = $(this).attr("latitude");
                if(longitude && latitude){
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(latitude, longitude),
                        map: map
                    });

                    markers.push(marker);
                }
            });
            if(markers.length > 0) {
                let firstMarker = markers[0];
                map.setCenter(firstMarker.getPosition())
                map.setZoom(calculateZoomLevel())
            }

        },0)
    };

    // Common Function to Hit and get data
    const fetchHotels = (view, options = {}) => {
        console.log(options);
        let endpoint = base_url + "/get-hotels/" + view;

        $.ajax({
            type: "GET",
            dataType: "html",
            url: endpoint,
            data: options,
            beforeSend: showLoader,
            complete: hideLoader,
            success: function (data) {
                processedResultInfo(data);
            },
        });
    };

    // Initially Load Hotels
    fetchHotels("list", fetchParameters());

    // Load Map
    function loadMap() {
        let mapElm = document.getElementById('map-main')
        if(mapElm){
            map = new google.maps.Map(mapElm, {
                center: {
                    lat: 28.7041,
                    lng: 77.1025
                },
                zoom: 9,
                panControl: false,
                fullscreenControl: true,
                navigationControl: false,
                streetViewControl: false,
                animation: google.maps.Animation.BOUNCE,
                gestureHandling: 'cooperative',
                // scrollwheel: false
            });
        }

    }

    loadMap();





    // View Changer Grid -> List -> Grid ---
    resultInfo.on("click", ".view-changer", function () {
        $(this).parents("ui").first().find("li").removeClass("active");
        $(this).parents("li").first().addClass("active");
        let view = $(this).attr("view-id");
        fetchHotels(view, fetchParameters());
    });

    // Filter Price Apply Button
    $(".btn-filter-price").on("click", function () {
        let view = $(".view-changer").attr("view-id");
        fetchHotels(view, fetchParameters());
    });

    // Filter Checkbox Change
    $(".filter-option").on("change", function () {
        let view = $(".view-changer").attr("view-id");
        fetchHotels(view, fetchParameters());
    });

    resultInfo.on("click", ".page-link", function () {
        let view = $(".view-changer").attr("view-id");
        let pageId = $(this).attr("pageid");
        let params = fetchParameters();
        params.pageNo = pageId;
        fetchHotels(view, params);
    });

    $("#input-search-box").autocomplete({
        source: function (request, response) {
            $("input[name=source_type]").val("");
            $("input[name=source_id]").val("");
            $.ajax({
                url: "/get-location-states",
                dataType: "json",
                data: {
                    term: request.term,
                },
                success: function (data) {
                    console.log(data)
                    response(data);
                },
            });
        },
        minLength: 2,
        select: function (event, ui) {
            console.log(ui)
            console.log("Selected: " + ui.item.value + " aka " + ui.item.id);
            // $("#input-search-box").val(ui.item)
            $("input[name=source_type]").val(ui.item.sourceType);
            $("input[name=source_id]").val(ui.item.id);
        },
    });

    $(".Filter-left").on("click", ".mb-left-title", function () {
        $(this).closest(".mb-left").find(".form-group").first().toggle("1000");

        let mb_left_title_i = $(this).find("i");
        if (mb_left_title_i.hasClass("fa-angle-up")) {
            mb_left_title_i.removeClass("fa-angle-up");
            mb_left_title_i.addClass("fa-angle-down");
        } else if (mb_left_title_i.hasClass("fa-angle-down")) {
            mb_left_title_i.removeClass("fa-angle-down");
            mb_left_title_i.addClass("fa-angle-up");
        }
    });
})();
