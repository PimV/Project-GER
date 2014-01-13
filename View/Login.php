<script type="text/javascript">
    function run() {
        openCover('cover');
    }
</script>


<div class="coverBg" id="errorCover">
    <div class="cover">
        <div class="header">
            <div class="closeButton fontIcon" onclick="closeCover('errorCover')"></div>
        </div>
        <div class="contentMessage">
            <?php
            if (isset($_SESSION['loginError'])) {
                echo $_SESSION['loginError'];
            } else {
                echo 'Er ging iets mis, probeer het opnieuw!';
            }
            ?>
        </div>
    </div>
</div>

<div class="coverBg" id="forget">
    <div class="cover">
        <div class="header">
            <div class="closeButton fontIcon" onclick="closeCover('forget')"></div>
        </div>
        <div class="contentMessage">
            <form action = "#" method = "POST">
                <table class = "noAction">
                    <tr>
                        <td>Gebruikersnaam</td>
                        <td><input type = "text" name = "forgetUsername"/></td>
                        <td></td>
                        <td><input type = "submit" value = "Zend mail"/></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_GET["l"])) {
    session_unset();
    session_destroy();
    header("location:index.php");
} else if (isset($_GET["e"])) {
    echo '<script>openCover("errorCover");</script>';
} else if (isset($_GET["f"])) {
    echo '<script>openCover("forget");</script>';
}
?>






<h1>Login</h1>        
<div class="centerDiv">
    <form action="#" method="POST">
        <table class="noAction">
            <tr>
                <td>Naam</td>  
                <td><input type="text" name="username"/></td>
            </tr>    
            <tr>
                <td>Wachtwoord</td>
                <td><input type="password" name="password" /></td>
            </tr> 
            <tr>
                <td colspan="2">
                    <a onclick="openCover('forget');
                            return false;" href="index.php?p=login&f=forget">Wachtwoord vergeten?</a>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Inloggen"/></td>
            </tr>
        </table>
    </form>
</div>


