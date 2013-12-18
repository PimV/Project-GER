    <?php
        //Indien er geen resultaten zijn om te laten zien, geef een simpele melding
        if(empty($result)){
            echo "<table cellpadding='0' cellspacing='0' style='width: 94%;' ><tr class='noHover'><td><b>Er zijn geen resultaten.</b></td></tr></table>";
        }
        //Indien er resultaten zijn, laat deze zien met daarbij het gemiddelde en de eindbeoordeling
        else{
            
            echo "<form id='formFinalResults' action='#' method='POST'>";
            if($this->type == "klas"){
                echo "<input hidden='true' type='text' name='k' value='".$average[0]["klas_student_id"]."'/>"; 
            }
            
            echo "<table cellpadding='0' cellspacing='0' style='width: 94%;'>";
            
            //Maak de table headers aan
            echo "<thead>";
            echo "<th>Docent</th>";
            
            //Stel voor de foreach loopS in met welke leraar het begint
            $teacher = $result[0]["docent"];

            //Loop door alle rijen van de eerste leraar heen zodat je alle rubrieken waarop beoordeelt is als head kan instellen
            foreach($result as $row){
                if($row["docent"] == $teacher){
                    echo "<th title='". $row["rubriek"] ."' style='text-align: center;'>Nr. ". $row["rubriek_id"]  ."</th>";
                } 
            }

            echo "</thead>";
            echo "<tbody><tr class='unEven'>";

            //Loop door alle records en maak per docent een nieuwe row aan
            $number = 1;
            $unEven = false;
            foreach($result as $row){

                if($row["docent"] != $teacher)
                {
                    $number = 1;
                    $teacher = $row["docent"];
                    if($unEven){
                        echo "</tr><tr class='unEven'>";
                    }else{
                        echo "</tr><tr>";
                    }
                }

                if($number == 1){
                    echo "<td>". $row["docent"] ."</td>";
                    echo "<td style='text-align: center;'>". $row["waardering"] ."</td>"; 
                }else{
                    echo "<td style='text-align: center;'>". $row["waardering"] ."</td>"; 
                }            
                $number++;
            }

            echo "</tr>";
        
        
            //Laat de gemiddelde punten zien
            echo "<tr height='50px' class='noHover'>";
            echo "<td>Gemiddelde</td>"; 
            
            if($this->type == "klas"){
                foreach($average as $row){
                    //Maak een kleur aan voor de spreiding
                    $spreiding = $row["spreiding"];
                    
                    if($spreiding == 0){
                        $kleur = "greenyellow";
                    } else if ($spreiding == 1){
                        $kleur = "greenyellow";
                    } else if ($spreiding == 2){
                        $kleur = "yellow";
                    } else if ($spreiding == 3){
                        $kleur = "orange";
                    } else {
                        $kleur = "red";
                    }
                    echo "<td style='background: $kleur; text-align: center;' title='Spreiding: ". $row["spreiding"] ."' >". $row["gemiddelde"] ."</td>";     
                }
            }else{
                foreach($average as $row){
                    echo "<td style='text-align: center;'><b>". $row["gemiddelde"] ."</b></td>";     
                }
            }
            
            echo "</tr>";        
        
            //Check of er een klas is geselecteerd. Indien er een leerjaar is geselecteerd bestaan er geen eindresultaten
            if($this->type == "klas"){
                echo "<tr height='60px' class='noHover'><td><b>Eindbeoordeling</b></td>";
                //Als de student al een eindbeoordeling heeft, laat deze zien in labels
                if($hasfinal){
                    foreach($finalresults as $row){
                        echo "<td style='text-align: center;'><b>". $row["waardering"] ."</b></td>";     
                    }
                }
                //Als de student nog geen eindbeorodeling heeft, laat deze zien in dropdowns zodat ze kunnen worden opgeslagen. De inhoud van de combo's is gelijk aan de average
                else{                   
                    foreach($average as $row){
                        echo "<td style='text-align: center;'><select name='s[".$row["rubriek_id"]."]'>";
                            foreach($waarderingen as $option){
                                if($option[1] == $row["gemiddelde"]){
                                    echo "<option value='$option[0]' selected>$option[1]</option>";                                 
                                }else{
                                    echo "<option value='$option[0]'>$option[1]</option>";                                    
                                }
                            }
                        echo "</select></td>";
                    }
                }
            }
        }
    ?>
        </tr>   
    </tbody>
</table>
<?php
    echo "</form>";
?>

<canvas id="cvs1" width="700" height="500">[No canvas support]</canvas>
<canvas id="cvs2" width="700" height="500">[No canvas support]</canvas>