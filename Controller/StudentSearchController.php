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
        $page = 'StudentSearch.php';
        $pagehead = 'StudentSearchHead.php';

        //Admin ingelogd
        if ($_SESSION['admin']) {
            //Als er een klasId is, pak dan alle studenten van die klas, anders pak alle studenten.
            if (isset($_GET['classId'])) {
                $studenten = $this->studentenModel->getStudentsFromClass((int) $_GET['classId']);
            } else {
                $studenten = $this->studentenModel->getAllStudents_array();
            }
            $klassen = $this->klassenModel->getAllClasses_array();

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

        include 'view' . DIRECTORY_SEPARATOR . 'template.php';
    }

}

?>
