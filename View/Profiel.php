<script type="text/javascript">

    function run() {
        openCover('profielcover');
    }
</script>
<script src="JavaScript/AccountValidation.js"></script>

<div class="coverBg" id="profielcover">
    <div class="cover">
        <div class="header">
            <div class="closeButton fontIcon" onclick="closeCover('profielcover')"></div>
        </div>
        <div class="contentMessage">
            <?php
            echo $_SESSION['profielError'];
            ?>   
        </div>
    </div>
</div>

<?php
if (isset($_GET["e"])) {
    echo '<script type="text/javascript">run();</script>';
}
?>

<h1>Account bewerken</h1>          
<div class="ribbon">
    <div class="item">
        <div class="fontIcon" onclick="$('#newPassRequest').submit();">
            &#xe060;
        </div>  
        <div class="text">
            Opslaan
        </div>
    </div>
    <div class="item">
        <div class="fontIcon" onclick="javascript:location.href = 'index.php?p=home'">
            &#xe0f9;
        </div>  
        <div class="text">
            Annuleren
        </div>
    </div>
</div>  

<form id="newPassRequest" action="#" method="POST">
    <div class="splitScreen">
        <div class="left">
            <table class="noAction">    
                <tr>
                    <td>Oud wachtwoord</td>  
                    <td><input type="password" name="oldPass"/></td>
                </tr> 
            </table>            
        </div>

        <div class="right">   
            <table class="noAction">     
                <tr>
                    <td>Nieuw wachtwoord</td>  
                    <td><input class="password" type="password" name="newPass"/></td>
                </tr>         
                <tr>
                    <td>Wachtwoord herhalen</td>  
                    <td><input class="password" type="password" name="newPassRepeat"/></td>
                </tr>   
            </table>     
        </div>
    </div>
</form>