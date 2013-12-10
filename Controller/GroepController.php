<?php

/**
 * Description of StudentController
 *
 * @author Pieter School
 */
class StudentController {
    
    public function __construct() {
    }
    
    public function invoke() {
        $page = "view/groep.php";
        
        include_once 'view/template.php';
    }
}

?>