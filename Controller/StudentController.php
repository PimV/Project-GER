<?php

/**
 * Description of StudentController
 *
 * @author James Hay
 */
class StudentController {
    
    public function __construct() {
        include_once 'model'.DIRECTORY_SEPARATOR.'studenten.php';
        $this->studentenModel = new Studenten();
    }
    
    public function invoke() {
  

      
        $page = 'view'.DIRECTORY_SEPARATOR.'student.php';
        include_once 'view'.DIRECTORY_SEPARATOR.'template.php';
    }
}

?>
