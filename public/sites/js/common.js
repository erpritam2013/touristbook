(function () {
    var base_url = $("#base-url").val();
    const moreLi = $(".more-li");
    const resultInfo = $("#result-info");
    var map;
    var markerIcon = {
        anchor: new google.maps.Point(22, 16),
        url: 'https://touristbook.s3.ap-south-1.amazonaws.com/wp-content/uploads/2019/05/ico_mapker-2.webp',
    }
    var markers = [];

    function isMobile() {
       if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
         return true;
     }
     return false;
 }

 // Get the button:
 let mybutton = document.getElementById("topScrollSite");

// When the user scrolls down 20px from the top of the document, show the button
 window.onscroll = function() {scrollWindow()};

 function scrollWindow() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
} else {
    mybutton.style.display = "none";
}
}

function isJSON(something) {
    if (typeof something != 'string')
     something = JSON.stringify(something);

 try {
    JSON.parse(something);
    return true;
} catch (e) {
    return false;
}
}

const showAmenities = (amenities) => {

    let html = "";
    html += '<div class="st-report-info">';
    html += '<ul>';
    for (var i = amenities.length - 1; i >= 0; i--) {
        html += `<li style="text-transform:capitalize;">${amenities[i].name}</li>`;
    }
    html += '</ul>';
    html += '</div>';
    return html;
}

window.showMoreData = function(data){

    let label = $(data).data('more_data_label');
    let showMoreData = $(data).data('more_data');
    $('body #showMoreDataLabel').text(label);
    if (isJSON(showMoreData)) {
        showMoreData = JSON.stringify(showMoreData);
        let result = JSON.parse(showMoreData);
        /*show amenities*/
        if (label == 'Amenities') {
            let get_html = showAmenities(result);
            $('body #showMoreDataBody').html(get_html);
        }else if (label == 'Activity List') {
         let get_html = showAmenities(result);
         $('body #showMoreDataBody').html(get_html);
     }
       // console.log(result);
 }else{
    let html = '';
    if (label == 'Address') {

      html = `<p class="service-location"><i class="fa fa-map-marker" aria-hidden="true" style="color:#fba009;"></i>&nbsp;${showMoreData}</p>`;
  }else if(label == 'Package Route'){
   html += '<div class="tour-routes">';
   html += '<ul>';
   html += '<li>';
   html += `<span class="tour-route-span">${showMoreData}</span>`;
   html += '</li>';
   html += '</ul>';
   html += '</div>';
}else{
    html = `<p class="service-location">${showMoreData}</p>`;
}
$('body #showMoreDataBody').html(html);
}
}

// When the user clicks on the button, scroll to the top of the document
window.topScrollSite = function() {
  $('html, body').animate({scrollTop:0}, 'slow');
}
$('#custom-tabs').on('click','a.nav-link',function(e){
    e.preventDefault();
    let id = $(this).attr('href');
    if (typeof id != 'undefined') {

        let t = $(id);
        let top = t.offset().top;
        if (isMobile()) {
            top = top - 250;

        }else{
            top = top - 200;
        }
        console.log(top);
        // $(window).scrollTop(top);
        $('html, body').animate({scrollTop:top}, 'slow');
        return false;
    }
});
window.showActivityZoneTab = function(ele){
   let zone_tabs_div_section = $('#zone-tabs-div-section');
   if (zone_tabs_div_section.hasClass('d-none')) {
    zone_tabs_div_section.removeClass('d-none');
}else{
    zone_tabs_div_section.addClass('d-none');
}
}

window.readMoreText = function(ele) {
  let btn = ele;
  let key = $(btn).data('key');
  let desc = $(`#long-description-${key}`);
  let show_text = '';
  show_text = $(desc).data('show_text');
  console.log(show_text)
  if (show_text === "more") {
    desc.css({'height':'100%'});
    btn.innerHTML = "Read Less";
    $(desc).data('show_text','less').zattr('data-show_text','less');
}else{
    desc.css({'height':'170px'});
    btn.innerHTML = "Read More";
    $(desc).data('show_text','more').zattr('data-show_text','more');
}
}

window.readMoreTerm = function(ele) {
  let btn = ele;
  let parent = $(btn).parent('.terms-section');
  let terms = $(parent).find('.item-term');
  let show_text = $(btn).data('show_text');

  if (show_text === 'more') {
    btn.innerHTML = "Read Less...";
    $(btn).data('show_text','less').attr('data-show_text','less');
}else{
    btn.innerHTML = "Read More...";
    $(btn).data('show_text','more').attr('data-show_text','more');
}

if (terms.length != 0) {
  $.each(terms,function(key,value){

      if (key <= 5) {
          if ($(value).hasClass('d-none')) {
              $(value).removeClass('d-none');
          }
      }else{
        if (show_text === 'more') {
         $(value).removeClass('d-none');
     }else{
         $(value).addClass('d-none');
     }
 }
})
}
}


