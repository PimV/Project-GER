<?php

/**
 * Description of RubriekEditController
 *
 * @author Niek Willems
 */
class RubriekEditController {
    
	private $rubriekenModel;
	private $rubriekModel;
	
    public function __construct()
    {
        if(!$_SESSION["admin"]) { header("location: index.php?p=home"); }
		include_once 'Model' . DIRECTORY_SEPARATOR . 'Rubrieken.php';
		include_once 'Model' . DIRECTORY_SEPARATOR . 'Rubriek.php';
        $this->rubriekenModel = new Rubrieken;
		$this->rubriekModel = new Rubriek;
		
		if(isset($_GET['id'])){
			// Assign id
			$id = $_GET['id'];
			// Get rubriek d.m.v. id
			$this->rubriekModel = $this->rubriekenModel->getRubric($id);
			// Set session rubriek
			$_SESSION['rubriek'] = $id;
        }
    }
    
    public function invoke()
    {
		if(!empty($_POST['name']) && !empty($_POST['description'])) {
			// Initialiseer variabelen
			$name = $_POST['name'];
			$description = $_POST['description'];
			// Check of $_SESSION['rubriek'] bestaat, als dit het geval is update de huidige rubriek
			// d.m.v het id
			if(isset($_SESSION['rubriek'])) {
				$id = $_SESSION['rubriek'];
				$this->rubriekModel = $this->rubriekenModel->getRubric($id);	
				$this->rubriekModel->setName($name);
				$this->rubriekModel->setDescription($description);
				$this->rubriekModel->saveToDB();
				unset($_SESSION['rubriek']);
			} else { 
				// Sessie bestaat niet, voeg nieuwe rubriek toe
				$this->rubriekenModel->addRubric($name, $description);
			}
			// Redirect naar rubrieken overzicht
			header("Location:index.php?p=rubriek");
		}
		
		$name = $this->rubriekModel->getName();
		$description = $this->rubriekModel->getDescription();
		
		$page = "View" . DIRECTORY_SEPARATOR . "RubriekEdit.php";
        include "View" . DIRECTORY_SEPARATOR . "Template.php";
    }
}

?>
