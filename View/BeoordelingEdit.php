<h1>Beoordelingen klas <?php //klasnaam                                     ?></h1>  

<div class="ribbon">       
    <div class="item" onclick="javascript:location.href = 'index.php?p=beoordeling';
            $('#results').submit();">   
        <div class="fontIcon">
            &#xe060;
        </div>  
        <div class="text">
            Opslaan
        </div>
    </div>
    <div class="item" onclick="javascript:location.href = 'index.php?p=beoordeling'">
        <div class="fontIcon">
            &#xe0f9;
        </div>  
        <div class="text">
            Annuleren
        </div>
    </div>
</div>  

<table cellpadding="0" cellspacing="0">
    <thead>
    <th>Nummer</th>     
    <th>Naam</th>   
    <th>Nr 1</th>
    <th>Nr 2</th>
    <th>Nr 3</th>
    <th>Nr 4</th>
    <th>Nr 5</th>
    <th>Nr 6</th>
    <th>Nr 7</th>   
    <th>Nr 8</th>
    <th>Nr 9</th>     
    <th>Nr 10</th>
    <th>Nr 11</th>   
    <th>Nr 12</th>
</thead>    
<tbody>

<form id="results" action="index.php?p=beoordeling" name="saveBoxes" method="POST">

    <?php
    foreach ($studenten as $student) {
        echo '<input type="hidden" name="classId" value=' . $_GET['id'] . '/>';
        $student_id = $student['id'];
        $student_name = $student['voornaam'];
        if (isset($student['tussenvoegsel'])) {
            $student_name .= ' ' . $student['tussenvoegsel'];
        }
        $student_name .= ' ' . $student['achternaam'];

        echo '<tr class=' . $student_id . '>';
        echo '<td>' . $student_id . '</td>';

        echo '<td>' . $student_name . '</td>';

        foreach ($rubrieken as $rubriek) {
            $rubriek_id = $rubriek['id'];
            echo '<td>
                   <select name=' . "score[$student_id][$rubriek_id]" . '>
                        <option>0</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </td>';
        }
        echo '</tr>';
    }
    ?>
</form>

</tbody>
</table>
