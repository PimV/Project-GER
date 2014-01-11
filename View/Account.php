<h1>Account</h1>          
<div class="ribbon">     
    <div class="item" onclick="javascript:location.href = 'index.php?p=home'">
        <div class="fontIcon">
            &#xe126;
        </div>  
        <div class="text">
            Terug
        </div>
    </div> 
    <div class="item" onclick="javascript:location.href = 'index.php?p=accountedit'">
        <div class="fontIcon">
            &#xe102;
        </div>  
        <div class="text">
            Toevoegen
        </div>
    </div>
    <div class="item" onclick="javascript:location.href = 'index.php?p=accountedit&id=' + getSelectedItemId()">
        <div class="fontIcon">
            &#xe006;
        </div>  
        <div class="text">
            Bewerken
        </div>
    </div> 
    <div class="item" onclick="deleteClicked(getSelectedItemId());">
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
    <th>Gebruikersnaam</th>     
    <th>Geactiveerd</th>   
</thead>    
<tbody>
    <?php
    $unEven = true;
    foreach ($accounts as $account) {
        if ($unEven) {
            $trClass = 'class="unEven"';
        } else {
            $trClass = null;
        }

        $geactiveerd = "Ja";
        if ($account['disabled'] === 1) {
            $geactiveerd = "Nee";
        }


        echo '<tr ' . $trClass . ' id=' . $account['gebruikersnaam'] . '>';
        echo '<td>' . $account['gebruikersnaam'] . '</td>';
        echo '<td>' . $geactiveerd . '</td>';
        echo '</tr>';
        $unEven = !$unEven;
    }
    ?>    
</tbody>
</table>
</div>

<div class="coverBg" id="cover">
    <div class="cover">
        <div class="header">
            <div class="closeButton fontIcon" onclick="closeCover('cover')"></div>
        </div>
        <div class="contentMessage">
            <h2>Weet u zeker dat u dit account wilt verwijderen?</h2>
            <br><br><br><br><br><br><br><br>
            <input style="height: 40px; width: 180px;" type="button" value="Docent verwijderen" onclick="javascript:location.href = 'index.php?p=account&del=' + getSelectedItemId();"/>
            &nbsp;&nbsp;&nbsp;
            <input style="height: 40px; width: 100px;" type="button" value="Annuleren" onclick="closeCover('cover')"/>
        </div>
    </div>
</div>
