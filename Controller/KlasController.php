<?php

/**
 * Description of KlasController
 *
 * @author johan
 */
class KlasController {
    
    private $klassenModel;
    
    public function __construct() {
        include_once 'model'.DIRECTORY_SEPARATOR.'klassen.php';
        $this->klassenModel = new Klassen();
    }
    
    public function invoke() {
        
        if(isset($_GET["del"])){
            $this->klassenModel->removeClass($_GET["del"]);
            header("Location: index.php?p=klas");
        }
        
        $klassen = $this->klassenModel->getAllClasses_array();
        
        $page = "view".DIRECTORY_SEPARATOR."klas.php";
        include_once 'view'.DIRECTORY_SEPARATOR.'template.php';
    }
}

?>
