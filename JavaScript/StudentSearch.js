function showId(){
    var a = document.getElementById("dropdownClass");
    var id = a.options[a.selectedIndex].value;
    alert("Het unique database ID van deze klas is: " + id);
}