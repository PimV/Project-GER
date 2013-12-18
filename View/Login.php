<?php
if (isset($_GET["l"]))
{
    session_destroy();
}
else if(isset($_GET["e"]))
{
    
    // hier moet gezegd worden dat de cover geopent moet worden.
    openCover('cover');
}
?>

<div class="coverBg" id="cover">
    <div class="cover">
        <div class="header">
            <div class="closeButton fontIcon" onclick="closeCover('cover')"></div>
        </div>
        <div class="contentMessage">
            <?php
            echo $loginErrorMessage;
            ?>   
        </div>
    </div>
</div>


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
                    <a href="" >Wachtwoord vergeten?</a>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Inloggen"/></td>
            </tr>
        </table>
    </form>
</div>