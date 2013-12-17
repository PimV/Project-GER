<table cellpadding="0" cellspacing="0" style="width: 94%;">
    <?php
    
        if(empty($result)){
            echo "<tr><td><b>Er zijn geen resultaten.</b></td></tr>";
        }else{
    
            echo "<thead><th>Docent</th>";
            $teacher = $result[0]["docent"];

            foreach($result as $row){
                if($row["docent"] == $teacher){
                    echo "<th title='". $row["rubriek"] ."' style='text-align: center;'>Nr. ". $row["rubriek_id"]  ."</th>";
                } 
            }

            echo "</thead><tbody><tr class='unEven'>";

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
        
        
            //Laat de gemiddelde punten zien. //geef hier ook de spreiding aan
            echo "<tr height='50px' class='noHover'><td>Gemiddelde</td>";    
            if($type == "klas"){
                foreach($average as $row){
                    echo "<td style='text-align: center;' title='Spreiding: ". $row["spreiding"] ."' >". $row["gemiddelde"] ."</td>";     
                }
            }else{
                foreach($average as $row){
                    echo "<td style='text-align: center;'>". $row["gemiddelde"] ."</td>";     
                }
            }
            echo "</tr>";
        
        
        
            //Check of er een klas is geselecteerd. Indien er een leerjaar is geselecteerd bestaan er geen eindresultaten
            if($type == "klas"){
                echo "<tr height='50px' class='noHover'><td><b>Eindbeoordeling</b></td>";
                //Als de student al een eindbeoordeling heeft, laat deze zien in labels
                if($hasfinal){

                }
                //Als de student nog geen eindbeorodeling heeft, laat deze zien in dropdowns zodat ze kunnen worden opgeslagen. De inhoud van de combo's is gelijk aan de average
                else{

                }
            }
        }
    ?>
    </tr>   
    </tbody>
</table>

<br>

<!--Check of de ingelogde docent de coach is, en er nog geen eindoordeel vast gezet is, laat dan onderstaande tabel zien.
<table class="noAction" style="width: 94%; border: 1px solid black;">
    <thead>
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
    <tr>
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>      
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
        <td>
            <select>
                <option>0</option>       
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </td>
    </tr>  
</table>-->

<canvas hidden="true" id="cvs" width="700" height="500">[No canvas support]</canvas>