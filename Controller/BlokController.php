<?php

/**
 * Description of BlokController
 *
 * @author Niek Willems
 */
class BlokController {
    
	private $blokkenModel;
	
    public function __construct() {
		include_once 'Model' . DIRECTORY_SEPARATOR . 'Blokken.php';
        $this->blokkenModel = new Blokken;
    }
    
    public function invoke()
    {
		if(isset($_GET['del'])) {
			// Assign id
			$id = $_GET['del'];
			// Delete blok d.m.v. id
			$this->blokkenModel->removeBlock($id);	
		}
		
		$page = "View" . DIRECTORY_SEPARATOR . "Blok.php";
        include "View" . DIRECTORY_SEPARATOR . "Template.php";
    }
}

?>
