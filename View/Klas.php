<div class="coverBg" onclick="closeCover('confirmationCover');" id="confirmationCover">
    <div class="cover">
        <div class="header">
            <div class="closeButton fontIcon" onclick="closeCover('confirmationCover');"></div>
        </div>
        <div class="contentMessage">
            <h2>Weet u zeker dat u deze klas wil verwijderen?</h2>
            <br/><br/><br/><br/>
            <input style="height: 40px; width: 180px;" type="button" value="Ja" onclick="javascript:location.href='index.php?p=klas&del='+getSelectedItemId();"/>
            <input style="height: 40px; width: 180px;" type="button" value="Nee" onclick="closeCover('confirmationCover');"/>
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
    <div class="item" onclick="deleteClass();">
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
        <th>Schooljaar</th>
        <th>Blok</th>
        <th>Coach</th>
        <th>Studenten</th>
        <th>beoordeling deadline</th>
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
                echo("<td>".$row["klascode"]."</td>");
                echo("<td>".$row["schooljaar"]."</td>");
                echo("<td>".$row["bloknummer"]." ".$row["naam"]."</td>");
                echo("<td>".$row["coach_id"]."</td>");
                echo("<td>".$row["studenten"]."</td>");
                echo("<td>".$row["beoordeling_deadline_dmY"]."</td>");
                echo("</tr>");
                $unEven = !$unEven;
            }
        ?>
    </tbody>
</table>
