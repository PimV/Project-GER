<script type="text/javascript">
    function run() {
        openCover('cover');
    }
</script>

<div class="coverBg" id="cover">
    <div class="cover">
        <div class="header">
            <div class="closeButton fontIcon" onclick="closeCover('cover')"></div>
        </div>
        <div class="contentMessage">
            <?php
                if ($_SESSION['loginError'] == null)
                {
                   echo' <form action = "#" method = "POST">
                    <table class = "noAction">
                    <tr>
                    <td>Gebruikersnaam</td>
                    <td><input type = "text" name = "forgetUsername"/></td>                  
                    <td></td>
                    <td><input type = "submit" value = "Zend mail"/></td>
                    </tr>
                    </table>
                    </form>';
                }
                else
                {
                    echo $_SESSION['loginError'];
                }
                ?>  
        </div>
    </div>
</div>

<?php
if (isset($_GET["l"]))
{
    session_unset();
    session_destroy();
    header("location:index.php");
}
else if (isset($_GET["e"]))
{
    echo '<script type="text/javascript">run();</script>';
}
else if (isset($_GET["f"]))
{
    $_SESSION['loginError'] = null;
    echo '<script type="text/javascript">run();</script>';
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
                    <a href="index.php?p=login&f=forget">Wachtwoord vergeten?</a>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Inloggen"/></td>
            </tr>
        </table>
    </form>
</div>