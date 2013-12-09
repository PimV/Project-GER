<?php

/**
 * Description of KlasEditController
 *
 * @author johan
 */
class KlasEditController {
    
    private $klasModel;
    
    public function __construct() {
        //include_once 'model/klassen.php';
        //$this->klasModel = new Klas();
    }
    
    public function invoke() {
        $page = "view/klasEdit.php";
        
        include_once 'view/template.php';
    }
}

?>
