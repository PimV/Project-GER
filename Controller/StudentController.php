<?php

/**
 * Description of StudentController
 *
 * @author James Hay
 */
class StudentController {
    
    private $studentenModel;
    
    public function __construct() {
        include_once 'model/studenten.php';
        $this->studentenModel = new Studenten();
    }
    
    public function invoke() {
        $page = "view/student.php";
        $studenten = $this->studentenModel->getAllClasses_array();
        
        include_once 'view/template.php';
    }
}

?>
