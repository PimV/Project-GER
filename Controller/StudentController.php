<?php

/**
 * Description of StudentController
 *
 * @author James Hay
 */
class StudentController {
    
    public function __construct() {
    }
    
    public function invoke() {
        $page = "view/student.php";
        
        include_once 'view/template.php';
    }
}

?>
