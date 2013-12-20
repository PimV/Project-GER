<?php

/**
 * Description of StudentController
 *
 * @author Pieter School
 */
class GroepEditController {
    
    public function __construct() {
        include_once 'model'.DIRECTORY_SEPARATOR.'Groep.php';
        include_once 'model'.DIRECTORY_SEPARATOR.'Rubrieken.php';
        
        if(isset($_GET['del'])) {
            // Assign id
            $id = $_GET['del'];
            // Delete blok d.m.v. id
            $this->GroepenModel->removeGroep($id);	
        }
                
        $this->groepenModel = new Groep();
        $this->rubriekenModel = new Rubrieken();
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
}

?>