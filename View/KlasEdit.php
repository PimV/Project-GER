<h1>Klas bewerken</h1>          
<div class="ribbon">     
    <div class="item" onclick="addTranserListsToForm('form', 'list1'); $('#form').submit();">
        <div class="fontIcon">
             &#xe060;
        </div>  
        <div class="text">
            Opslaan
        </div>
    </div>
    <div class="item" onclick="javascript:location.href='index.php?p=klas'">
        <div class="fontIcon">
            &#xe0f9;
        </div>  
        <div class="text">
            Annuleren
        </div>
    </div>    
</div>  

<form id="form" action="#" method="POST">
    <div class="splitScreen">
        <div class="left">
            <table class="noAction">
                <tr>
                    <td>Code</td>  
                    <td><input name="code" type="text" value="<?php echo($classCode) ?>"/></td>
                </tr>        
                <tr>
                    <td>Schooljaar</td>  
                    <td>
                        <select name="schoolyear" class="selectFullSize">
                            <?php
                            foreach ($yearChoices as $year) {
                                $selected = "";
                                if($year == $schoolYear) {
                                    $selected = "selected";
                                }
                                echo("<option $selected value='$year'>$year</option>");
                            }
                            ?>
                        </select>    
                    </td>
                </tr> 
            </table>                  
        </div>

        <div class="right">   
            <table class="noAction">    
                <tr>
                    <td>Coach</td>  
                    <td>
                        <select name="coach" class="selectFullSize"> 
                            <option></option>
                            <?php
                            foreach ($docenten as $docent) {
                                $selected = "";
                                if($docent["id"] === $coachID) {
                                    $selected = "selected";
                                }
                                echo("<option $selected value='".$docent["id"]."'>".$docent["voornaam"] . " " . $docent["tussenvoegsel"] . " " . $docent["achternaam"] ."</option>");
                            }
                            ?>
                        </select>    
                    </td>
                </tr>          
                <tr>
                    <?php if(empty($classID)) { ?>
                    <td>Blok</td>  
                    <td>
                        <select name="block" class="selectFullSize">
                            <?php
                            foreach ($blokken as $row) {
                                $selected = "";
                                if($row["id"] == $blockID){
                                    $selected = "selected";
                                }
                                echo("<option $selected value='".$row["id"]."'>".$row["bloknummer"]." - ".$row["naam"]."</option>");
                            }
                            ?>
                        </select>    
                    </td>
                    <?php } ?>
                </tr>
            </table>     
        </div>
    </div>
</form>

<div style="clear: both">          
    <h2>Studenten</h2>

    <div alt="listItem">
        <ul class="listView" id="list1" alt="left">
            <?php
            foreach ($students as $row) {
                echo("<li id='".$row["studentid"]."' class='listItem'>".$row["studentid"]. " | " .$row["studentnaam"]."</li>");
            }
            ?>
        </ul>     

        <div class="listViewControl">
            <div name="Left" class="fontIcon">&#xe111;</div>    
            <div name="Right" class="fontIcon">&#xe112;</div>      
        </div>    

        <ul class="listView" alt="right"> 
            <?php
            foreach ($classLessStudents as $row) {
                echo("<li id='".$row["studentid"]."' class='listItem'>".$row["studentid"]. " | " .$row["studentnaam"]."</li>");
            }
            ?>
        </ul> 
    </div>
</div>