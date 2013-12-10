<h1>Klassen</h1>          
<div class="ribbon">     
    <div class="item" onclick="javascript:location.href='index.php?p=home'">
        <div class="fontIcon">
             &#xe126;
        </div>  
        <div class="text">
            Terug
        </div>
    </div> 
    <div class="item" onclick="javascript:location.href='index.php?p=klasedit'">
        <div class="fontIcon">
            &#xe102;
        </div>  
        <div class="text">
            Toevoegen
        </div>
    </div>
    <div class="item" onclick="javascript:location.href='index.php?p=klasedit&id='+getSelectedItemId();">
        <div class="fontIcon">
            &#xe006;
        </div>  
        <div class="text">
            Bewerken
        </div>
    </div> 
    <div class="item" onclick="javascript:location.href='index.php?p=klas&del='+getSelectedItemId();">
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
        <th>Klas code</th>     
        <th>Studenten</th>   
    </thead>
    <tbody>
        <?php
            $unEven = true;
            foreach ($klassen as $row) {
                if($unEven){
                    echo("<tr id='".$row["id"]."' class='unEven'>");
                }
                else {
                    echo("<tr id='".$row["id"]."'>");
                }
                    echo("<td>".$row["klascode"]." - ".$row["naam"]."</td>");
                    echo("<td>".$row["studenten"]."</td>");
                echo("</tr>");
                $unEven = !$unEven;
            }
        ?>
    </tbody>
</table>