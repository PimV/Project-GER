<?php
if (isset($docent)) {
    
}
?>
<h1>Docent bewerken</h1>          
<div class="ribbon">     
    <div class="item">
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

<div class="splitScreen">
    <div class="left">
        <table class="noAction">
            <tr>
                <td>Voornaam</td>  
                <td><input type="text" value="<?php
                    if (isset($docent)) {
                        echo $docent->getFirstName();
                    }
                    ?>"/></td>
            </tr>     
            <tr>
                <td>Tussenvoegsels</td>  
                <td><input type="text" value="<?php
                    if (isset($docent)) {
                        echo $docent->getInsert();
                    }
                    ?>"/></td>
            </tr>
            <tr>
                <td>Achternaam</td>  
                <td><input type="text" value="<?php
                    if (isset($docent)) {
                        echo $docent->getLastName();
                    }
                    ?>"/></td>
            </tr>
        </table> 

        <h2>Rollen</h2>

        <ul class="listView">
            <?php
            if (isset($docent)) {
                foreach ($docent->getRollen() as $rol) {
                    echo '<li class="listItem">' . $rol['naam'] . '</li>';
                }
            }
            ?>
        </ul>     

        <div class="listViewControl">
            <div class="fontIcon">&#xe111;</div>    
            <div class="fontIcon">&#xe112;</div>   
        </div>    

        <ul class="listView">
            <li class="listItem">Engels</li>    
            <li class="listItem">Duits</li>
            <li class="listItem">Scheikunde</li>
            <li class="listItem">Natuurkunde</li>
            <li class="listItem">Wiskunde</li>
        </ul>    
    </div>

    <div class="right">   
        <table class="noAction">
            <tr>
                <td>E-mail</td>  
                <td><input type="text" value="<?php
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

        <ul class="listView">
            <?php
            if (isset($docent)) {
                foreach ($docent->getRubrics() as $rubriek) {
                    echo '<li class="listItem">' . $rubriek['naam'] . '</li>';
                }
            }
            ?>

        </ul>     

        <div class="listViewControl">
            <div class="fontIcon">&#xe111;</div>    
            <div class="fontIcon">&#xe112;</div>      
        </div>    

        <ul class="listView">
            <li class="listItem">Exact</li>        
            <li class="listItem">Kwaliteit en zorgvuldigheid</li>    
            <li class="listItem">Communicatie</li>    
            <li class="listItem">Sociale vaardigheden</li>    
            <li class="listItem">Plannen en organiseren</li>    
            <li class="listItem">Ondernemerschap</li>    
            <li class="listItem">Verantwoordelijkheid</li>    
            <li class="listItem">Zelfstandigheid</li>                  
            <li class="listItem">Transfervaardigheid</li>    
        </ul> 
    </div>
</div>
</div>