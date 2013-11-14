<!DOCTYPE html>
<html>
    <head>
        <!-- Head overrides & additions -->
        <?php if (isset($pagehead)){include_once($pagehead);} ?>
        
        <!-- Default head -->
        <?php include_once 'Inc_DefaultHead.php'; ?>
        
    </head>
    <body>
        <?php
            //TODO: include header
        
            //Includes the content
            include($page);
            
            //TODO: include footer
        ?>
    </body>
</html>
