<h1>Beoordelingen klas <?php //klasnaam                                                                                                   ?></h1>  

<div class="ribbon">       
    <?php if ($isBeoordeeld === false && isset($_SESSION['docentId'])): ?>
        <div class="item" onclick="javascript:location.href = 'index.php?p=beoordeling';
                    $('#results').submit();">   
            <div class="fontIcon">
                &#xe060;
            </div>  
            <div class="text">
                Opslaan
            </div>
        </div>
    <?php endif; ?>
    <div class="item" onclick="javascript:location.href = 'index.php?p=beoordeling'">
        <div class="fontIcon">
            &#xe0f9;
        </div>  
        <div class="text">
            Annuleren
        </div>
    </div>
</div>  


<?php
if (isset($_SESSION['docentId'])) {
    echo 'docentId=' . $_SESSION['docentId'];
    ?>


    <table cellpadding="0" cellspacing="0">
        <thead>
        <th>Nummer</th>     
        <th>Naam</th> 
        <?php
        $rubricCount = 0;
        foreach ($rubrieken as $rubriek) {
            $rubricCount++;
            if ($isBeoordeeld === false) {
                echo "<th title='" . $rubriek['naam'] . "' style='text-align: center;'>Nr " . $rubricCount . "</th>";
            } else if ((isset($totaalBeoordelingen[$student['klas_student_id']][$rubricCount - 1]['waardering']))) {
                echo "<th title='" . $rubriek['naam'] . "' style='text-align: center;'>Nr " . $rubricCount . "</th>";
            }
        }
        ?>
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

                    $bgcolor = "";
                    foreach ($rubriekenDocent as $rubriekDocent) {
                        if (in_array($rubriekId, $rubriekDocent)) {
                            if ($unEven) {
                                $bgcolor = 'bgcolor="#33CC00"';
                            } else
                                $bgcolor = 'bgcolor="#33FF00"';
                        }
                    }



                    echo '<td ' . $bgcolor . ' >';
                    echo '<select name=' . "score[$studentId][$rubriekId]" . '>';
                    foreach ($waarderingen as $waardering) {
                        echo '<option value=' . $waardering['id'] . '>' . $waardering['waardering'] . '</option>';
                    }
                    echo '</select>
                </td>';
                } else {
                    if (isset($totaalBeoordelingen[$student['klas_student_id']][$rubricCount]['waardering']))
                        echo '<td style="text-align: center;">' . $totaalBeoordelingen[$student['klas_student_id']][$rubricCount]['waardering'] . '</td>';
                }
            }
            $unEven = !$unEven;
        }
        echo '</tr>';
        ?>
    </form>

    </tbody>
    </table>

    <?php
} else {
    echo '<h1>U bent geen docent!</h1>';
}
?>