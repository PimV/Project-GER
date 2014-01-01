<h1>Home</h1>       
<div class="beheerMenu">
    <?php if ($_SESSION["admin"]) { ?>
        <div class="menuRow">
            <div class="menuItem" onclick="javascript:location.href = 'index.php?p=docent'">
                <div class="fontIcon">&#xe075;</div>      
                <div class="text">Docenten</div>
            </div>
            <div class="menuItem" onclick="javascript:location.href = 'index.php?p=groep'">
                <div class="fontIcon">&#xe006;</div>      
                <div class="text">Rollen</div>
            </div>   
            <div class="menuItem" onclick="javascript:location.href = 'index.php?p=rubriek'">
                <div class="fontIcon">&#xe096;</div>      
                <div class="text">Rubrieken</div>
            </div>
            <div class="menuItem" onclick="javascript:location.href = 'index.php?p=waardering'">
                <div class="fontIcon">&#xe098;</div>      
                <div class="text">Waarderingen</div>
            </div>
        </div>  
    <?php } ?>

    <div class="menuRow">
        <?php if ($_SESSION["admin"]) { ?>
            <div class="menuItem" onclick="javascript:location.href = 'index.php?p=studentsearch'">
                <div class="fontIcon">&#xe070;</div>      
                <div class="text">Studenten</div>
            </div>       
            <div class="menuItem" onclick="javascript:location.href = 'index.php?p=klas'">
                <div class="fontIcon">&#xe071;</div>      
                <div class="text">Klassen</div>
            </div>
            <div class="menuItem" onclick="javascript:location.href = 'index.php?p=blok'">
                <div class="fontIcon">&#xe02d;</div>      
                <div class="text">Blokken</div>
            </div>
        <?php } ?>
        <!--TODO:-->
        <!--CHECK OF DE DOCENT VAN MINSTENS ÉÉN KLAS, ANDERS DEZE KNOP NIET EENS LATEN ZIEN BIJ EEN DOCENT!!!! DAN HEEFT DIE AAN BEOORDELING GENOEG-->
        <?php if (!$_SESSION["admin"]) { ?>
            <div class="menuItem" onclick="javascript:location.href = 'index.php?p=studentsearch'">
                <div class="fontIcon">&#xe095;</div>      
                <div class="text">Resultaten</div>
            </div>
        <?php } ?>
        <div class="menuItem" onclick="javascript:location.href = 'index.php?p=beoordeling'">
            <div class="fontIcon">&#xe023;</div>      
            <div class="text">Beoordelingen</div>
        </div>
    </div>     

    <div class="menuRow">
        <?php if ($_SESSION["admin"]) { ?>
            <div class="menuItem">
                <div class="fontIcon" onclick="javascript:location.href = 'index.php?p=profiel'">&#xe087;</div>      
                <div class="text">Profiel</div>
            </div>
            <div class="menuItem">
                <div class="fontIcon" onclick="javascript:location.href = 'index.php?p=account'">&#xe0c6;</div>      
                <div class="text">Accounts</div>
            </div>
        <?php } ?>
    </div>
</div>
