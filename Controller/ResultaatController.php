<?php

/**
 * Description of ResultatController
 *
 * @author Bas van den Heuvel
 */
class ResultaatController {
    
    private $klassenModel;
    private $studentenModel;
    
    public function __construct()
    {
        include_once 'model/Klassen.php';
        include_once 'model/Studenten.php';
        $this->klassenModel = new Klassen();
        $this->studentenModel = new Studenten();
    }
    
    public function invoke()
    {
        $studentId = $_GET["id"];
        $coachId = $_SESSION["docentId"];
        
        $student = $this->klassenModel->getStudent($studentId); 
        
        
        if($_SESSION['admin']){
             $klassen = $this->klassenModel->getAllClasses_array();
        }
        else{
             $klassen = $this->klassenModel->getAllClassesRating_array($coachId, $studentId);
        }
        
        
        
        $page = 'Resultaat.php';
        $pagehead = 'ResultaatHead.php';

        include 'View/Template.php';
    }
}

?>
