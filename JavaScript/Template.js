var currentlySelected;

$( document ).ready(function() {
    
    //Makes it possible to select an item in the item lists.
    $( "tbody tr" ).click(function() {
        $( currentlySelected ).css({
            "color": "",
            "background-color": ""
        });
        
        currentlySelected = this;
        
        $( this ).css({
            "color": "#ffffff",
            "background-color": "#008080"
        });
    });
    
});

function getSelectedItemId(){
    return currentlySelected.id;
}