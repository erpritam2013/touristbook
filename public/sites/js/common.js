(function() {

    var base_url = $("#base-url").val();
    const moreLi = $('.more-li')
    const resultInfo = $('#result-info')

    moreLi.on("click", function() {
        $(this).parent().find('.li-hide').removeClass('li-hide');
        $(this).remove()
    })

    // Function to show the loader
    function showLoader() {
        $('.map-content-loading').show();
    }

    // Function to hide the loader
    function hideLoader() {
        $('.map-content-loading').hide();
    }

    // Set up AJAX loader
    $.ajaxSetup({
        beforeSend: showLoader,
        complete: hideLoader
    });

    const compiledCheckboxes = (selector) => {
        let checkedValues = [];
        // Loop through each checkbox
        $(selector+":checked").each(function() {
            checkedValues.push($(this).val());
        });

        // Join the checked values into a comma-separated string
        return checkedValues.join(",");

    }

    const getSelectedPrice = () => {
        const selectedPriceElem = $('input[name=price]:checked')
        return selectedPriceElem.val()
    }

    // Fetch Parameter for search
    const fetchParameters = () => {
        params = {}
        // Fetch Range If any
        let selectedPriceRange = getSelectedPrice()
        if(selectedPriceRange) {
            params.range = selectedPriceRange
        }
        // Fetch Property Types If any
        let selectedPropertyTypes = compiledCheckboxes(".filter-property-types")
        if(selectedPropertyTypes) {
            params.propertyTypes = selectedPropertyTypes
        }

        // Fetch Amenities If any
        let selectedAmenities = compiledCheckboxes(".filter-amenities")
        if(selectedAmenities) {
            params.amenities = selectedAmenities
        }

        // Fetch Medicares If any
        let selectedMedicares = compiledCheckboxes(".filter-medicare")
        if(selectedMedicares) {
            params.medicares = selectedMedicares
        }

        // Fetch Meetings If any
        let selectedMeeting = compiledCheckboxes(".filter-meeting")
        if(selectedMeeting) {
            params.meeting = selectedMeeting
        }

        // Fetch Deals If any
        let selectedDeals = compiledCheckboxes(".filter-deal")
        if(selectedDeals) {
            params.deals = selectedDeals
        }

        // Fetch Activities If any
        let selectedActivities = compiledCheckboxes(".filter-activities")
        if(selectedActivities) {
            params.activities = selectedActivities
        }


        return  params
    }

    // Process the Result
    const processedResultInfo = (html) => {
        resultInfo.html(html);
    }

    // Common Function to Hit and get data
    const fetchHotels = (view, options = {}) => {
        console.log(options)
        let endpoint = base_url+'/get-hotels/'+view

        $.ajax({
            type: "GET",
            dataType: "html",
            url: endpoint,
            data: options,
            success: function (data) {
                processedResultInfo(data);
            },
        });
    }

    // Initially Load Hotels
    fetchHotels('list', {})

    // View Changer Grid -> List -> Grid ---
    resultInfo.on("click", ".view-changer", function() {
        $(this).parents('ui').first().find('li').removeClass('active');
        $(this).parents('li').first().addClass('active');
        let view = $(this).attr('view-id');
        fetchHotels(view, fetchParameters());
    })

    // Filter Price Apply Button
    $('.btn-filter-price').on("click", function() {
        let view = $(".view-changer").attr('view-id')
        fetchHotels(view, fetchParameters())
    })

    // Filter Checkbox Change
    $('.filter-option').on('change', function() {
        let view = $(".view-changer").attr('view-id')
        fetchHotels(view, fetchParameters())
    })

    resultInfo.on("click", ".page-link", function() {

        let view = $(".view-changer").attr('view-id')
        let pageId = $(this).attr("pageid")
        let params = fetchParameters()
        params.pageNo = pageId
        fetchHotels(view, params)
    })



    $('.Filter-left').on('click','.mb-left-title',function(){
        
      $(this).closest('.mb-left').find('.form-group').first().toggle('1000');

     let mb_left_title_i =  $(this).find('i');
     if (mb_left_title_i.hasClass('fa-angle-up')) {
        mb_left_title_i.removeClass('fa-angle-up');
        mb_left_title_i.addClass('fa-angle-down');
     }else if(mb_left_title_i.hasClass('fa-angle-down')){
        mb_left_title_i.removeClass('fa-angle-down');
         mb_left_title_i.addClass('fa-angle-up');
     }

    });


})()
