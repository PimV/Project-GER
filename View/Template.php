<!DOCTYPE html>
<html>
    <head>
        <!-- Libraries -->
        <script src="Libraries/jQuery/jquery-1.10.2.min.js"></script>
        <script src="JavaScript/Template.js"></script>

        <!-- Head overrides & additions -->
        <?php
        if (isset($pagehead)) {
            include_once($pagehead);
        }
        ?>

        <!-- Default head -->
        <title>GER</title>
        <meta charset="ISO-8859-15"/>
        <meta name="description" content="GER (Green Engineering Rubrics) beoordeling systeem"/>
        <meta name="keywords" content="GER, student, beoordeling"/>
        <link rel="stylesheet" type="text/css" href="Styles/TemplateStyle.css"/>
        <link rel="icon" href="favicon.ico"/>

    </head>
    <body>
        <div id="wrapper" style="position: absolute;width: 100%; height: 100%;">
            <div id="tmpHeader">
                <?php if ($_SESSION["loggedin"])
    { ?>
                <div class="headerMenu">
                    <ul>
                        <li onclick="javascript:location.href = 'index.php?p=home'"><div class="icon fontIcon" >&#xe001;</div><div class="text">Home</div></li>
                        <li onclick="javascript:location.href = 'index.php?p=login&l=logoff'"><div class="icon fontIcon" >&#xe104;</div><div class="text">Logout</div>
                            </form</li>

                    </ul>
                </div>
                <?php } ?>
            </div>

            <div id="tmpContent"> 
                <?php
                include($page);
                ?>
            </div>

            <div id="tmpFooter">

            </div>
        </div>
    </body>
</html>
