
<h1>Beoordelingen</h1>  

<div class="ribbon">       
    <div class="item" onclick="javascript:location.href = 'index.php?p=home'">
        <div class="fontIcon">
            &#xe126;
        </div>  
        <div class="text">
            Terug
        </div>
    </div> 
    <div class="item" onclick="javascript:location.href = 'index.php?p=beoordelingedit&id=' + getSelectedItemId()">

        <div class="fontIcon">
            &#xe0b3;
        </div>  
        <div class="text" >
            Beoordelen
        </div>
    </div>
</div>  
<?php
if ($noClasses === false) {
    echo '<table cellpadding="0" cellspacing="0">
    <thead>
    <th>Klascode</th>     
    <th>Aantal studenten</th>   
</thead>    
<tbody>';
    $unEven = true;

    foreach ($klassen_view as $klas) {
        if ($unEven) {
            $trClass = 'class="unEven"';
        } else {
            $trClass = null;
        }
        echo '<tr ' . $trClass . ' id=' . $klas['id'] . '>';
        echo '<td>' . $klas['klascode'] . '</td>';
        echo '<td>' . $klas['studenten'] . '</td>';

        echo '</tr>';
        $unEven = !$unEven;
        echo '</tbody></table>';
    }
} else {
    echo '<br/>';
    echo '<h2>Geen klassen om te beoordelen.</h2>';
}
?>



