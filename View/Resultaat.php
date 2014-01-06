<h1>Resultaat</h1>       
<div class="ribbon">  
    <div class="item" onclick="javascript:location.href='index.php?p=studentsearch&classId=' + <?php echo $_GET['c']; ?>">
                <div class="fontIcon"> 
                     &#xe126;
                </div>  
                <div class="text">
                    Terug
                </div>
    </div>
    <div class="item" onclick="saveButtonClicked()">
        <div class="fontIcon">
             &#xe060;
        </div>  
        <div class="text">
            Opslaan
        </div>
    </div>      
    <div class="item" onclick="exportClicked()">
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
                <td><input disabled="disabled" type="text" value="<?php echo $student->getVoornaam() . " " .  $student->getTussenvoegsel() . " " . $student->getAchternaam();?>"/></td>

            </tr>  
            <tr>
                <td>Student nummer</td>  
                <td><input disabled="disabled" type="text" value="<?php echo $student->getStudentId(); ?>"/></td>
            </tr>   
        </table>         
    </div>
</div> 

<br />


<!--TODO: Alleen huidige blok laten zien wanener de coach is ingelogd. Bij beheerder alles.-->
<!--TODO:  binnen de ajax ook de coach van dat blok laten zien!!!!!!!!!!!!!!-->
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

<div class="coverBg" id="cover">
    <div class="cover">
        <div class="header">
            <div class="closeButton fontIcon" onclick="closeCover('cover')"></div>
        </div>
        <div class="contentMessage">
            <h2>Weet u zeker dat u de eindbeoordeling definitief wilt opslaan?</h2>
            <p> De opgeslagen eindbeoordeling kan later niet meer worden aangepast.</p>
            <br><br><br><br><br><br><br>
            <input style="height: 40px; width: 180px;" type="button" value="Beoordeling opslaan" onclick="submitFormTotalRating()"/>
            &nbsp;&nbsp;&nbsp;
            <input style="height: 40px; width: 100px;" type="button" value="Annuleren" onclick="closeCover('cover')"/>
        </div>
    </div>
</div>