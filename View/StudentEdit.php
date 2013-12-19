<h1>Student bewerken</h1>          
<div class="ribbon">     
    <div class="item" onclick="$('#form').submit();">
        <div class="fontIcon">
             &#xe060;
        </div>  
        <div class="text">
            Opslaan
        </div>
    </div>
    <div class="item" onclick="javascript:location.href='index.php?p=studentsearch'">
        <div class="fontIcon">
            &#xe0f9;
        </div>  
        <div class="text">
            Annuleren
        </div>
    </div>    
</div>  

<form id="form" action="#" method="POST">
    <div class="splitScreen">
        <div class="left">
            <table class="noAction">
                <tr>
                    <td>Voornaam</td>  
                    <td><input name="voornaam" type="text" value="<?php echo($voornaam) ?>"/></td>
                </tr>        
                <tr>
                    <td>Achternaam</td>  
                    <td> <input name="achternaam" type="text" value="<?php echo($achternaam) ?>"/></td>
                </tr> 
            </table>                  
        </div>

        <div class="right">   
            <table class="noAction">
                <tr>
                    <td>Tussenvoegsel</td>  
                    <td><input name="tussenvoegsel" type="text" value="<?php echo($tussenvoegsel) ?>"/></td>
                </tr>        
                <tr>
                    <td>Mail</td>  
                    <td> <input name="mail" type="text" value="<?php echo($mail) ?>"/></td>
                </tr> 
            </table>     
        </div>
    </div>
</form>


