<?php

/**
 * Description of ResultatController
 *
 * @author Bas van den Heuvel
 */
class ResultaatController {
    
    private $klassenModel;
    
    public function __construct()
    {
        include_once 'model/Klassen.php';
        $this->klassenModel = new Klassen();
    }
    
    public function invoke()
    {
        //$studentId = $_GET["id"];
        $studentId = 6;
        $coachId = $_SESSION["docentId"];
        
        if($_SESSION['admin']){
             $klassen = $this->klassenModel->getAllClasses_array();
        }
        else{
             $klassen = $this->klassenModel->getAllClassesRating_array($coachId);
        }
        
        
        
        $page = 'Resultaat.php';
       // $pagehead = 'ResultaatHead.php';

        include 'View/Template.php';
    }
}

?>
