
<h1>Docent bewerken</h1>          
<div class="ribbon">     
    <div class="item" onclick="
            addTranserListsToForm('form', 'rollen');
            addTranserListsToForm('form', 'rubrieken');
            $('#form').submit();">
        <div class="fontIcon">
            &#xe060;
        </div>  
        <div class="text">
            Opslaan
        </div>
    </div>
    <div class="item">
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
                    <td>Voornaam</td>  
                    <td><input name="voornaam" type="text" value="<?php
                        if (isset($docent)) {
                            echo $docent->getFirstName();
                        }
                        ?>"/></td>
                </tr>     
                <tr>
                    <td>Tussenvoegsels</td>  
                    <td><input name="tussenvoegsel" type="text" value="<?php
                        if (isset($docent)) {
                            echo $docent->getInsert();
                        }
                        ?>"/></td>
                </tr>
                <tr>
                    <td>Achternaam</td>  
                    <td><input name="achternaam" type="text" value="<?php
                        if (isset($docent)) {
                            echo $docent->getLastName();
                        }
                        ?>"/></td>
                </tr>
            </table> 

            <h2>Rollen</h2>

            <ul id="rollen" class="listView" alt="left">
                <?php
                if (isset($docent)) {
                    foreach ($docent->getRollen() as $rol) {
                        echo '<li id="' . $rol['id'] . '" class="listItem">' . $rol['naam'] . '</li>';
                    }
                }
                ?>
            </ul>     

            <div class="listViewControl">
                <div name="Left" class="fontIcon">&#xe111;</div>    
                <div name="Right" class="fontIcon">&#xe112;</div>   
            </div>    

            <ul class="listView" alt="right">
                <?php
                foreach ($temp_rollen_not_assigned as $rol) {
                    echo '<li id="' . $rol['id'] . '" class="listItem">' . $rol['naam'] . '</li>';
                }
                ?>
            </ul>    
        </div>

        <div class="right">   
            <table class="noAction">
                <tr>
                    <td>E-mail</td>  
                    <td><input name="mail" type="text" value="<?php
                        if (isset($docent)) {
                            echo $docent->getMail();
                        }
                        ?>"/></td>
                </tr>     
                <tr>
                    <td>Wachtwoord</td>  
                    <td><input type="password"/></td>
                </tr>
                <tr>
                    <td>Herhaal wachtwoord</td>  
                    <td><input type="password"/></td>
                </tr>
            </table>       

            <h2>Rubrieken</h2>

            <ul id="rubrieken" class="listView" alt="left">
                <?php
                if (isset($docent)) {
                    foreach ($docent->getRubrics() as $rubriek) {
                        echo '<li id="' . $rubriek['id'] . '" class="listItem">' . $rubriek['naam'] . '</li>';
                    }
                }
                ?>

            </ul>     

            <div class="listViewControl">
                <div name="Left" class="fontIcon">&#xe111;</div>    
                <div name="Right" class="fontIcon">&#xe112;</div>      
            </div>    

            <ul class="listView" alt="right"><?php
                foreach ($temp_rubrieken_not_assigned as $rubriek) {
                    echo '<li id="' . $rubriek['id'] . '" class="listItem">' . $rubriek['naam'] . '</li>';
                }
                ?>
            </ul> 
        </div>
</form>
</div>
</div>