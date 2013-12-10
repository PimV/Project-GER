<!DOCTYPE html>
<html>
    <head>
        <!-- Libraries -->
        <script src="Libraries/jQuery/jquery-1.10.2.min.js"></script>
        <script src="JavaScript/Template.js"></script>
        
        <!-- Head overrides & additions -->
        <?php if (isset($pagehead)){include_once($pagehead);} ?>
        
        <!-- Default head -->
        <title>GER</title>
        <meta charset="ISO-8859-1"/>
        <meta name="description" content="GER (Green Engineering Rubrics) beoordeling systeem"/>
        <meta name="keywords" content="GER, student, beoordeling"/>
        <link rel="stylesheet" type="text/css" href="Styles/TemplateStyle.css"/>
        <link rel="icon" href="favicon.ico"/>
        
    </head>
    <body>
        <div id="tmpHeader">
            <div class="headerMenu">
                <ul>
                    <li><div class="icon fontIcon" onclick="javascript:location.href='index.php?p=home'">&#xe001;</div><div class="text">Home</div></li>
                    <li><div class="icon fontIcon">&#xe104;</div><div class="text">Logout</div></li>
                </ul>
            </div>
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
