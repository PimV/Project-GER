<?php

/**
 * Description of KlasEditController
 *
 * @author johan
 */
class KlasEditController {
    
    private $klassenModel;
    private $blokkenModel;
    private $klasModel;
    
    public function __construct() {
        include_once 'Model/Klassen.php';
        include_once 'Model/Blokken.php';
        include_once 'Model/Klas.php';
        $this->klassenModel = new Klassen();
        $this->blokkenModel = new Blokken();
    }
    
    public function invoke() {
        if(!empty($_POST))
        {
            echo("form saved");
            var_dump($_POST);
        }
        
        $students = array();
        
        if(isset($_GET["id"])){
            $this->klasModel = $this->klassenModel->getClass($_GET["id"]);
            $students = $this->klasModel->getStudents(); 
        }
        
        $year1 = date("Y")." - ".(date("Y")+1);
        $year2 = (date("Y")+1)." - ".(date("Y")+2);
        $blokken = $this->blokkenModel->getAllBlocks();
        
        $page = "View/KlasEdit.php";
        $head = "View/KlasEditHead.php";
        include_once 'View/Template.php';
    }
}

?>
