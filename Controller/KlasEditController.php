<?php

/**
 * Description of KlasEditController
 *
 * @author johan
 */
class KlasEditController {
    
    private $klassenModel;
    private $klasModel;
    
    public function __construct() {
        include_once 'model/klassen.php';
        $this->klassenModel = new Klassen();
        $this->klasModel = $this->klassenModel->getClass($_GET["id"]);
    }
    
    public function invoke() {
        $page = "View/KlasEdit.php";
        $head = "View/KlasEditHead.php";
        
        include_once 'View/Template.php';
    }
}

?>
