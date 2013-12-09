var currentlySelected = Array();

$( document ).ready(function() {
    
    //Makes it possible to select an item in the item lists.
    $( "table tbody tr" ).click(function() {
        var table = $(this).parent().parent();
        if(!table.hasClass("noAction")){
            $( currentlySelected[table.id] ).removeClass("selected");
            currentlySelected[table.id] = this;
            $( this ).addClass("selected");
        }
    });
    
});

function getSelectedItemId(tableID){
    if(tableID === undefined || tableID === null || tableID === ""){}
    return currentlySelected[tableID].id;
}