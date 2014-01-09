<!-- Op deze pagina moet rekening wordne gehouden wie er ingelogd is. Indien in COACH is ingelogd moeten bepaalde ribbon knoppen niet worden getoond.
     Ook moet dan het zoek gedeelte worden aangepast naar alleen een dropdown met de klassen en een student naam zoek balk. 
     
     Als het om een administrator gaat moet alles worden getoond.

     Een heleboel menu knoppen moeten ook disabled zijn als er nog geen student geselecteerd is.-->
<script src="JavaScript/StudentSearch.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<link href="Styles/datepicker.css" rel="stylesheet" type="text/css"/>






<div class="coverBg" id="coverDel">
    <div class="cover">
        <div class="header">
            <div class="closeButton fontIcon" onclick="closeCover('coverDel')"></div>
        </div>
        <div class="contentMessage">
            <h2>Weet u zeker dat u deze student wilt verwijderen?</h2>
            <br/><br/><br/><br/>
            <input type="button" value="Ja" onclick="javascript:location.href = 'index.php?p=studentsearch&del=' + getSelectedItemId();"/>
            <input type="button" value="Nee" onclick="closeCover('coverDel')"/>
        </div>
    </div>
</div>

<div class="coverBg" id="coverImport">
    <div class="cover">
        <div class="header">
            <div class="closeButton fontIcon" onclick="closeCover('coverImport')"></div>
        </div>
        <div class="contentMessage">
            <h2>Selecteer het bestand waarin de studenten staan.</h2>

            <br/><br/><br/><br/>
            <form action="index.php?p=import" method="POST" enctype="multipart/form-data" >
                <div><label for="file">Bestand: </label></div>
                <br/>
                <div>
                    <input onchange="beforeSubmit()" type="file" name="file" id="file" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, .csv"></input>
                    <input style="display: inline;" type="submit" name="submit" value="Importeren"></input>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="coverBg" id="importResult">
    <div class="cover">
        <div class="header">
            <div class="closeButton fontIcon" onclick="closeCover('importResult')"></div>
        </div>
        <div class="contentMessage">
            <h2>Resultaat van import: </h2>
            <br>
            <p>Het importeren is
                <?php
                if (isset($_SESSION['importSuccess'])) {
                    if ($_SESSION['importSuccess']) {
                        echo ' gelukt. U heeft ' . $_SESSION['importCount'] . ' student(en) toegevoegd.';
                    } else {
                        echo ' mislukt. <br> Mogelijke oorzaken zijn een corrupt of geen Excel-bestand.';
                    }
                }
                ?>

        </div>
    </div>
</div>


<h1>Studenten zoeken</h1>          
<div class="ribbon">     
    <div class="item" onclick="javascript:location.href = 'index.php?p=home'">
        <div class="fontIcon"> 
            &#xe126;
        </div>  
        <div class="text">
            Terug
        </div>
    </div>  
    <div class="item" onclick="javascript:location.href = 'index.php?p=resultaat&c=' + <?php echo $classId; ?> + '&id=' + getSelectedItemId()">
        <div class="fontIcon">
            &#xe095;
        </div>  
        <div class="text">
            Resultaten
        </div>
    </div>   

    <!-- Laat onderstaande knoppen alleen zien als een administrator is ingelogd -->
    <?php if ($_SESSION['admin']) { ?>
        <div class="item" onclick="javascript:location.href = 'index.php?p=studentedit&c=' + <?php echo $classId; ?>">
            <div class="fontIcon">
                &#xe102;
            </div>  
            <div class="text">
                Toevoegen
            </div>
        </div>
        <div class="item" onclick="javascript:location.href = 'index.php?p=studentedit&c=' + <?php echo $classId; ?> + '&id=' + getSelectedItemId();">
            <div class="fontIcon">
                &#xe006;
            </div>  
            <div class="text">
                Bewerken
            </div>
        </div> 
        <div class="item" onclick="getSelectedItemId();
                openCover('coverDel');">
            <div class="fontIcon">
                &#xe0a8;
            </div>  
            <div class="text">
                Verwijderen
            </div>
        </div>   
        <div class="item" onclick="openCover('coverImport');">
            <div class="fontIcon">
                &#xe0bd;
            </div>  
            <div class="text">
                Importeren
            </div>
        </div>
    <?php } ?>
