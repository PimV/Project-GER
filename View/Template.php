<!DOCTYPE html>
<html>
    <head>
        <!-- Libraries -->
        <script src="Libraries/jquery-1.10.2.min.js"></script>
        
        <!-- Head overrides & additions -->
        <?php if (isset($pagehead)){include_once($pagehead);} ?>
        
        <!-- Default head -->
        <title>GER</title>
        <meta charset="UTF-8"/>
        <meta name="description" content="GER (Green Engineering Rubrics) beoordeling systeem"/>
        <meta name="keywords" content="GER, student, beoordeling"/>
        <link rel="stylesheet" type="text/css" href="Styles/TemplateStyle.css"/>
        <link rel="icon" href="favicon.ico"/>
        
    </head>
    <body>
        <div id="tmpHeader">
            <?php
                include("header.php");
            ?>
        </div>
   
        <div id="tmpContent"> 
            <?php
            include($page);
            ?>
        </div>
                        
        <div id="tmpFooter">
            
        </div>
    </body>
</html>
