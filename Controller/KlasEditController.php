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
    }
    
    public function invoke() {
        if(!empty($_POST))
        {
            //TODO: Save the class
            if(isset($_GET["id"])){
                //Update class.
            }
            else {
                //Create new class.
            }
            
            header("location: index.php?p=klas");
        }
        
        $students = array();
        $classCode = "";
        $coachID = "";
        $blockID = "";
        $schoolYear = "";
        
        if(isset($_GET["id"])){
            $this->klasModel = $this->klassenModel->getClass($_GET["id"]);
            $students = $this->klasModel->getStudents(); 
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
        $head = "View".DIRECTORY_SEPARATOR."KlasEditHead.php";
        include_once 'View'.DIRECTORY_SEPARATOR.'Template.php';
    }
}

?>
