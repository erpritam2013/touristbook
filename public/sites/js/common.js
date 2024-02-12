(function () {
    var base_url = $("#base-url").val();
    const moreLi = $(".more-li");
    const resultInfo = $("#result-info");
    var map;
    var markerIcon = {
        anchor: new google.maps.Point(22, 16),
        url: $('meta[name="map-hotel-marker"]').attr('content'),
    }
    var markers = [];

    function isMobile() {
     if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
       return true;
   }
   return false;
}

$('body .div-desc *').removeAttr('style');

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

const showMoreDataBody = (get_html_,chr_count) => {
 if(typeof(chr_count) != "undefined" && parseInt(chr_count) > 700){   
    $('body #showMoreDataBody').css('overflow','auto').css('height','350px').html(get_html_);
}else{
    $('body #showMoreDataBody').removeAttr('style').html(get_html_);
}

}

window.showMoreData = function(data){

    let label = $(data).data('more_data_label');
    let showMoreData = $(data).data('more_data');
    let total_chr = $(data).data('total_chr');
    $('body #showMoreDataLabel').text(label);
    
    if (isJSON(showMoreData)) {
        showMoreData = JSON.stringify(showMoreData);
        let result = JSON.parse(showMoreData);
        /*show amenities*/

        if (label == 'Amenities') {
            let get_html = showAmenities(result);
            
            showMoreDataBody(get_html,total_chr);
            
        }else if (label == 'Activity List') {
           let get_html = showAmenities(result);
           showMoreDataBody(get_html,total_chr);
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
showMoreDataBody(html,total_chr);
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
  let desc_id = $(btn).data('desc_id');
  let desc = '';
  if (typeof desc_id != 'undefined') {
    desc = $(`${desc_id}`);
}else{
    desc = $(`#long-description-${key}`);
}

let show_text = '';
show_text = $(desc).data('show_text');
  //console.log(show_text)
if (show_text === "more") {
    desc.css({'height':'100%'});
    btn.innerHTML = "Read Less";
    $(desc).data('show_text','less').attr('data-show_text','less');
}else{
    desc.css({'height':'170px'});
    btn.innerHTML = "Read More";
    $(desc).data('show_text','more').attr('data-show_text','more');
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

window.readMoreActivityList = function(ele) {
  let btn = ele;
  let parent = $(btn).parent('.activity-list');
  let activity_list_item = $(parent).find('.st-activity-item');
  let show_text = $(btn).data('show_text');

  if (show_text === 'more') {
    btn.innerHTML = "Show Less...";
    $(btn).data('show_text','less').attr('data-show_text','less');
}else{
    btn.innerHTML = "Show All...";
    $(btn).data('show_text','more').attr('data-show_text','more');
}
console.log(activity_list_item)
if (activity_list_item.length != 0) {
  $.each(activity_list_item,function(key,value){

      if (key <= 1) {
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



window.readMoreActivityPackage = function(ele) {
  let btn = ele;
  let parent = $(btn).parent('.activity-packages');
  let activity_package_item = $(parent).find('.activity-packages-item');
  let show_text = $(btn).data('show_text');

  if (show_text === 'more') {
    btn.innerHTML = "Show Less...";
    $(btn).data('show_text','less').attr('data-show_text','less');
}else{
    btn.innerHTML = "Show All...";
    $(btn).data('show_text','more').attr('data-show_text','more');
}
console.log(activity_package_item)
if (activity_package_item.length != 0) {
  $.each(activity_package_item,function(key,value){

      if (key == 0) {
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
window.tourism_zone_area_pdf = function(ele){


    let id = $(ele).attr('href');
    if (typeof id != 'undefined') {

        let t = $(id);
        let parent = t.parent('div.tab-content');
        let parent_nav_tab = $(ele).parent('.nav-item').parent('ul.custom-tabs-detail');

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
        $(ele).addClass('active');
        // t.hide();
        // $(window).scrollTop(top);
        $('html, body').animate({scrollTop:top}, 'slow');
        return false;
    }
}

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
    // Fetch other package If any
    let selectedOtherPackage = compiledCheckboxes(".filter-other-package");
    if (selectedOtherPackage) {
        params.other_packages = selectedOtherPackage;
    }

     // Fetch other package If any
    let selectedOtherPackageParent = compiledCheckboxes(".filter-other-package-parent");
    if (selectedOtherPackageParent) {
        params.other_package_parent = selectedOtherPackageParent;
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



const buildContent = (hotel) => {
  const content = document.createElement("div");
  content.classList.add("right-box");
  content.classList.add("infoBox");
  content.innerHTML = `<div class="listroBox">
  <figure><a href="${hotel.url}"><img src="${hotel.featured_image}" class="img-fluid" alt="hotel image">
  </a> </figure>
  <div class="listroBoxmain p-2">
  <h2 class="service-title"><a href="${hotel.url}">${hotel.name}</a></h2>
  ${hotel.is_featured}
  <p class="service-location">${hotel.map_icon}${hotel.address}</p>
  <ul class="near-price-block">
  <li class="mt-0 mb-0 near-price-block-1">
  <p class="card-text text-muted ">
  <span class="h6 text-primary">
  <span class="hotel-avg">
  ${hotel.price_icon}
  Avg
  </span>${hotel.price}</span> / per night</p>
  </li>
  </ul>
  </div>
  </div>
  `;

  return content;
}

// const toggleHighlight = (content) => {
//     console.log(markerView.content)
//     if (content.classList.contains("highlight")) {
//         content.classList.remove("highlight");
//         content.classList.remove("right-box")
       
//     } else {
//         content.classList.add("highlight");
//         content.classList.add("right-box")
        
//     }
// }

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
        if ($('body').hasClass('hotel-list-page')) {
            $('.listroBox').each(function() {
                let longitude = $(this).attr("longitude");
                let latitude = $(this).attr("latitude");
                let hotel__ = $(this).attr("hotel");
                let name = $(this).attr("name");
                let hotel = [];
                if (isJSON(hotel__)) {
                  hotel = $.parseJSON(hotel__);
              }
              if(longitude && latitude){
                var marker = new google.maps.Marker({

                    position: new google.maps.LatLng(latitude, longitude),
                    map: map,
                    icon:markerIcon,
                    title:name
                });

                var infowindow = new google.maps.InfoWindow({

                    content:buildContent(hotel),
                });

        // show info window when marker is clicked
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open( map, marker );

                });

        // google.maps.event.addListener(marker, 'mouseout', function() {

        //     infowindow.close();

        // });
              //    marker.addListener("click", () => {
              //     
              // });


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
        }
    },0)
};


// Reset Clear Filter
$(".btn-clear-filter").on("click", function() {
    let view = $(".view-changer").attr("view-id");
    // Checkboxes Reset
    $('.filter-option').prop('checked', false);
    // Radio Button Reset
    $(".custom-control-input").prop("checked", false);
    fetchRecords(view, fetchParameters())
    return false;

})


    // Common Function to Hit and get data
const fetchRecords = (view, options = {}) => {
        // TODO: Place check; so that it only works for hotel list page
        // possibly add page in body class
    let get_hotel = $('#result-info').data('type');

    if(Object.keys(options).length > 0){
        // Selected Something and Need to Show Clear Filter
        $(".btn-clear-filter").show()
    }else {
        // Not Selected; Can Hide Clear Filter
        $(".btn-clear-filter").hide()
    }

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


function loadOtherMap() {

    let mapElm = document.querySelectorAll('#map-location #map-street')[0]

    if(mapElm){
        let latitude = parseFloat(mapElm.getAttribute("lat"));
        let longitude = parseFloat(mapElm.getAttribute("lng"));

        if (!isNaN(latitude) && !isNaN(longitude)) {
            $(mapElm).html('');
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

            let panorama = map.getStreetView();
            panorama.setPosition({
                lat: parseFloat(mapElm.getAttribute("lat")),
                lng: parseFloat(mapElm.getAttribute("lng"))
            });
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(mapElm.getAttribute("lat"), mapElm.getAttribute("lng")),
                map: map,
                animation: google.maps.Animation.DROP,
                icon:markerIcon
            });

            markers.push(marker);
        }else{
            $(mapElm).html('<div class="map-error-div"><img src="/sites/images/map-error/map-error-img.png" width="100" height="100" alt="map-error"><br/><span class="map-error">Map Not Founded!</span></div>');
        }

    }


}

loadOtherMap()


function loadStreetMap() {
    let mapElm = document.querySelectorAll('.modal #map-street')[0]
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
        if ($(this).hasClass('filter-other-package-parent')) {
            // console.log($(this).data('parent'))
            if (typeof $(this).data('parent') != 'undefined') {

                let parent = $(this).closest('.main-title-tal')

            // console.log(parent);
                if ($(parent).hasClass('collapsed')) {

                 $(".filter-other-package:checked").each(function () {
                    $(this).prop('checked', false).trigger('change');
                });

             }
         }


     }
     fetchRecords(view, fetchParameters());
 });

    resultInfo.on("click", ".page-link", function () {
        let view = $(".view-changer").attr("view-id");
        let pageId = $(this).attr("pageid");
        let params = fetchParameters();
        params.pageNo = pageId;
        fetchRecords(view, params);
    });

    const home_page_search_input_add = (current_t) => {
        let home_page_search_tabs = $('.tab_container').data('tabs');
        let html = '<input type="hidden" name="source_type"  />';
        html += '<input type="hidden" name="source_id"  />';

        for (var i = 1; i <= parseInt(home_page_search_tabs); i++) {
            if ($(`#content${i}`).length != 0) {
                $(`#content${i}`).find('[name="search"]').first().val('');
                $(`#home-extra-input-field-${i}`).html("");
            }
        }
        $(`#content${current_t}`).find('[name="search"]').first().val('');
        $(`#home-extra-input-field-${current_t}`).html(html);

    }
    $('.tab_container').on('change','[id^="tab"]',function(){
     home_page_search_input_add($(this).data('index'));
 })

    $("#input-search-box").autocomplete({


     search: function(event, ui) { 
       $('.map-content-loading-search-input').show();
   },
   response: function(event, ui) {
       $('.map-content-loading-search-input').hide();
   },
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

            response($.map(data, function(item) {
             item.value =  $(`<span></span>`).html(item.value).text();
             return item;
         }));

        },
    });
},
open: function() {
    $(this).autocomplete("widget")
    .appendTo("#search-result-info")
    .css({position: 'relative',top: '0px',left: '0px',width:'67%!important',marginTop:'0px',marginLeft:'0px',border: '1px solid #ddd'});
},
minLength: 2,
select: function (event, ui) {
    $("input[name=source_type]").val(ui.item.sourceType);
    $("input[name=source_id]").val(ui.item.id);
    $('.map-content-loading-search-input').show();
    setTimeout(function(){
        $('#search-form-result').submit();
        $('.map-content-loading-search-input').hide();
    },0);
},
}).autocomplete("instance")._renderItem = function(ul, item) {
     let icon = $('.map-icon').text();
     return $("<li>")
     .append(`<div>${item.label}<span style='float: left'>${icon}</span></div>`)
     .appendTo(ul);
 };
 $(".input-search-box").autocomplete({


     search: function(event, ui) { 
       $('.map-content-loading-search-input').show();
   },
   response: function(event, ui) {
       $('.map-content-loading-search-input').hide();
   },
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

            response($.map(data, function(item) {
             item.value =  $('<span></span>').html(item.value).text();
             return item;
         }));

        },
    });
},


    /* display: none; */
open: function() {
    $(this).autocomplete("widget")
    .appendTo((!isMobile())?"#search-result-info":$(this).parent())
    .css({position: 'relative',top: '0px',left: '0px',marginTop:'0px',marginLeft:'0px'});
},
minLength: 2,
select: function (event, ui) {
    $("input[name=source_type]").val(ui.item.sourceType);
    $("input[name=source_id]").val(ui.item.id);
    let form_id = $(this).data('form_id');
    setTimeout(function(){
        $(form_id).submit();      
    },0);
},
}).autocomplete("instance")._renderItem = function(ul, item) {

    return $("<li>")
    .append("<div>" + item.label + `<span style='float: left;margin-right:5px;'><span class="fas fa-map-marker-alt"></span></span></div>`)
    .appendTo(ul);
};

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



// Function to get currency icon based on currency code
function getCurrencyIcon(currencyCode) {
    // TODO: Write Code
    return '<i class="fa fa-money mr-2"></i>'

}

// Function to update session with selected currency
function updateSession(currency) {
    fetch('/updateCurrency', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ currency: currency })
    })
    .then(response => {
        if (response.ok) {
            console.log('Session updated successfully.');
            window.location.reload();
        } else {
            console.error('Failed to update session.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}// Function to update session with selected language
function updateLanguageSession(language,langText,img_src) {
    fetch('/updateLanguage', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ lang:language,languageText:langText,img_src })
    })
    .then(response => {
        if (response.ok) {
            console.log('Session updated successfully.');
           // window.location.reload();
        } else {
            console.error('Failed to update session.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Currency Changer
$("#currency-dropdown .dropdown-item").on("click", function() {
    let selectedCurrency = $(this).attr('data-value');
    let currencyIcon = getCurrencyIcon(selectedCurrency);

    document.getElementById('dropdownCurrency').innerHTML = currencyIcon + selectedCurrency

    // Send AJAX request to update session
    updateSession(selectedCurrency);
});


const triggerEvent = (element,eventName) =>{
    const event = new Event(eventName);
    element.dispatchEvent(event);
};


// triggers onchange event on <select>

// language Changer
$("#languageChange .dropdown-item").on("click", function() {
    let selectedLanguage = $(this).attr('data-lang');
    let selectedLanguageText = $(this).data('text');
    let selectedLanguageImage = $(this).find('.dropdown-item-icon').first().attr('src');
    // let currencyIcon = getCurrencyIcon(selectedCurrency);
    let image_lang = `<img class="dropdown-item-icon"
                          src="${selectedLanguageImage}" alt="">${selectedLanguageText}`;
    document.getElementById('dropdownLanguage').innerHTML = image_lang

    // console.log(selectedLanguage)

    $('.goog-te-combo').change(function(){
        var data= $(this).val();
        console.log(data);            
    });
    // $('.goog-te-combo')
    //     .val(selectedLanguage)
    //     .trigger('change');
    let select = document.querySelector('.goog-te-combo');
    select.value = selectedLanguage
     triggerEvent(select,'change');
    // $('#google_translate_element .goog-te-combo').val(selectedLanguage).trigger('onChange')
    // Send AJAX request to update session
    updateLanguageSession(selectedLanguage,selectedLanguageText,selectedLanguageImage);
});



window.ShowHidePassword = () => {
  var x = document.getElementById("rg-password");
  if (x.type === "password") {
    x.type = "text";
} else {
    x.type = "password";
}
}

$('.hotel-detail-page .important-note-icon').mouseenter(function(){
    let parent_class = $(this).data('parent_title');
    $(`body .${parent_class}`).css({visibility:'visible',opacity:1});
})
$('.hotel-detail-page .important-note-icon').mouseleave(function(){
    let parent_class = $(this).data('parent_title');
    $(`body .${parent_class}`).css({visibility:'hidden',opacity:0});
}).mouseleave();

})();
