<?php

/**
 * Controller voor de klassenlijst pagina.
 *
 * @author johan
 */
class KlasController {
    
    private $klassenModel;
    
    public function __construct() {
        if(!$_SESSION["admin"]) { header("location: index.php?p=home"); }
        include_once 'Model'.DIRECTORY_SEPARATOR.'Klassen.php';
        $this->klassenModel = new Klassen();
    }
    
    public function invoke() {
        
        //Wanneer op de verwijder knop gedrukt is, verwijder de klas en ververs de pagina.
        if(isset($_GET["del"])){
            $this->klassenModel->removeClass($_GET["del"]);
            header("Location: index.php?p=klas");
        }
        
        //Haal alle klassen op
        $klassen = $this->klassenModel->getAllClasses_array(false, true);
        
        $page = "View".DIRECTORY_SEPARATOR."Klas.php";
        $pagehead = "View".DIRECTORY_SEPARATOR."KlasHead.php";
        include_once 'View'.DIRECTORY_SEPARATOR.'Template.php';
    }
}

?>
