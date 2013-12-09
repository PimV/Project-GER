<h1>Studenten</h1>          
<div class="ribbon">     
    <div class="item" onclick="javascript:location.href='index.php?p=home'">
        <div class="fontIcon">
             &#xe126;
        </div>  
        <div class="text">
            Terug
        </div>
    </div> 
    <div class="item" onclick="javascript:location.href='index.php?p=studentedit'">
        <div class="fontIcon">
            &#xe102;
        </div>  
        <div class="text">
            Toevoegen
        </div>
    </div>
    <div class="item">
        <div class="fontIcon">
            &#xe006;
        </div>  
        <div class="text">
            Bewerken
        </div>
    </div> 
    <div class="item">
        <div class="fontIcon">
            &#xe0a8;
        </div>  
        <div class="text">
            Verwijderen
        </div>
    </div>
</div>
<table cellpadding="0" cellspacing="0">
    <thead>
        <th>Id</th>     
        <th>Voornaam</th>
        <th>Achternaam</th>
        <th>Tussenvoegsel</th>
        <th>Mail</th>   
    </thead>
    <tbody>
        <?php
            $unEven = true;
            foreach ($studenten as $row) {
                if($unEven){
                    echo("<tr class='unEven'>");
                }
                else {
                    echo("<tr>");
                }
                    echo("<td>".$row["id"]."</td>");
                    echo("<td>".$row["voornaam"]."</td>");
                    echo("<td>".$row["achternaam"]."</td>");
                    echo("<td>".$row["tussenvoegsel"]."</td>");
                    echo("<td>".$row["mail"]."</td>");
                echo("</tr>");
                $unEven = !$unEven;
            }
        ?>
    </tbody>
</table>
