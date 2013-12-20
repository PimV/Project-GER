<?php

/**
 * Description of StudentController
 *
 * @author Pieter School
 */
class GroepController {
    
    public function __construct() {
    }
    
    public function invoke() {
        $page = "view/groep.php";
        
        include_once 'view/template.php';
    }
}

?>