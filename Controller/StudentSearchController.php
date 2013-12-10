<?php

/**
 * Description of StudentSearchController
 *
 * @author Bas van den Heuvel & James Hay
 */
class StudentSearchController {
    
    private $studentenModel;
    
    public function __construct()
    {
        include_once 'model/studenten.php';
        $this->studentenModel = new Studenten();
    }
    
    public function invoke()
    {
        $page = 'StudentSearch.php';
        // $pagehead = 'StudentSearchHead.php';        
        $studenten = $this->studentenModel->getAllClasses_array();

        include 'View/Template.php';
    }
}

?>
