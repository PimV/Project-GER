function showKlasId() {
    var a = document.getElementById("");
    var id = a.options[a.selectedIndex].value;
    alert("Het unique database ID van deze klas is: " + id);
}