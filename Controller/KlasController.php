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
        
        if(isset($_GET["del"])){
            $this->klassenModel->removeClass($_GET["del"]);
            header("Location: index.php?p=klas");
        }
        
        $klassen = $this->klassenModel->getAllClasses_array();
        //TODO: klassen waarvan al een deadline geset is, mogen niet aangepast worden.
        
        include_once 'view/template.php';
    }
}

?>
