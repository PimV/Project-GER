<?php

/**
 * Description of ResultatController
 *
 * @author Bas van den Heuvel
 */
class ResultaatController {
    
    private $studentenModel;
    
    public function __construct()
    {        
        include_once 'model/Studenten.php';
        $this->studentenModel = new Studenten();
    }
    
    public function invoke()
    {
        $studentId = $_GET["id"];
        $coachId = $_SESSION["docentId"];
        
        $student = $this->studentenModel->getStudent($studentId);
        
        
        if($_SESSION['admin']){
            $schooljaren = $this->studentenModel->getAllSchoolYearsOfStudent_array($studentId);
            $klassen = $this->studentenModel->getAllClassesOfStudent_array($studentId, $schooljaren[count($schooljaren) -1]["leerjaar"]);
        }
        else{
            $schooljaren = $this->studentenModel->getAllSchoolYearsOfStudent_array($studentId, $coachId);
            $klassen = $this->studentenModel->getAllClassesOfStudent_array($studentId, $schooljaren[count($schooljaren) -1]["leerjaar"], $coachId);
        }
        
        $page = 'Resultaat.php';
        $pagehead = 'ResultaatHead.php';
        
        include 'View/Template.php';
    }
}

?>
