<?php

/**
 * Description of StudentSearchController
 *
 * @author Bas van den Heuvel & James Hay
 */
class StudentSearchController {
    
    private $studentenModel;
    private $klassenModel;
    
    public function __construct()
    {
        include_once 'model/Studenten.php';
        include_once 'model/Klassen.php';
        $this->studentenModel = new Studenten();
        $this->klassenModel = new Klassen();
    }
    
    public function invoke()
    {
        $page = 'StudentSearch.php';
        $pagehead = 'StudentSearchHead.php';   
        
        $studenten = $this->studentenModel->getAllStudents_array();
        $klassen = $this->klassenModel->getAllClasses_array();

        include 'View/Template.php';
    }
}

?>
