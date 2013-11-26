<!DOCTYPE html>
<html>
    <head>
        <!-- Libraries -->
        <script src="<?php echo (globalsettings::getrootfolder()."Libraries/jquery-1.10.2.min.js")?>"></script>
        
        <!-- Head overrides & additions -->
        <?php if (isset($pagehead)){include_once($pagehead);} ?>
        
        <!-- Default head -->
        <title>GER</title>
        <meta charset="UTF-8"/>
        <meta name="description" content="GER (Green Engineering Rubrics) beoordeling systeem"/>
        <meta name="keywords" content="GER, student, beoordeling"/>
        <link rel="stylesheet" type="text/css" href="<?php echo(GlobalSettings::getRootFolder()) ?>Styles/TemplateStyle.css"/>
        <link rel="icon" href="<?php echo(GlobalSettings::getRootFolder()) ?>favicon.ico"/>
        
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
