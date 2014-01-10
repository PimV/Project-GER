<?php

/**
 * Controller voor de pagina voor het aanpassen van een klas.
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
        if(!$_SESSION["admin"]) { header("location: index.php?p=home"); }
        include_once 'Model'.DIRECTORY_SEPARATOR.'Klassen.php';
        include_once 'Model'.DIRECTORY_SEPARATOR.'Blokken.php';
        include_once 'Model'.DIRECTORY_SEPARATOR.'Studenten.php';
        include_once 'Model'.DIRECTORY_SEPARATOR.'Docenten.php';
        include_once 'Model'.DIRECTORY_SEPARATOR.'Klas.php';
        $this->klassenModel = new Klassen();
        $this->blokkenModel = new Blokken();
        $this->studentenModel = new Studenten();
        $this->docentenModel = new Docenten();
        
        //Wanneer een ID is mee gegeven, haal de klas model op.
        if(isset($_GET["id"])){
            $this->klasModel = $this->klassenModel->getClass($_GET["id"]);
        }
    }
    
    public function invoke() {
        
        //Bij een form submit, sla de gegevens op.
        if(!empty($_POST))
        {
            $this->saveData();
        }
        
        //Klasgegevens. Wanneer we een klas aanpassen haalt hij deze gegevens op.
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
        
        //De enige 3 schooljaar keuzes die je kan hebben voor een nieuwe klas.
        $yearChoices = array();
        array_push($yearChoices, (date("Y")-1)."-".(date("Y")));
        array_push($yearChoices, date("Y")."-".(date("Y")+1));
        array_push($yearChoices, (date("Y")+1)."-".(date("Y")+2));
        
        //Haal de blok gegevens op als we een klas aan het aanpassen zijn. (en de dus al een blok heeft gekoppeld)
        if(!empty($blockID)) {
            $block = $this->blokkenModel->getBlock($blockID);
            $blockNumber = $block->getBlockNumber();
            $blockName = $block->getName();
        }
        
        //Haal lijsten op van mogelijke blokken, klasloze studenten (klasloos = zit niet in een klas die nog niet beoordeeld is/nu beoordeeld word) en docenten.
        $blokken = $this->blokkenModel->getAllBlocks();
        $classLessStudents = $this->studentenModel->getClasslessStudents();
        $docenten = $this->docentenModel->getAllTeachers();

        $page = "View".DIRECTORY_SEPARATOR."KlasEdit.php";
        include_once 'View'.DIRECTORY_SEPARATOR.'Template.php';
    }
    
    /**
     * Klas opslaan.
     */
    private function saveData() {
        if(isset($_GET["id"])){
            //Update class.
            if(isset($_POST["code"])){$this->klasModel->setClassCode($_POST["code"]); }
            if(isset($_POST["block"])){ $this->klasModel->setBlock($_POST["block"]); }
            if(isset($_POST["schoolyear"])){$this->klasModel->setSchoolYear($_POST["schoolyear"]); }
            if(isset($_POST["coach"])){$this->klasModel->setCoach($_POST["coach"]); }
            if(isset($_POST["list1"])){$this->klasModel->setStudents($_POST["list1"]); }
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
