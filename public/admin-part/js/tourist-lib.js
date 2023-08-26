$(document).ready(function () {
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
            console.log(recentUsedIndex)
            let newIndex = recentUsedIndex + 1
            console.log(newIndex)
            // Update HTML
            let pattern = /\[(\d+)\]/g; // pattern [<number>] TODO: think better Solution

            // Change Pattern
            let newHtmlContent = html.replace(pattern, "[" + newIndex + "]");


            targetElem.append(newHtmlContent)
            targetElem.attr("index", newIndex)

        }


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
    } // If Block Ends

})