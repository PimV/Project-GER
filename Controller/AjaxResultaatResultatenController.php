<?php

/**
 * Description of AjaxResultaatResultatenController
 *
 * @author Bas van den Heuvel & Johan Beekers
 */
class AjaxResultaatResultatenController {

    private $studentenModel;
    private $waarderingModel;
    private $klasModel;
    private $blokModel;
    private $student;
    private $type;
    private $leerjaar;
    private $waarderingen;

    public function __construct() {
        include_once 'model/Studenten.php';
        include_once 'model/Klas.php';
        include_once 'model/Blok.php';
        include_once 'model/Waarderingen.php';
        $this->studentenModel = new Studenten();
    }

    public function invoke() {
        $this->student = $this->studentenModel->getStudent($_GET["id"]);
        $klas = $_GET["k"];
        $this->leerjaar = $_GET["s"];

        $saveAllowed = false;
        $hasfinal = false;
        $exportAllowed = true;

        if (is_numeric($klas)) {
            $this->type = "klas";
            $result = $this->student->getResultsClass($klas);
            $this->waarderingModel = new Waarderingen();

            if (!empty($result)) {
                $average = $this->student->getAverageResultClass($klas);
                $hasfinal = $this->student->hasFinalResult($klas);
                if ($hasfinal) {
                    $finalresults = $this->student->getFinalResults($klas);
                } else {
                    $saveAllowed = true;
                }
            } else {
                $exportAllowed = false;
            }

            //Uit database ophalen?
            $this->waarderingen = $this->waarderingModel->getAllRatings();

            $this->klasModel = new Klas($klas);
            $this->blokModel = new Blok($this->klasModel->getBlockID());
        } else {
            $this->type = "leerjaar";
            $result = $this->student->getResultsYear($this->leerjaar);
            $average = $this->student->getAverageResultYear($this->leerjaar);
        }


        include('View/AjaxResultaatDivResultaten.php');

        $save = intval($saveAllowed);
        $export = intval($exportAllowed);
        echo "<script type='text/javascript'> saveAllowed = $save; exportAllowed = $export;</script>";

        //Voer de methode uit om de ggraph te generate, en de methode om de imageUrl te maken
        if (!empty($result)) {
            echo "<script type='text/javascript'>imageUrl = new Array(); chartData = new Array();</script>";
            $this->createChart("cvs1", $result, $average);
        }
        if ($hasfinal) {
            $this->createChart("cvs2", $finalresults);
        }
    }

    private function createChart($canvas, $result, $average = NULL) {
        //Geef de chartData mee naar exportcontroller
        if ($canvas == "cvs1") {
            $res = json_encode($result);
            echo "<script type='text/javascript'>chartData = $res;</script>";
        }

        //Vul de gemiddelde punten array            
        $punten = array();
        //Vul de rubrieken array
        $rubrieken = array();
        if (!is_null($average)) {
            $docent = $result[0]["docent"];
            foreach ($result as $row) {
                if ($row["docent"] == $docent)
                    array_push($rubrieken, $row["rubriek"]);
            }

            foreach ($average as $row) {
                array_push($punten, intval($row["gemiddelde"]));
            }
        } else {
            foreach ($result as $row) {
                array_push($punten, intval($row["waardering"]));
                array_push($rubrieken, $row["rubriek"]);
            }
        }

        //Zet de naam van de chart goed
        if (is_null($average)) {
            $name = "Eindbeoordeling: " . $this->student->getVoornaam() . " " . $this->student->getTussenvoegsel() . " " . $this->student->getAchternaam() . " - Leerjaar " . $this->leerjaar;
        } else {
            $name = "Gemiddelde: " . $this->student->getVoornaam() . " " . $this->student->getTussenvoegsel() . " " . $this->student->getAchternaam() . " - Leerjaar " . $this->leerjaar;
        }
        if ($this->type == "klas") {
            $name .= " - " . $this->klasModel->getClassCode() . " - " . $this->blokModel->getName();
        }

        //Maximale beoordeling
        $maximaal = 5;
        //$maximaal = $this->waarderingModel->getMaxRating()[0]['max'];
        
        //Maak van de arrays eens javascript
        $r = json_encode($rubrieken);
        $p = json_encode($punten);

        echo "<script type='text/javascript'> createChart('$canvas', '$name', $r, $p, $maximaal); createUrl('$canvas');</script>";
    }

}

?>
