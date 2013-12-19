var currentlySelected = Array();

/*
 * For opening and closing cover
 * requires cover object id as string
 */
function openCover(coverId) {
    $('#' + coverId).fadeIn("slow");
}

function closeCover(coverId) {
    $('#' + coverId).fadeOut("slow");
}


/*
 * Selection scripts
 * Enables selecting of items
 * -Lists
 * -Table rows
 */

$(document).ready(function() {
    //Makes it possible to select an item in the item lists.
    $("table tbody tr").click(function() {
        var table = $(this).parent().parent();
        if (!table.hasClass("noAction")) {
            $(currentlySelected[table.id]).removeClass("selected");
            currentlySelected[table.id] = this;
            $(this).addClass("selected");
        }
    });

});

//TODO: Dit heeft effect op ALLE ul lijsten... Wat als ik nu een normale ul list wil maken zonder dat ze de 'selected' class krijgen wanneer ik er op klik? Denk niet dat we dat zullen
//doen in dit project, maar in het geval dat, zou het mogelijk wel een probleem kunnen zijn. 
$(document).ready(function() {
    //Makes it possible to select an item in the item lists.
    $("ul").on('click', 'li', function() {
        var controlList = $(this).parent();
        controlList.each(function() {
            var listItem = $(".selected");
            listItem.removeClass("selected");
        });
        $(this).addClass("selected");
    });

});

/*
 * List specific jquery
 * enables transfer of items
 * -left and right
 * -null reff safe
 */

//Transfer left
$(document).ready(function() {
    //Makes it possible to select an item in the item lists.
    $('.listViewControl [name="Left"]').click(function() {
        var listContainer = $(this).parent().parent();
        var rightList = listContainer.find('[alt="right"]');
        var leftList = listContainer.find('[alt="left"]');

        rightList.each(function() {
            var listItem = $(".selected");
            if (listItem.text() !== "")
            {
                if (listItem.parent().attr('alt') !== "left")
                {
                    if($(listItem).next().length) {
                        $(listItem).next().trigger("click");
                    }
                    else if ($(listItem).prev().length) {
                        $(listItem).prev().trigger("click");
                    }
                    else {
                        $(listItem).removeClass("selected");
                    }
                    leftList.append(listItem);
                }
            }
        });
    });
});

//Transfer Right
$(document).ready(function() {
    //Makes it possible to select an item in the item lists.
    $('.listViewControl [name="Right"]').click(function() {
        var listContainer = $(this).parent().parent();
        var rightList = listContainer.find('[alt="right"]');
        var leftList = listContainer.find('[alt="left"]');

        leftList.each(function() {
            var listItem = $(".selected");
            if (listItem.text() !== "")
            {
                if (listItem.parent().attr('alt') !== "right")
                {
                    if($(listItem).next().length) {
                        $(listItem).next().trigger("click");
                    }
                    else if ($(listItem).prev().length) {
                        $(listItem).prev().trigger("click");
                    }
                    else {
                        $(listItem).removeClass("selected");
                    }
                    rightList.append(listItem);
                }
            }
        });
    });
});


/**
 * Add the custom transfer lists to your form. You should do this right before submitting it.
 * 
 * @param {elementID} formID The ID of the form to add the list(s) to.
 * @param {elementID} listID The ID of the transfer list. You can enter multiple of these.
 */
function addTranserListsToForm(formID, listID)
{
    for (var i = 1; i < arguments.length; i++) {

        var listids = $("#" + arguments[i] + " > li").map(function() {
            return this.id;
        }).get();

        $("#" + formID + " input[name='" + arguments[i] + "[]']").each(function() {
            $(this).remove();
        });

        if (listids.length == 0) {
            $("#" + formID).append("<input type='hidden' name='" + arguments[i] + "'/>");
        }
        else {
            for (var j = 0; j < listids.length; j++) {
                $("#" + formID).append("<input type='hidden' name='" + arguments[i] + "[]' value='" + listids[j] + "'/>");
            }
        }
    }
}

/**
 * Get the selected item in an item list list. 
 * 
 * @param {elementID} tableID The ID of the list to get the selected item from.
 * @returns {elementID} The ID of the selected list item. 
 */
function getSelectedItemId(tableID) {
    if (typeof currentlySelected[tableID].id === 'undefined') {
        return -1;
    } else {
        return currentlySelected[tableID].id;
    }
    // return currentlySelected[tableID].id;
}

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function deleteClicked(id) {
    if (typeof id === 'undefined') {

    } else {
        openCover('cover');
    }
}

