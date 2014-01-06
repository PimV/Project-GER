<?php
if(isset($_GET['id'])){
    echo "<h1>Rol " . $groupList['0']['naam'] . " bewerken</h1>";  
}
else{
    echo '<h1>Rol toevoegen</h1>';
}
?>
<div class="ribbon">     
    <div class="item">
        <div class="fontIcon" onclick="
                addTranserListsToForm('form', 'rubrieken');
                $('#form').submit();
            ">
             &#xe060;
        </div>  
        <div class="text">
            Opslaan
        </div>
    </div>
    <div class="item" onclick="javascript:location.href='index.php?p=groep'">
        <div class="fontIcon">
            &#xe0f9;
        </div>  
        <div class="text">
            Annuleren
        </div>
    </div>
</div>  

<form action="#" id="form" method="POST">
    <div class="splitScreen">
        <div class="left">
            <table class="noAction">
                <tr>
                    <td>Naam</td>  
                    <td><input name="naam" type="text" value="<?php if(isset($groupList))
                        { 
                            echo $groupList['0']['naam'];                                
                        }?>"/>
                    </td>
                </tr>     
            </table>              

            <h2>Rubrieken</h2>

            <div alt="listItem">
                <ul id="rubrieken" class="listView" alt="left"><?php if(isset($leftRubricList))
                        { 
                            foreach ($leftRubricList AS $value){
                                echo "<li class='listItem' id=" . $value["id"] . ">" . $value["naam"] . "</li>";  
                            }
                        }
                    ?>
                </ul>     

                <div class="listViewControl">
                    <div name="Left" class="fontIcon">&#xe111;</div>    
                    <div name="Right" class="fontIcon">&#xe112;</div>      
                </div>    

                <ul class="listView" alt="right"><?php
                    foreach ($rigtRubricList AS $value){
                        echo "<li class='listItem' id=" . $value["id"] . ">" . $value["naam"] . "</li>";  
                    }                
                    ?>  
                </ul> 
            </div>
        </div>

        <div class="right">   
            <table class="noAction">
                <tr>
                    <td>Omschrijving</td>  
                    <td><input name="omschrijving" type="text"  value="<?php if(isset($groupList))
                            { 
                            echo $groupList['0']['omschrijving'];                        
                            } ?>"/>
                    </td>
                </tr>     
            </table>     
        </div>
    </div>
</form>