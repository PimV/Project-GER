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
        include_once 'Model/Klassen.php';
        include_once 'Model/Klas.php';
        $this->klassenModel = new Klassen();
    }
    
    public function invoke() {
        $page = "View/KlasEdit.php";
        $head = "View/KlasEditHead.php";
        
        $students = array();
        
        if(isset($_GET["id"])){
            $this->klasModel = $this->klassenModel->getClass($_GET["id"]);
            $students = $this->klasModel->getStudents(); 
        }
        
        $year1 = date("Y")." - ".(date("Y")+1);
        $year2 = (date("Y")+1)." - ".(date("Y")+2);
        
        include_once 'View/Template.php';
    }
}

?>
