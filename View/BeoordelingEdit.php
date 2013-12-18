<h1>Beoordelingen klas <?php //klasnaam                                                                      ?></h1>  

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
    $unEven = true;
    foreach ($studenten as $student) {
        if ($unEven) {
            $trClass = 'class="unEven"';
        } else {
            $trClass = null;
        }

        echo '<input type="hidden" name="classId" value=' . $_GET['id'] . '/>';
        $studentId = $student['id'];
        $student_name = $student['voornaam'];
        if (isset($student['tussenvoegsel'])) {
            $student_name .= ' ' . $student['tussenvoegsel'];
        }
        $student_name .= ' ' . $student['achternaam'];

        echo '<tr ' . $trClass . ' id=' . $studentId . '>';
        echo '<td>' . $studentId . '</td>';

        echo '<td>' . $student_name . '</td>';

        $rubricCount = -1;
        foreach ($rubrieken as $rubriek) {
            $rubricCount++;
            if ($isBeoordeeld === false) {
                $rubriekId = $rubriek['id'];

                echo '<td>';
                echo '<select name=' . "score[$studentId][$rubriekId]" . '>';
                foreach ($waarderingen as $waardering) {
                    echo '<option value=' . $waardering['id'] . '>' . $waardering['waardering'] . '</option>';
                }
                echo '</select>
                </td>';
            } else {
                echo '<td>' . $totaalBeoordelingen[$student['klas_student_id']][$rubricCount]['waardering'] . '</td>';
            }
        }
        $unEven = !$unEven;
    }
    echo '</tr>';
    ?>
</form>

</tbody>
</table>
