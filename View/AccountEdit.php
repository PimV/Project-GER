<script src="JavaScript/DocentEdit.js"></script>
<script src="JavaScript/AccountValidation.js"></script>
<?php
if (empty($_GET["id"])) {
    echo("<h1>Account toevoegen</h1>");
} else {
    echo("<h1>Account '" . $_GET['id'] . "' bewerken</h1>");
}

if (isset($_SESSION['editError'])) {
    echo '<script>showError("' . $_SESSION['editError'] . '");</script>';
}
unset($_SESSION['editError']);
?>          
<div class="ribbon">     
    <div class="item" onclick="
            if (validateAccountData() === true <?php
if ($bestaatAl) {
    echo ')';
} else {
    echo '&& allFieldsEntered() === true)';
}
?> {
                addTranserListsToForm('form', 'rollen');
                addTranserListsToForm('form', 'rubrieken');
                $('#form').submit();
            }
         ">
        <div class="fontIcon">
            &#xe060;
        </div>  
        <div class="text">
            Opslaan
        </div>
    </div>
    <div class="item" onclick="javascript:location.href = 'index.php?p=account'">
        <div class="fontIcon">
            &#xe0f9;
        </div>  
        <div class="text">
            Annuleren
        </div>
    </div>
</div>  
<form action="#" id="form" method="POST">
    <table class="noAction">
        <tr>
            <td>Gebruikersnaam</td>  
            <td><input id="minLength" name="username" value="<?php
    if (isset($account)) {
        echo $account['gebruikersnaam'];
    }
?>" type="text"/></td>
        </tr>
        <tr>
            <td>Nieuw wachtwoord</td>  
            <td><input <?php
                if ($bestaatAl) {
                    echo ' required ';
                }
?> class="password"  name="newPass1"type="password"/></td>

        </tr>
        <tr>
            <td>Herhaal nieuw wachtwoord</td>  
            <td><input <?php
                if ($bestaatAl) {
                    echo ' required ';
                }
?> class="password"  name="newPass2" type="password"/></td>
        </tr>
        <tr>
            <td>Rechten niveau</td>  
            <td>
                <select style="
                        -ms-border-radius: 5px; border-radius: 5px;
                        width: 210px; 
                        height: 35px; 
                        padding: 3px;" 
                        class="dropDownBox" 
                        name="level">';
<?php
foreach ($levels as $level) {
    if (isset($account)) {
        if ($level['id'] == $account['level_id']) {
            echo '<option selected value=' . $level['id'] . '>' . $level['rol'] . '</option>';
        } else {
            echo '<option value=' . $level['id'] . '>' . $level['rol'] . '</option>';
        }
    } else {
        echo '<option value=' . $level['id'] . '>' . $level['rol'] . '</option>';
    }
}
echo '</select></td>';
?>
        </tr>
        <tr>
            <td>Geactiveerd</td>
            <td><input type="checkbox" name="activated" value="true" <?php
                            if (isset($account)) {
                                if ($account['disabled'] === 0) {
                                    echo 'checked';
                                }
                            }
?>></td>
        </tr>
    </table> 
</div>

<div class="right">
</div>
</form>
</div>
</div>