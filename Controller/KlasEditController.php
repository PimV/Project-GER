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
    private $docentenModel;
    private $klasModel;
    
    public function __construct() {
        include_once 'Model'.DIRECTORY_SEPARATOR.'Klassen.php';
        include_once 'Model'.DIRECTORY_SEPARATOR.'Blokken.php';
        include_once 'Model'.DIRECTORY_SEPARATOR.'Studenten.php';
        include_once 'Model'.DIRECTORY_SEPARATOR.'Docenten.php';
        include_once 'Model'.DIRECTORY_SEPARATOR.'Klas.php';
        $this->klassenModel = new Klassen();
        $this->blokkenModel = new Blokken();
        $this->studentenModel = new Studenten();
        $this->docentenModel = new Docenten();
        
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
        $reviewing = false;
        
        if(isset($this->klasModel)){
            $students = $this->klasModel->getStudents();
            $classID = $this->klasModel->getClassID();
            $classCode = $this->klasModel->getClassCode();
            $coachID = $this->klasModel->getCoachID();
            $blockID = $this->klasModel->getBlockID();
            $schoolYear = $this->klasModel->getSchoolYear();
            $reviewing = $this->klasModel->currentlyReviewing();
        }
        
        $yearChoices = array();
        array_push($yearChoices, date("Y")."-".(date("Y")+1));
        array_push($yearChoices, (date("Y")+1)."-".(date("Y")+2));
        
        if(!empty($blockID)) {
            $block = $this->blokkenModel->getBlock($blockID);
            $blockNumber = $block->getBlockNumber();
            $blockName = $block->getName();
        }
        
        $blokken = $this->blokkenModel->getAllBlocks();
        $classLessStudents = $this->studentenModel->getClasslessStudents();
        $docenten = $this->docentenModel->getAllTeachers();

        $page = "View".DIRECTORY_SEPARATOR."KlasEdit.php";
        include_once 'View'.DIRECTORY_SEPARATOR.'Template.php';
    }
    
    private function saveData() {
        if(isset($_GET["id"])){
            //Update class.
            $this->klasModel->setClassCode($_POST["code"]);
            if(isset($_POST["block"])){ $this->klasModel->setBlock($_POST["block"]); }
            $this->klasModel->setSchoolYear($_POST["schoolyear"]);
            $this->klasModel->setCoach($_POST["coach"]);
            $this->klasModel->setStudents($_POST["list1"]);
            $this->klasModel->saveToDB();
        }
        else {
            //Create new class.
            $this->klassenModel->addClass($_POST["code"], $_POST["block"], $_POST["schoolyear"], $_POST["coach"], $_POST["list1"]);
        }
        header("location: index.php?p=klas");
    }
}

?>
