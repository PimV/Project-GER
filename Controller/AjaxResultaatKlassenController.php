<?php

/**
 * Description of AjaxResultaatKlassenController
 *
 * @author Bas van den Heuvel & Johan Beekers
 */
class AjaxResultaatKlassenController {
    
    private $studentenModel;
    
    public function __construct()
    {        
        include_once 'model/Studenten.php';
        $this->studentenModel = new Studenten();
    }
    
    public function invoke()
    {
        $studentId = $_GET["id"];
        $schooljaar = $_GET["l"];
        $coachId = $_SESSION["docentId"];
                
        if($_SESSION['admin']){
            $klassen = $this->studentenModel->getAllClassesOfStudent_array($studentId, $schooljaar);
        }
        else{
            $klassen = $this->studentenModel->getAllClassesOfStudent_array($studentId, $schooljaar, $coachId);
        }
        
        include('View/Ajax/AjaxResultaatComboKlassen.php');
    }
}

?>
