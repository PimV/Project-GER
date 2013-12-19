<h1>Waarderingen </h1>          
<div class="ribbon">     
    <div class="item" onclick="javascript:location.href = 'index.php?p=home'">
        <div class="fontIcon">
            &#xe126;
        </div>  
        <div class="text">
            Terug
        </div>
    </div> 
    <div class="item" onclick="javascript:location.href = 'index.php?p=waarderingedit'">
        <div class="fontIcon">
            &#xe102;
        </div>  
        <div class="text">
            Toevoegen
        </div>
    </div>
    <div class="item" onclick="javascript:location.href = 'index.php?p=waarderingedit&id=' + getSelectedItemId()">
        <div class="fontIcon">
            &#xe006;
        </div>  
        <div class="text">
            Bewerken
        </div>
    </div> 
    <!--    <div class="item" onclick="javascript:location.href = 'index.php?p=waardering&del=' + getSelectedItemId();">-->
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
    <th>Omschrijving</th>     
    <th>Cijfer</th>   
</thead>    
<tbody>
    <?php
    $unEven = true;
    foreach ($waarderingen as $waardering) {
        if ($unEven) {
            $trClass = 'class="unEven"';
        } else {
            $trClass = null;
        }
        echo '<tr ' . $trClass . ' id=' . $waardering['id'] . '>';
        echo '<td>' . $waardering['omschrijving'] . '</td>';
        echo '<td>' . $waardering['waardering'] . '</td>';
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
            <h2>Weet u zeker dat u deze waardering wilt verwijderen??</h2>
            <br><br><br><br><br><br><br><br>
            <input style="height: 40px; width: 180px;" type="button" value="Waardering verwijderen" onclick="javascript:location.href = 'index.php?p=waardering&del=' + getSelectedItemId();"/>
            &nbsp;&nbsp;&nbsp;
            <input style="height: 40px; width: 100px;" type="button" value="Annuleren" onclick="closeCover('cover')"/>
        </div>
    </div>
</div>
