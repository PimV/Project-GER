var currentlySelected = Array();

/*
 * Selection scripts
 * Enables selecting of items
 * -Lists
 * -Table rows
 */

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

$( document ).ready(function() {    
    //Makes it possible to select an item in the item lists.
    $( "ul" ).on('click','li',function() {
        var controlList = $(this).parent(); 
        controlList.each(function(){
            var listItem = $(".selected");   
            listItem.removeClass("selected");
        });    
        $( this ).addClass("selected");
    });
    
});

/*
 * List specific jquery
 * enables transfer of items
 * -left and right
 * -null reff safe
 */

//Transfer left
$( document ).ready(function() {    
    //Makes it possible to select an item in the item lists.
    $( '.listViewControl [name="Left"]' ).click(function() {        
        var listContainer = $(this).parent().parent();
        var rightList = listContainer.find('[alt="right"]');
        var leftList = listContainer.find('[alt="left"]');
                
        rightList.each(function(){
            var listItem = $(".selected");
            if(listItem.text() !== "")
            {
                leftList.append('<li class="listItem">' + listItem.text() + '</li>');    
                listItem.remove();
            }
        });           
    });    
});

//Transfer Right
$( document ).ready(function() {    
    //Makes it possible to select an item in the item lists.
    $( '.listViewControl [name="Right"]' ).click(function() {   
        var listContainer = $(this).parent().parent();
        var rightList = listContainer.find('[alt="right"]');
        var leftList = listContainer.find('[alt="left"]');
                
        leftList.each(function(){
            var listItem = $(".selected");
            if(listItem.text() !== "")
            {
                rightList.append('<li class="listItem">' + listItem.text() + '</li>');    
                listItem.remove();
            }
        });           
    }); 
});


function getSelectedItemId(tableID){
    if(tableID === undefined || tableID === null || tableID === ""){}
    return currentlySelected[tableID].id;
}