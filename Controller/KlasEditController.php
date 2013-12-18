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
        include_once 'Model'.DIRECTORY_SEPARATOR.'Klassen.php';
        include_once 'Model'.DIRECTORY_SEPARATOR.'Blokken.php';
        include_once 'Model'.DIRECTORY_SEPARATOR.'Studenten.php';
        include_once 'Model'.DIRECTORY_SEPARATOR.'Klas.php';
        $this->klassenModel = new Klassen();
        $this->blokkenModel = new Blokken();
        $this->studentenModel = new Studenten();
        
        if(isset($_GET["id"])){
            $this->klasModel = $this->klassenModel->getClass($_GET["id"]);
        }
    }
    
    public function invoke() {
        if(!empty($_POST))
        {
            $this->saveData();
        }
        
        $students = array();
        $classID = "";
        $classCode = "";
        $coachID = "";
        $blockID = "";
        $schoolYear = "";
        
        if(isset($this->klasModel)){
            $students = $this->klasModel->getStudents();
            $classID = $this->klasModel->getClassID();
            $classCode = $this->klasModel->getClassCode();
            $coachID = $this->klasModel->getCoachID();
            $blockID = $this->klasModel->getBlockID();
            $schoolYear = $this->klasModel->getSchoolYear();
        }
        
        $yearChoices = array();
        array_push($yearChoices, date("Y")."-".(date("Y")+1));
        array_push($yearChoices, (date("Y")+1)."-".(date("Y")+2));
        
        $blokken = $this->blokkenModel->getAllBlocks();
        $classLessStudents = $this->studentenModel->getClasslessStudents();

        $page = "View".DIRECTORY_SEPARATOR."KlasEdit.php";
        $pagehead = "View".DIRECTORY_SEPARATOR."KlasEditHead.php";
        include_once 'View'.DIRECTORY_SEPARATOR.'Template.php';
    }
    
    //TODO: $_POST["coach"] implementeren.
    private function saveData() {
        if(isset($_GET["id"])){
            //Update class.
            $this->klasModel->setClassCode($_POST["code"]);
            $this->klasModel->setBlock($_POST["block"]);
            $this->klasModel->setSchoolYear($_POST["schoolyear"]);
            $this->klasModel->setCoach(1);
            $this->klasModel->setStudents($_POST["list1"]);
            $this->klasModel->saveToDB();
        }
        else {
            //Create new class.
            $this->klassenModel->addClass($_POST["code"], $_POST["block"], $_POST["schoolyear"], 1, $_POST["list1"]);
        }
        header("location: index.php?p=klas");
    }
}

?>
