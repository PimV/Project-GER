function deleteClass() {
    var id = getSelectedItemId();
    alert($("#"+id+" td").last().text().length);
    if($("#"+id+" td").last().text().length) {
        showError("Deze klas staat momenteel open voor beoordelingen en kan daarom niet verwijderd worden.");
    }
    else {
        openCover('confirmationCover');
    }
}