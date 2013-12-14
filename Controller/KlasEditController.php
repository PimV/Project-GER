<?php

/**
 * Description of KlasEditController
 *
 * @author johan
 */
class KlasEditController {
    
    private $klassenModel;
    private $blokkenModel;
    private $studentenModel;
    private $klasModel;
    
    public function __construct() {
        include_once 'Model/Klassen.php';
        include_once 'Model/Blokken.php';
        include_once 'Model/Studenten.php';
        include_once 'Model/Klas.php';
        $this->klassenModel = new Klassen();
        $this->blokkenModel = new Blokken();
        $this->studentenModel = new Studenten();
    }
    
    public function invoke() {
        if(!empty($_POST))
        {
            //TODO: Save the class
            header("location: index.php?p=klas");
        }
        
        $students = array();
        
        if(isset($_GET["id"])){
            $this->klasModel = $this->klassenModel->getClass($_GET["id"]);
            $students = $this->klasModel->getStudents(); 
        }
        
        $year1 = date("Y")." - ".(date("Y")+1);
        $year2 = (date("Y")+1)." - ".(date("Y")+2);
        $blokken = $this->blokkenModel->getAllBlocks();
        $classLessStudents = $this->studentenModel->getClasslessStudents();
        
        $page = "View/KlasEdit.php";
        $head = "View/KlasEditHead.php";
        include_once 'View/Template.php';
    }
}

?>
