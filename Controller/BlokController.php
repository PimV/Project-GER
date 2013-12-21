<?php

/**
 * Description of BlokController
 *
 * @author Niek Willems
 */
class BlokController {
    
	private $blokkenModel;
	
    public function __construct() {
        if(!$_SESSION["admin"]) { header("location: index.php?p=home"); }
		include_once 'Model' . DIRECTORY_SEPARATOR . 'Blokken.php';
        $this->blokkenModel = new Blokken;
    }
    
    public function invoke()
    {
		// Als sessie 'blok' nog bestaat, unset sessie
		if(isset($_SESSION['blok'])) {
			unset($_SESSION['blok']);
		}
		if(isset($_GET['del'])) {
			// Assign id
			$id = $_GET['del'];
			// Delete blok d.m.v. id
			$this->blokkenModel->removeBlock($id);	
		}
		
		$blockArray = $this->blokkenModel->getAllBlocks();
		
		$page = "View" . DIRECTORY_SEPARATOR . "Blok.php";
        include "View" . DIRECTORY_SEPARATOR . "Template.php";
    }
}

?>
