<?php

/**
 * Description of StudentController
 *
 * @author Pieter School
 */
class GroepController {
    public function __construct() {
        include_once 'Model' . DIRECTORY_SEPARATOR . 'Groepen.php';
        $this->GroepenModel = new Groepen();
    }
    
    public function invoke() {
		// Als sessie 'blok' nog bestaat, unset sessie
		if(isset($_SESSION['groep'])) {
                    unset($_SESSION['groep']);
		}
		if(isset($_GET['del'])) {
                    // Assign id
                    $id = $_GET['del'];
                    // Delete blok d.m.v. id
                    $this->GroepenModel->removeGroep($id);	
		}
		
		$groupList = $this->GroepenModel->getAllGroups();
		
		$page = "View" . DIRECTORY_SEPARATOR . "groep.php";
                
                
        include "View" . DIRECTORY_SEPARATOR . "Template.php";
    }
}

?>