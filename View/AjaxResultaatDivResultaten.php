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
            $i = 1;
            foreach($result as $row){
                if($row["docent"] == $teacher){
                    echo "<th title='". $row["rubriek"] ."' style='text-align: center;'>Nr. ". $i  ."</th>";
                    $i++;
                } 
            }

            echo "</thead>";
            echo "<tbody><tr class='unEven'>";
        
            //Laat de gemiddelde punten zien
            echo "<tr height='50px' class='noHover'>";
            echo "<td><b><i>Gemiddelde</i></b></td>"; 
            
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
                    echo "<td style='background: $kleur; text-align: center;' title='Spreiding: ". $row["spreiding"] ."' ><i>". $row["gemiddelde"] ."</i></td>";     
                }
            }else{
                foreach($average as $row){
                    echo "<td style='text-align: center;'><b>". $row["gemiddelde"] ."</b></td>";     
                }
            }
            
            echo "</tr>"; 
            
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
                            foreach($this->waarderingen as $option){
                                if($option["waardering"] == $row["gemiddelde"]){
                                    echo "<option value='". $option["id"] ."' selected>". $option["waardering"] ."</option>";                                 
                                }else{
                                    echo "<option value='". $option["id"] ."'>". $option["waardering"] ."</option>";                                    
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

<canvas hidden="true" id="cvs1" width="700" height="500">[No canvas support]</canvas>
<canvas hidden="true" id="cvs2" width="700" height="500">[No canvas support]</canvas>