$('.activity-zone-li').on('click','a.nav-link',function(e){
    let id = $(this).attr('href');
    if (typeof id != 'undefined') {
        let t = $(id);
        let parent = t.closest('#activity-zone-area-pdf');
        let top = parent.offset().top;
        
        if (isMobile()) {
            top = top + 1100;

        }else{
            top = top + 350;
        }
        console.log(top);
        $('html, body').animate({scrollTop:top}, 'slow');

    }
});
$('#pocketPDFtab').on('click','a.nav-link',function(e){

    let id = $(this).attr('href');
    if (typeof id != 'undefined') {

        let t = $(id);

        let parent = t.parent('div.tab-content');
        let parent_nav_tab = $(this).parent('.nav-item').parent('ul.custom-tabs-detail');
        let top = parent.offset().top;
        if (isMobile()) {
            top = top - 300;

        }else{
            top = top - 250;
        }
        let parent_childs = parent.children('.tab-pane');
        let parent_nav_childs = parent_nav_tab.children('.nav-item');
        let tab_content_index = t.index();
        
        parent_nav_childs.each(function(k,v){
            if (k != tab_content_index) {
                $(v).children('a.nav-link').removeClass('active');
            }
        });
        parent_childs.each(function(key,value){
            if (key != tab_content_index) {
                $(value).hide();
            }
        })
        t.show();
        $(this).addClass('active');
        // t.hide();
        // $(window).scrollTop(top);
        $('html, body').animate({scrollTop:top}, 'slow');
        return false;
    }
});
$('#tourism-zone-area-pdf').on('click','a.nav-link',function(e){

    let id = $(this).attr('href');
    if (typeof id != 'undefined') {

        let t = $(id);
        let parent = t.parent('div.tab-content');
        let parent_nav_tab = $(this).parent('.nav-item').parent('ul.custom-tabs-detail');
        console.log(parent_nav_tab);
        let top = parent.offset().top;
        if (isMobile()) {
            top = top - 300;

        }else{
            top = top - 250;
        }
        let parent_childs = parent.children('.tab-pane');
        let parent_nav_childs = parent_nav_tab.children('.nav-item');
        console.log(parent_nav_childs);

        let tab_content_index = t.index();
        
        parent_nav_childs.each(function(k,v){
            if (k != tab_content_index) {
                $(v).children('a.nav-link').removeClass('active');
            }
        });
        parent_childs.each(function(key,value){
            if (key != tab_content_index) {
                $(value).hide();
            }
        })
        t.show();
        $(this).addClass('active');
        // t.hide();
        // $(window).scrollTop(top);
        $('html, body').animate({scrollTop:top}, 'slow');
        return false;
    }
});

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
$('.form-inquiry').on('submit',function(e){
    e.preventDefault();
    let form = $(this);
    let formData = $(this).serialize();
    let action = $(this).attr('action');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        dataType: "json",
        url: action,
        data: formData,
        beforeSend: showLoader,
        complete: hideLoader,
        success: function (data,status,response) {
            if (response.status == 200) {
               $('.form-success').show();
               $('.form-success').find('.msg').text(data.msg);
               console.log(data.msg);
               $(form)[0].reset();
           }else{
               $('.form-error').show();
               $('.form-error').find('.msg').text(data.msg);
           }

           setTimeout(function() {
               $('.form-success').hide();
               $('.form-error').hide();
           }, 3000);


       },
       error:function(data){
          $('.form-error').show();
          $('.form-error').show().find('.msg').text(data.msg);
          setTimeout(function() {
           $('.form-error').hide();
       }, 3000);
      },
  });
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

        // Fetch Duration If any
    let selectedDuration = compiledCheckboxes(".filter-duration");
    if (selectedDuration) {
        params.duration_day = selectedDuration;
    }
        // Fetch Amenities If any
    let selectedAmenities = compiledCheckboxes(".filter-amenities");
    if (selectedAmenities) {
        params.amenities = selectedAmenities;
    }
 // Fetch package type If any
    let selectedPackageTypes = compiledCheckboxes(".filter-package-types");
    if (selectedPackageTypes) {
        params.package_types = selectedPackageTypes;
    }

        // Fetch  type If any
    let selectedTypes = compiledCheckboxes(".filter-types");
    if (selectedTypes) {
        params.types = selectedTypes;
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
     // Fetch term activity list If any
    let selectedTermActivityLists = compiledCheckboxes(".filter-term-activity-lists");
    if (selectedTermActivityLists) {
        params.term_activity_lists = selectedTermActivityLists;
    }  
    // Fetch rating If any
    let selectedRating = compiledCheckboxes(".filter-rating");
    if (selectedRating) {
        params.rating = selectedRating;
    } 
    // Fetch activity-package-lists If any
    let selectedActivityPackageList = compiledCheckboxes(".filter-activity-package-lists");
    if (selectedActivityPackageList) {
        params.activity_package_lists = selectedActivityPackageList;
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

function getBoundsZoomLevel(bounds) {
        // Calculate the zoom level required to fit all of the markers on the map.
    map.fitBounds(bounds);
}

function calculateAndSetZoomLevel() {
        // Get the bounds of all of the markers.
    let bounds = new google.maps.LatLngBounds();
    for (let i = 0; i < markers.length; i++) {
      bounds.extend(markers[i].getPosition());
  }
        // Calculate the zoom level required to fit all of the markers on the map.

        // var zoomLevel = map.getBoundsZoomLevel(bounds);
  var zoomLevel = 20;
  getBoundsZoomLevel(bounds);

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
                    map: map,
                    icon:markerIcon
                });

                markers.push(marker);
            }
        });
        if(markers.length > 0) {
            let firstMarker = markers[0];
            map.setCenter(firstMarker.getPosition())
            calculateAndSetZoomLevel();

            map.panTo(firstMarker.getPosition());

                // Refresh Map
            google.maps.event.trigger(map, 'resize');
        }

    },0)
};



    // Common Function to Hit and get data
