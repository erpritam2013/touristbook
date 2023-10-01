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

    const getSelectedPrice = () => {
        const selectedPriceElem = $('input[name=price]:checked')
        return selectedPriceElem.val()
    }

    const getSelectedPropertyTypes = () => {
        let checkedValues = [];
        // Loop through each checkbox
        $(".filter-property-types:checked").each(function() {
            checkedValues.push($(this).val());
        });

        // Join the checked values into a comma-separated string
        return checkedValues.join(",");
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
        let selectedPropertyTypes = getSelectedPropertyTypes()
        if(selectedPropertyTypes) {
            params.propertyTypes = selectedPropertyTypes
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