</div>  

<!-- Laat onderstaande view elementen alleen zien als een administrator is ingelogd -->
<?php if ($_SESSION['admin']) { ?>
    <div class="splitScreen">
        <div class="left">
            <table class="noAction">   
                <tr>
                    <td>Zoekveld</td>  
                    <td><input id="filter" name="filt" onkeyup="filter(this, 'sf', 1)" type="text" placeholder="Typ hier om te zoeken."/></td>
                </tr>  
                <tr>
                    <td>Klas</td>
                    <td>
                        <select id="dropdownClass" class="selectFullSize" onchange="showId()">
                            <option> </option>
                            <?php
                            foreach ($klassen as $row) {
                                if (isset($_GET['classId'])) {
                                    if ($row["id"] == $_GET['classId']) {
                                        echo("<option selected='selected' value='" . $row["id"] . "'>" . $row["klascode"] . " - " . $row["naam"] . "</option>");
                                    } else {
                                        echo("<option value='" . $row["id"] . "'>" . $row["klascode"] . " - " . $row["naam"] . "</option>");
                                    }
                                } else {
                                    echo("<option value='" . $row["id"] . "'>" . $row["klascode"] . " - " . $row["naam"] . "</option>");
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr> 
            </table>            
        </div>
    </div>
<?php } ?>

<!-- Laat onderstaande view elementen alleen zien als een docent is ingelogd -->
<?php if (!$_SESSION['admin']) { ?>
    <div class="splitScreen">
        <div class="left">
            <table class="noAction">  
                <tr>
                    <td>Klas</td>
                    <td>
                        <select id="dropdownClass" class="selectFullSize" onchange="showId()">
                            <option> </option>
                            <?php
                            foreach ($klassen as $row) {

                                if (isset($_GET['classId'])) {

                                    if ($row["id"] == $_GET['classId']) {
                                        echo("<option selected='selected' value='" . $row["id"] . "'>" . $row["klascode"] . " - " . $row["naam"] . "</option>");
                                    } else {
                                        echo("<option value='" . $row["id"] . "'>" . $row["klascode"] . " - " . $row["naam"] . "</option>");
                                    }
                                } else {
                                    echo("<option value='" . $row["id"] . "'>" . $row["klascode"] . " - " . $row["naam"] . "</option>");
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>            
        </div>


        <table cellpadding="0" cellspacing="0">
            <thead>
            <th>Id</th>     
            <th>Voornaam</th>
            <th>Achternaam</th>
            <th>Tussenvoegsel</th>
            <th>Mail</th>   
            </thead>
            <tbody>

            </tbody>
        </table>
    <?php } ?>

    <table id="sf" cellpadding="0" cellspacing="0">
        <thead>
        <th>Id</th>     
        <th>Voornaam</th>
        <th>Tussenvoegsel</th>
        <th>Achternaam</th>
        <th>Mail</th>   
        </thead>
        <tbody>
            <?php
            $unEven = true;
            foreach ($studenten as $row) {
                if ($unEven) {
                    echo("<tr id='" . $row["id"] . "' class='unEven'>");
                } else {
                    echo("<tr id='" . $row["id"] . "'>");
                }
                echo("<td>" . $row["id"] . "</td>");
                echo("<td>" . $row["voornaam"] . "</td>");
                echo("<td>" . $row["tussenvoegsel"] . "</td>");
                echo("<td>" . $row["achternaam"] . "</td>");
                echo("<td>" . $row["mail"] . "</td>");
                echo("</tr>");
                $unEven = !$unEven;
            }
            ?>
        </tbody>
    </table>

    <?php
    if (isset($_SESSION['importSuccess'])) {

        echo '<script type="text/javascript">openCover("importResult");</script>';
    }
    unset($_SESSION['importSuccess']);
    ?>






