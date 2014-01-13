<?php
if(empty($_GET["id"])) {
    echo("<h1>Waardering toevoegen</h1>");
} else {
    echo("<h1>Waardering bewerken</h1>");
}
?>      
<div class="ribbon">     
    <div class="item" onclick="
            $('#form').submit();">
        <div class="fontIcon">
            &#xe060;
        </div>  
        <div class="text">
            Opslaan
        </div>
    </div>
    <div class="item" onclick="
			javascript:location.href='index.php?p=waardering'">
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
                    <td>Omschrijving</td>  
                    <td><input name="omschrijving" type="text" value="<?php
                        if (isset($waardering)) {
                            echo $waardering->getDescription();
                        }
                        ?>"/></td>
                </tr>     
            </table>
        </div>

        <div class="right">   
            <table class="noAction">
                <tr>
                    <td>Cijfer</td>  
                    <td><input name="cijfer" type="text" onkeypress="return isNumberKey(event)" value="<?php
                        if (isset($waardering)) {
                            echo $waardering->getRating();
                        }
                        ?>"/></td>
                </tr>     
            </table>
        </div>
</form>
</div>
</div>