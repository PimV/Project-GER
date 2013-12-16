<select id="comboKlas" class="selectFullSize" onchange="reloadDivAjaxResults(<?php echo $studentId; ?>)" >
    <option> Alle klassen</option> 
    <?php
    $i = 0;
        foreach ($klassen as $row) {
            $selected = "";
            if(count($klassen) -1 == $i)
            {
                $selected = "selected";
            }
            echo("<option $selected value='".$row["id"]."'>".$row["klascode"]." - ".$row["naam"]."</option>");
            $i++;
        }
    ?>
</select>