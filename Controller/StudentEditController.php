<?php

/**
 * Description of StudentEditController
 *
 * @author James Hay
 */
class StudentEditController {
    
    
    public function __construct() {
    }
    
    public function invoke() {
        $page = "view/studentEdit.php";
        include_once 'view/template.php';
    }
}

?>
