

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
    <div class="item" onclick="javascript:location.href='index.php?p=groepedit&id='+getSelectedItemId() ">
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
		
<div class="coverBg" id="cover">
    <div class="cover">
        <div class="header">
            <div class="closeButton fontIcon" onclick="closeCover('cover')"></div>
        </div>
        <div class="contentMessage">
            <h2>Weet u zeker dat u deze rol wilt verwijderen?</h2>
            <br><br><br><br><br><br><br><br>
            <input style="height: 40px; width: 180px;" type="button" value="Rol verwijderen" onclick="javascript:location.href='index.php?p=groep&del='+getSelectedItemId();"/>
            &nbsp;&nbsp;&nbsp;
            <input style="height: 40px; width: 100px;" type="button" value="Annuleren" onclick="closeCover('cover')"/>
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
