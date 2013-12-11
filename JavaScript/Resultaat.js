function reloadComboAjaxClass(){
    $.ajax({
        url: "test.html",
        context: "#tdComboAjaxClass"
    });
}

function submitFormTotalRating(){
    document.forms["eindbeoordeling"].submit();
}