function reloadComboAjaxClass(studentId){

    var e = document.getElementById("comboJaar");
    var schooljaar = e.options[e.selectedIndex].value;
    
    $.ajax({
        url: "index.php?p=ajaxresultaatklassencontroller&id=" + studentId + "&l=" + schooljaar,
        success: function(data) {
            $("#tdComboAjaxClass").html(data);
           }
    })
    .done(function(){
        reloadDivAjaxResults(studentId);
    }); 
}

function reloadDivAjaxResults(studentId){
    
    var e = document.getElementById("comboKlas");
    var klas = e.options[e.selectedIndex].value;
    
    $.ajax({
        url: "index.php?p=ajaxresultaatresultatencontroller&id=" + studentId + "&k=" + klas,
        success: function(data) {
            $("#divTableAjaxResult").html(data);
           }
    });
}

function submitFormTotalRating(){
    document.forms["eindbeoordeling"].submit();
}
