<!-- Op deze pagina moet rekening wordne gehouden wie er ingelogd is. Indien in COACH is ingelogd moeten bepaalde ribbon knoppen niet worden getoond.
     Ook moet dan het zoek gedeelte worden aangepast naar alleen een dropdown met de klassen en een student naam zoek balk. 
     
     Als het om een administrator gaat moet alles worden getoond.

     Een heleboel menu knoppen moeten ook disabled zijn als er nog geen student geselecteerd is.-->
<div class="coverBg" id="coverDel">
    <div class="cover">
        <div class="header">
            <div class="closeButton fontIcon" onclick="closeCover('coverDel')"></div>
        </div>
        <div class="contentMessage">
            <h2>Weet u zeker dat u deze student wilt verwijderen?</h2>
            <br/><br/><br/><br/>
            <input type="button" value="Ja" onclick="javascript:location.href='index.php?p=studentsearch&del='+getSelectedItemId();"/>
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
            <form action="index.php?p=studentsearch" method="post" enctype="multipart/form-data">
                <label for="file">Bestand: </label>
                <input type="file" name="file" id="file"><br>
                <input type="submit" name="submit" value="Submit">
            </form>
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
    <div class="item">
        <div class="fontIcon">
            &#xe07f;
        </div>  
        <div class="text">
            Zoeken
        </div>
    </div>   
    <div class="item" onclick="javascript:location.href = 'index.php?p=resultaat&id=' + getSelectedItemId()">
        <div class="fontIcon">
            &#xe095;
        </div>  
        <div class="text">
            Resultaten
        </div>
    </div>   

    <!-- Laat onderstaande knoppen alleen zien als een administrator is ingelogd -->
    <?php if ($_SESSION['admin']) { ?>
        <div class="item" onclick="javascript:location.href = 'index.php?p=studentedit'">
            <div class="fontIcon">
                &#xe102;
            </div>  
            <div class="text">
                Toevoegen
            </div>
        </div>
        <div class="item" onclick="javascript:location.href = 'index.php?p=studentedit&id=' + getSelectedItemId();">
            <div class="fontIcon">
                &#xe006;
            </div>  
            <div class="text">
                Bewerken
            </div>
        </div> 
        <div class="item" onclick="getSelectedItemId();openCover('coverDel');">
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
                    <td>Studentnummer</td>  
                    <td><input type="text"/></td>
                </tr>  
                <tr>
                    <td>Voornaam</td>  
                    <td><input type="text"/></td>
                </tr>         
                <tr>
                    <td>Achternaam</td>  
                    <td><input type="text"/></td>
                </tr>  
            </table>            
        </div>

        <div class="right">   
            <table class="noAction">  
                <tr>     
                    <td>Startdatum</td>         
                    <td><input type="text"/></td>
                </tr>           
                <tr>     
                    <td>Einddatum</td>         
                    <td><input type="text"/></td>
                </tr> 
                <tr>
                    <td>Klas</td>
                    <td>
                        <select id="dropdownClass" class="selectFullSize" onchange="showId()">
                            <option> </option>
                            <?php
                            foreach ($klassen as $row) {
                                echo("<option value='" . $row["id"] . "'>" . $row["klascode"] . " - " . $row["naam"] . "</option>");
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
                                echo("<option value='" . $row["id"] . "'>" . $row["klascode"] . " - " . $row["naam"] . "</option>");
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

    <?php if ($_SESSION['admin']) { ?>
        <table cellpadding="0" cellspacing="0">
            <thead>
            <th>Id</th>     
            <th>Voornaam</th>
            <th>Achternaam</th>
            <th>Tussenvoegsel</th>
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
                    echo("<td>" . $row["achternaam"] . "</td>");
                    echo("<td>" . $row["tussenvoegsel"] . "</td>");
                    echo("<td>" . $row["mail"] . "</td>");
                    echo("</tr>");
                    $unEven = !$unEven;
                }
                ?>
            </tbody>
        </table>
    <?php } ?>



    <?php
    // WERKT NOG NIET
    include 'Libraries/PHPExcel/PHPExcel/IOFactory.php';

    $inputFileName = $_FILES['file']['tmp_name'];

    //  Read your Excel workbook
    try {
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);

        $outputObj = new PHPExcel();
    } catch(Exception $e) {
        die();
    }

    //  Get worksheet dimensions
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();

    for ($row = 1; $row <= $highestRow; $row++) {

        $studentId = $sheet->getCell('A' . $row)->getValue();
        $klasId = $sheet->getCell('B' . $row)->getValue();
        $voornaam = $sheet->getCell('C' . $row)->getValue();
        $tussenvoegsel = $sheet->getCell('D' . $row)->getValue();
        $achternaam = $sheet->getCell('E' . $row)->getValue();

        if (!empty($studentId)) {
            $imports[$importCount] = array(
                "studentId" => $studentId,
                "klasId" => $klasId,
                "voornaam" => $voornaam,
                "tussenvoegsel" => $tussenvoegsel,
                "achternaam" => $achternaam
            );

            $importCount = $importCount + 1;
        }
    }

?>
