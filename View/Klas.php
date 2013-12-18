<div class="coverBg" id="cover">
    <div class="cover">
        <div class="header">
            <div class="closeButton fontIcon" onclick="closeCover('cover')"></div>
        </div>
        <div class="contentMessage">
            Weet u zeker dat u deze klas wil verwijderen?<br/>
            <input type="button" value="Ja" onclick="javascript:location.href='index.php?p=klas&del='+getSelectedItemId();"/><input type="button" value="Nee" onclick="closeCover('cover')"/>
        </div>
    </div>
</div>

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
    <div class="item" onclick="getSelectedItemId();openCover('cover');">
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
                    echo("<td>".$row["klascode"]." - blok ".$row["bloknummer"]." ".$row["naam"]."</td>");
                    echo("<td>".$row["studenten"]."</td>");
                echo("</tr>");
                $unEven = !$unEven;
            }
        ?>
    </tbody>
</table>