var imageUrl;
var saveAllowed = false;

function reloadComboAjaxClass(studentId){

    var e = document.getElementById("comboJaar");
    var schooljaar = e.options[e.selectedIndex].value;
    
    $.ajax({
        url: "index.php?p=ajaxresultaatklassen&id=" + studentId + "&l=" + schooljaar,
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
    
    var d = document.getElementById("comboJaar");
    var jaar = d.options[d.selectedIndex].value;
    
    $.ajax({
        url: "index.php?p=ajaxresultaatresultaten&id=" + studentId + "&k=" + klas + "&s=" + jaar,
        success: function(data) {
            $("#divTableAjaxResult").html(data);
           }
    }); 
}

function saveButtonClicked(){
    if(saveAllowed){
        openCover('cover')
    }
}

function submitFormTotalRating(){
    $('#formFinalResults').submit();
}

function createChart(rubrieken, punten, maximaal){
    //TODO: naam, leerjaar en blok meegeven aan methode
    var rose = new RGraph.Rose('cvs', punten)
    .Set('labels', rubrieken)
    .Set('labels.axes', 'n')
    .Set('title', 'Piet Jansen, leerjaar 1 e41a blok wind')
    .Set('title.y', 20)
    .Set('background.axes', false)
    .Set('colors.sequential', true)
    .Set('margin', 0)
    .Set('labels.count', maximaal)
    .Set('background.grid.count', maximaal)
    .Set('ymax', maximaal)
    .Set('radius', 170)
    .Set('background.grid.spokes', 12)
    .Set('colors', ['Gradient(green)'])
    .Draw();
};	

function createUrl(){	
    var canvas = document.getElementById('cvs');
    imageUrl = canvas.toDataURL();
};

function exportClicked(){
    $("<form method='post' action='index.php?p=export' target='blank'><input type='hidden' name='c' value='resultaat'><input type='hidden' name='i' value='" + imageUrl + "'></form>").appendTo('body').submit();
}
