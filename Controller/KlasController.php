<?php

/**
 * Description of KlasController
 *
 * @author johan
 */
class KlasController {
    
    private $klassenModel;
    
    public function __construct() {
        include_once 'model/klassen.php';
        $this->klassenModel = new Klassen();
    }
    
    public function invoke() {
        $page = "view/klas.php";
        
        $klassen = $this->klassenModel->getAllClasses_array();
        
        include_once 'view/template.php';
    }
}

?>
