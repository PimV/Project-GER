<?php

/**
 * Description of ResultatController
 *
 * @author Bas van den Heuvel
 */
class ResultaatController {

    private $studentenModel;

    public function __construct() {
        include_once 'model/Studenten.php';
        $this->studentenModel = new Studenten();
    }

    public function invoke() {
        $studentId = $_GET["id"];        
        $student = $this->studentenModel->getStudent($studentId);        
        
        if(!empty($_POST["s"])){
           $student->saveFinalResults($_POST["s"], $_POST["k"]);
           
           header("location: #");
        }

        //Admin ingelogd
        if ($_SESSION['admin']){
            $schooljaren = $this->studentenModel->getAllSchoolYearsOfStudent_array($studentId);
            if (count($schooljaren) > 0)
                $klassen = $this->studentenModel->getAllClassesOfStudent_array($studentId, $schooljaren[count($schooljaren) - 1]["leerjaar"]);
        } 
        //Docent ingelogd
        else{
            $coachId = $_SESSION["docentId"];
            
            $schooljaren = $this->studentenModel->getAllSchoolYearsOfStudent_array($studentId, $coachId);
            $klassen = $this->studentenModel->getAllClassesOfStudent_array($studentId, $schooljaren[count($schooljaren) - 1]["leerjaar"], $coachId);
        }

        $page = 'Resultaat.php';
        $pagehead = 'ResultaatHead.php';

        include 'View/Template.php';

        echo "<script>reloadComboAjaxClass(" . $studentId . ");</script>";
    }

}

?>
