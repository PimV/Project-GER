<?php

/**
 * Description of BlokEditController
 *
 * @author Niek Willems
 */
class BlokEditController {
    
	private $blokkenModel;
	private $klassenModel;
	private $blokModel;
	
    public function __construct()
    {
		include_once 'Model' . DIRECTORY_SEPARATOR . 'Blokken.php';
		include_once 'Model' . DIRECTORY_SEPARATOR . 'Blok.php';
		include_once 'Model' . DIRECTORY_SEPARATOR . 'Klassen.php';
		$this->klassenModel = new Klassen;
        $this->blokkenModel = new Blokken;
		$this->blokModel = new Blok;
		
		if(isset($_GET['id'])){
			// Assign id
			$id = $_GET['id'];
			// Get blok d.m.v. id
			$this->blokModel = $this->blokkenModel->getBlock($id);
			// Set session blok
			$_SESSION['blok'] = $id;
        }
    }
    
    public function invoke()
    {
		if(!empty($_POST)) {
			// Initialiseer variabelen
			$name = $_POST['name'];
			$description = $_POST['description'];
			$schoolYear = $_POST['schoolYear'];
			$blockNumber = $_POST['blockNumber'];
			$deadline = date('Y/m/d', strtotime($_POST['deadline']));
			$open = $_POST['open'];
			$classArray = $this->klassenModel->getAllClasses_array();
			// Check of $_SESSION['blok'] bestaat, als dit het geval is update het huidige blok
			// d.m.v het id
			if(isset($_SESSION['blok'])) {
				$id = $_SESSION['blok'];
				$this->blokModel = $this->blokkenModel->getBlock($id);	
				$this->blokModel->setName($name);
				$this->blokModel->setDescription($description);
				$this->blokModel->setSchoolYear($schoolYear);
				$this->blokModel->setBlockNumber($blockNumber);
				$this->blokModel->setDeadline($deadline);
				$this->blokModel->setOpen($open);
				$this->blokModel->setClassArray($classArray);
				$this->blokModel->saveToDB();
				unset($_SESSION['blok']);
			} else { 
				// Sessie bestaat niet, voeg nieuw blok toe
				$this->blokkenModel->addBlock($name, $description, $schoolYear, $blockNumber);
			}
			// Redirect naar blokken overzicht
			header("Location:index.php?p=blok");
		}
		
		$name = $this->blokModel->getName();
		$description = $this->blokModel->getDescription();
		$schoolYear = $this->blokModel->getSchoolYear();
		$blockNumber = $this->blokModel->getBlockNumber();
		$deadline = $this->blokModel->getDeadline();
		
		$page = "View" . DIRECTORY_SEPARATOR . "BlokEdit.php";
        include "View" . DIRECTORY_SEPARATOR . "Template.php";
    }
}

?>
