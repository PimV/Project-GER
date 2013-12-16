<?php        
    include_once("Model/Groepen.php");
    $groups = new Groepen;
    $groupList = $groups->getAllGroups();
?>

<h1>Rollen</h1>          
<div class="ribbon">     
    <div class="item" onclick="javascript:location.href='index.php?p=home'">
        <div class="fontIcon">
             &#xe126;
        </div>  
        <div class="text">
            Terug
        </div>
    </div> 
    <div class="item" onclick="javascript:location.href='index.php?p=groepedit&mode=add'">
        <div class="fontIcon">
            &#xe102;
        </div>  
        <div class="text">
            Toevoegen
        </div>
    </div>
    <div class="item">
        <div class="fontIcon" onclick="javascript:location.href='index.php?p=groepedit&id='+getSelectedItemId() ">
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
        <th>Naam</th>   
        <th>Docenten</th>
        <th>Rubrieken</th>
    </thead>    
    <tbody>
        <?php
        
        $even = true;
        foreach ($groupList as $value){
            echo "<tr id=" . $value['id'];
            
            if($even === true){
                $even = false;      
                echo " class='unEven'>";
            }
            else{
                $even = true;    
                echo ">";            
            }
            echo "<td>" . $value['naam'] . "</td>";
            echo "<td>" . $value['docenten'] . "</td>";
            echo "<td>" . $value['rubrieken'] . "</td>";
            echo "</tr>";
        }
        
        ?>
    </tbody>
</table>
