<?php

/**
 * Description of StudentSearchController
 *
 * @author Bas van den Heuvel & James Hay
 */
class StudentSearchController {

    private $studentenModel;
    private $klassenModel;

    public function __construct() {
        include_once 'model' . DIRECTORY_SEPARATOR . 'studenten.php';
        include_once 'model' . DIRECTORY_SEPARATOR . 'klassen.php';
        $this->studentenModel = new Studenten();
        $this->klassenModel = new Klassen();
    }

    public function invoke() {
    
        $classId = 0;
                
        //Als er een klasId is, pak dan alle studenten van die klas, anders pak alle studenten.
        if (isset($_GET['classId']) && $_GET['classId'] != 0) {
            $classId = $_GET['classId'];
            $studenten = $this->studentenModel->getStudentsFromClass($classId);
        } else {
            $studenten = $this->studentenModel->getAllStudents_array();
        }
        
        //Admin ingelogd
        if ($_SESSION['admin']) {
            
            $klassen = $this->klassenModel->getAllClasses_array(true, true);

            if (isset($_GET["del"])) {
                $this->studentenModel->removeStudent($_GET["del"]);
                header("Location: index.php?p=studentsearch");
            }

            // WERKT NOG NIET
            $importCount = 0;
            $imports = array();
            for ($i = $importCount; $i < count($imports); $i++) {
                $this->studentenModel->addStudent($imports[$i]["voornaam"], $imports[$i]["achternaam"], $imports[$i]["tussenvoegsel"], $imports[$i]["mail"]);
            }
        }
        //Docent ingelogd
        else {
            $coachId = $_SESSION["docentId"];
            $klassen = $this->klassenModel->getAllClassesRating_array($coachId);
        }

        $page = 'StudentSearch.php';
        $pagehead = 'StudentSearchHead.php';
        include 'view' . DIRECTORY_SEPARATOR . 'template.php';
    }

}

?>
