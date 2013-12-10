<?php

/**
 * Description of StudentController
 *
 * @author Pieter School
 */
class GroepEditController {
    
    public function __construct() {
    }
    
    public function invoke() {
        $page = "view/groepedit.php";
        
        include_once 'view/template.php';
    }
}

?>