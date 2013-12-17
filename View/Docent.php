<h1>Docent</h1>          
<div class="ribbon">     
    <div class="item" onclick="javascript:location.href = 'index.php'">
        <div class="fontIcon">
            &#xe126;
        </div>  
        <div class="text">
            Terug
        </div>
    </div> 
    <div class="item" onclick="javascript:location.href = 'index.php?p=docentedit'">
        <div class="fontIcon">
            &#xe102;
        </div>  
        <div class="text">
            Toevoegen
        </div>
    </div>
    <div class="item" onclick="javascript:location.href = 'index.php?p=docentedit&id=' + getSelectedItemId()">
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
    <th>Voornaam</th>     
    <th>Tussenvoegsel</th>   
    <th>Achternaam</th>
    <th>Email</th>
</thead>    
<tbody>
    <?php
    $unEven = true;
    foreach ($docenten as $docent) {
        if ($unEven) {
            $trClass = 'class="unEven"';
        } else {
            $trClass = null;
        }
        echo '<tr ' . $trClass . ' id=' . $docent['id'] . '>';
        echo '<td>' . $docent['voornaam'] . '</td>';
        echo '<td>' . $docent['tussenvoegsel'] . '</td>';
        echo '<td>' . $docent['achternaam'] . '</td>';
        echo '<td>' . $docent['mail'] . '</td>';
        echo '</tr>';
        $unEven = !$unEven;
    }
    ?>    
</tbody>
</table>
</div>
