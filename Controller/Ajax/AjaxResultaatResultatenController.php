<?php

/**
 * Description of AjaxResultaatResultatenController
 *
 * @author Bas van den Heuvel & Johan Beekers
 */
class AjaxResultaatResultatenController {
    
   // private $studentenModel;
    
    public function __construct()
    {        
        //include_once 'model/Studenten.php';
        //$this->studentenModel = new Studenten();
    }
    
    public function invoke()
    {
        $studentId = $_GET["id"];
        $klas = $_GET["k"];
        
        //Pak alle beoordelingen maar......
        //$klassen = $this->studentenModel->getAllClassesOfStudent_array($studentId, $schooljaar);
        
        include('View/Ajax/AjaxResultaatDivResultaten.php');
    }
}

?>
