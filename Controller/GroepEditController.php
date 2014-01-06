<?php

/**
 * Description of StudentController
 *
 * @author Pieter School
 */
class GroepEditController {
    
    private $rubriekenModel;
    private $groepModel;
    
    public function __construct() {
        if(!$_SESSION["admin"]) { header("location: index.php?p=home"); }
        include_once 'model'.DIRECTORY_SEPARATOR.'Groep.php';
        include_once 'model'.DIRECTORY_SEPARATOR.'Rubrieken.php';
                
        $this->groepModel = new Groep();
        $this->rubriekenModel = new Rubrieken();
        
        if(isset($_GET['del'])) {
            // Assign id
            $id = $_GET['del'];
            // Delete blok d.m.v. id
            $this->groepModel->removeGroep($id);	
        }
    }
    
    public function invoke() {
        if (!empty($_POST)) {
            $this->saveData();
        }
        
        if (isset($_GET["id"]) && !empty($_GET["id"])) {
            $editId = $_GET["id"];

            $group = new Groep;
            $groupList = $group->loadGroup($editId);

            $leftRubricList = $group->getEnabledRubics($editId);
            $rigtRubricList = $group->getDisabledRubics($editId);
        } 
        else{
            $rubrieken = new Rubrieken;
            $rigtRubricList = $rubrieken->getAllRubrics();
        }
        
        $page = "view/groepedit.php";
        
        include_once 'view/template.php';
    }
    
    private function saveData(){
        if(isset($_GET["id"])){
            $this->groepModel->set_id($_GET["id"]);
        }
        //Get post values
        $this->groepModel->set_naam($_POST["naam"]);
        $this->groepModel->set_omschrijving($_POST["omschrijving"]);
        $this->groepModel->set_rubics($_POST["rubrieken"]);
        
        $this->groepModel->saveToDb();
        header("location: index.php?p=groep");
    }
}

?>