const fetchRecords = (view, options = {}) => {
        // TODO: Place check; so that it only works for hotel list page
        // possibly add page in body class
    let get_hotel = $('#result-info').data('type');

    if (typeof get_hotel != 'undefined') {
        if (get_hotel == 'get-locations') {
            view = 'grid';
        }
        let endpoint = base_url + "/"+get_hotel+"/" + view;

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
    }
};


    // Initially Load Hotels
fetchRecords("list", fetchParameters());

if(resultInfo.length > 0) {
        // Initially Load Hotels
    fetchRecords("list", fetchParameters());
}


    // Load Map
function loadMap() {
    let mapElm = document.getElementById('map-main')
    if(mapElm){
        map = new google.maps.Map(mapElm, {
            center: {
                lat: 28.7041,
                lng: 77.1025
            },
            zoom: 20,
            panControl: true,
            fullscreenControl: true,
            animation: google.maps.Animation.BOUNCE,
            gestureHandling: 'cooperative',
        });
    }

}

loadMap();


function loadStreetMap() {
    let mapElm = document.getElementById('map-street')
    if(mapElm){
        map = new google.maps.Map(mapElm, {
            center: {
                lat: parseFloat(mapElm.getAttribute("lat")),
                lng: parseFloat(mapElm.getAttribute("lng"))
            },
            zoom: (mapElm.getAttribute("zoom_level") > 1)?parseFloat(mapElm.getAttribute("zoom_level")):20,
            panControl: true,
            fullscreenControl: true,
            animation: google.maps.Animation.BOUNCE,
            gestureHandling: 'cooperative',
            streetViewControl: false,
            
        });

            let panorama = map.getStreetView(); // TODO fix type
            panorama.setPosition({
                lat: parseFloat(mapElm.getAttribute("lat")),
                lng: parseFloat(mapElm.getAttribute("lng"))
            });
            // panorama.setVisible(true);

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(mapElm.getAttribute("lat"), mapElm.getAttribute("lng")),
                map: map,
                icon:markerIcon
            });

            markers.push(marker);
        }

    }

    loadStreetMap()

    // View Changer Grid -> List -> Grid ---
    resultInfo.on("click", ".view-changer", function () {
        $(this).parents("ui").first().find("li").removeClass("active");
        $(this).parents("li").first().addClass("active");
        let view = $(this).attr("view-id");
        fetchRecords(view, fetchParameters());
    });

    // Filter Price Apply Button
    $(".btn-filter-price").on("click", function () {
        let view = $(".view-changer").attr("view-id");
        fetchRecords(view, fetchParameters());
    });

    // Filter Checkbox Change
    $(".filter-option").on("change", function () {
        let view = $(".view-changer").attr("view-id");
        fetchRecords(view, fetchParameters());
    });

    resultInfo.on("click", ".page-link", function () {
        let view = $(".view-changer").attr("view-id");
        let pageId = $(this).attr("pageid");
        let params = fetchParameters();
        params.pageNo = pageId;
        fetchRecords(view, params);
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
                    response(data);
                },
            });
        },
        minLength: 2,
        select: function (event, ui) {
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


    let tourism_link_elm = document.getElementById('tourism-zone-link')
    if(tourism_link_elm) {
        tourism_link_elm.onclick = function() {
            $('#tourism-zone-area').toggle()
        }
    }

    $('.tzone-link').on("click", function() {
        let targetDivId = $(this).attr('targetdiv')
        if($(targetDivId).is(':visible')) {
            $(targetDivId).show();
        }else {
            $('.zone-data').hide();
            $(targetDivId).show();
        }

    })


    $('body.tour-detail-page #st-program-section .panel-collapse').on('show.bs.collapse', function () {
        $(this).siblings('body.tour-detail-page #st-program-section .panel-heading').addClass('active');
    });

    $('body.tour-detail-page #st-program-section .panel-collapse').on('hide.bs.collapse', function () {
        $(this).siblings('body.tour-detail-page #st-program-section .panel-heading').removeClass('active');
    });
 // var firstTabEl = document.querySelector('#policies-activity li:last-child a')
 //  var firstTab = new bootstrap.Tab(firstTabEl)

 //  firstTab.show()

})();
