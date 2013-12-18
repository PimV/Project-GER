<?php

/**
 * Description of RubriekController
 *
 * @author Niek Willems
 */
class RubriekController {
    
	private $rubriekenModel;
	
    public function __construct()
    {
		include_once 'Model' . DIRECTORY_SEPARATOR . 'Rubrieken.php';
        $this->rubriekenModel = new Rubrieken;
	}
    
    public function invoke()
    {
		if(isset($_GET['del'])) {
			// Assign id
			$id = $_GET['del'];
			// Delete rubriek d.m.v. id
			$this->rubriekenModel->removeRubric($id);	
		}
		
		$rubricArray = $this->rubriekenModel->getAllRubrics();

        $page = "View" . DIRECTORY_SEPARATOR . "Rubriek.php";
        include "View" . DIRECTORY_SEPARATOR . "Template.php";
    }
}

?>
