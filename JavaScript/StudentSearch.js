$(function() {
    $("#datepicker1").datepicker();
});
$(function() {
    $("#datepicker2").datepicker();
});

function showId() {
    var a = document.getElementById("dropdownClass");
    var id = a.options[a.selectedIndex].value;
    if (id === '') {
        window.location.href = "index.php?p=studentsearch";
    } else {
        window.location.href = "index.php?p=studentsearch&classId=" + id;
    }
}

function filter(phrase, _id) {
    var words = phrase.value.toLowerCase().split(" ");
    var table = document.getElementById(_id);
    var ele;
    for (var r = 1; r < table.rows.length; r++) {
        ele = table.rows[r].innerHTML.replace(/<[^>]+>/g, "");
        var displayStyle = 'none';
        for (var i = 0; i < words.length; i++) {
            if (ele.toLowerCase().indexOf(words[i]) >= 0)
                displayStyle = '';
            else {
                displayStyle = 'none';
                break;
            }
        }
        table.rows[r].style.display = displayStyle;
    }
}