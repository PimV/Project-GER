function deleteClass() {
    var id = getSelectedItemId();
    if($("#"+id+" td").last().text().length) {
        showError("Deze klas staat momenteel open voor beoordelingen en kan daarom niet verwijderd worden.");
    }
    else {
        openCover('confirmationCover');
    }
}