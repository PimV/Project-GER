var imageUrl = new Array();
var chartData;
var saveAllowed = false;
var exportAllowed = true;

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

function createChart(canvas, naam, rubrieken, punten, maximaal){
    //TODO: naam, leerjaar en blok meegeven aan methode
    var rose = new RGraph.Rose(canvas, punten)
    .Set('labels', rubrieken)
    .Set('labels.axes', 'n')
    .Set('title', naam)
    .Set('title.y', 20)
    .Set('background.axes', false)
    .Set('colors.sequential', true)
    .Set('margin', 0)
    .Set('labels.count', maximaal)
    .Set('background.grid.count', maximaal)
    .Set('ymax', maximaal)
    .Set('radius', 170)
    .Set('background.grid.spokes', rubrieken.length)
    .Set('colors', ['Gradient(green)'])
    .Draw();
};	

function createUrl(naam){	
    var canvas = document.getElementById(naam);
    imageUrl.push(canvas.toDataURL());
};

function exportClicked(){
    if(exportAllowed){
        if(imageUrl.length === 1)
        {
            $("<form method='post' action='index.php?p=export' target='blank'><input type='hidden' name='c' value='resultaat'><input type='hidden' name='d' value='" + chartData + "'><input type='hidden' name='i1' value='" + imageUrl[0] + "'></form>").appendTo('body').submit();
        }else{
            $("<form method='post' action='index.php?p=export' target='blank'><input type='hidden' name='c' value='resultaat'><input type='hidden' name='d' value='" + chartData + "'><input type='hidden' name='i1' value='" + imageUrl[0] + "'><input type='hidden' name='i2' value='" + imageUrl[1] + "'></form>").appendTo('body').submit();
        }
    }
}
