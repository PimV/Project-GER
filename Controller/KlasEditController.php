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
        $classCode = "";
        $coachID = "";
        $blockID = "";
        $isEditable = true;
        $schoolYear = "";
        
        if(isset($_GET["id"])){
            $this->klasModel = $this->klassenModel->getClass($_GET["id"]);
            $students = $this->klasModel->getStudents(); 
            $classCode = $this->klasModel->getClassCode();
            $coachID = $this->klasModel->getCoachID();
            $blockID = $this->klasModel->getBlockID();
            $schoolYear = $this->klasModel->getSchoolYear();
            $isEditable = $this->klasModel->isChangePossible();
        }
        
        $yearChoices = array();
        array_push($yearChoices, date("Y")."-".(date("Y")+1));
        array_push($yearChoices, (date("Y")+1)."-".(date("Y")+2));
        
        $blokken = $this->blokkenModel->getAllBlocks();
        $classLessStudents = $this->studentenModel->getClasslessStudents();
        
        $page = "View/KlasEdit.php";
        $head = "View/KlasEditHead.php";
        include_once 'View/Template.php';
    }
}

?>
