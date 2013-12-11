<h1>Resultaat</h1>       
<div class="ribbon">  
    <div class="item" onclick="javascript:location.href='index.php?p=studentsearch'">
                <div class="fontIcon"> 
                     &#xe126;
                </div>  
                <div class="text">
                    Terug
                </div>
    </div>
    <div class="item" onclick="submitFormTotalRating()">
        <div class="fontIcon">
             &#xe060;
        </div>  
        <div class="text">
            Opslaan
        </div>
    </div>      
    <div class="item" onclick="javascript:window.open('index.php?p=export&c=resultaat', '_newtab')">
        <div class="fontIcon">
             &#xe1b2;
        </div>  
        <div class="text">
            Exporteren
        </div>
    </div>
</div>  

<div class="splitScreen">
    <div class="left">
        <table class="noAction">
            <tr>
                <td>Naam</td>  
                <td><input disabled="disabled" type="text" value="<?php echo $student[0]["voornaam"] . " " . $student[0]["tussenvoegsel"] . " " . $student[0]["achternaam"] ; ?>"/></td>
            </tr>  
            <tr>
                <td>Student nummer</td>  
                <td><input disabled="disabled" type="text" value="<?php echo $student[0]["id"]; ?>"/></td>
            </tr>   
        </table>         
    </div>
</div> 

<br />
<!--Alleen huidige blok laten zien wanener de coach is ingelogd. Bij beheerder alles.-->
<!-- binnen de ajax ook de coach van dat blok laten zien!!!!!!!!!!!!!!-->
<table class="noAction" style="width: 94%; border: 1px solid black;">   
        <tr>
            <td>Klas</td>  
            <td>
                <select id="comboJaar" class="selectFullSize" onchange="reloadComboAjaxClass(<?php echo $studentId; ?>)" >
                    <?php
                    $i = 0;
                        foreach ($schooljaren as $row) {
                            $selected = "";
                            if(count($schooljaren) -1 == $i)
                            {
                                $selected = "selected";
                            }
                            echo("<option $selected value='".$row["leerjaar"]."'> Leerjaar ".$row["leerjaar"] ."</option>");
                            $i++;
                        }
                    ?>
                </select>
            </td>

            <td>Blok</td>         
            <td id="tdComboAjaxClass">
                
            </td>
        </tr> 
    </table>  

<br />

<div id="divTableAjaxResult">
    
</div>