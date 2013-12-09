<?php

/**
 * Description of KlasController
 *
 * @author johan
 */
class KlasController {
    
    private $klasModel;
    
    public function __construct() {
        include_once 'model/klassen.php';
        $this->klasModel = new Klassen();
    }
    
    public function invoke() {
        $page = "view/klas.php";
        
        $klassen = $this->klasModel->getAllClasses_array();
        
        include_once 'view/template.php';
    }
}

?>
