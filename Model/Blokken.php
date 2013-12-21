<?php

/**
 * Description of Blokken
 *
 * @author Niek Willems
 */
class Blokken {

	public function __construct() {
		include_once('Model/Blok.php');
	}
	
	/**
	 * Voeg een nieuw blok toe
	 *
	 */
	public function addBlock($name, $description, $schoolYear, $blockNumber, $deadline = null) {
		$array = array($name, $description, $schoolYear, $blockNumber);
		DatabaseConnector::executeQuery("INSERT INTO blok(naam, omschrijving, 
										 leerjaar, bloknummer) 
										 VALUES(?, ?, ?, ?)", $array);
		
		// Bij aanmaken blok deadline instellen?
		/*
		if(!is_null($deadline)) {
			$id = DatabaseConnector::executeQuery("SELECT id FROM blok WHERE naam = ? AND omschrijving = ?
											       AND leerjaar = ? AND bloknummer = ?", array($array));
												   
			$blokModel = $this->getBlock($id);
			$blokModel->setOpen(true);
			$blokModel->setDeadline($deadline);
			$blokModel->saveToDB();
		}
		*/
	}
	
	/**
	 * Verwijder een specifiek blok d.m.v. het id
	 *
	 */
	public function removeBlock($id) {
		DatabaseConnector::executeQuery("UPDATE blok
										 SET verwijderd = 1
										 WHERE id = ?", array($id));
	}
	
	/**
	 * Haal een specifiek blok op d.m.v. het id
	 *
	 */
	public function getBlock($id) {
		return new Blok($id);
	}
	
	/**
	 * Haal alle blokken met eventuele deadlines op
	 *
	 */
	public function getAllBlocks() {
		$query = "SELECT b.id, b.naam, b.omschrijving, b.leerjaar, b.bloknummer, k.beoordeling_deadline
				  FROM blok AS b
				  LEFT JOIN klas AS k ON b.id = k.blok_id
				  WHERE b.verwijderd = 0
				  GROUP BY b.id
				  ORDER BY b.leerjaar, b.bloknummer;";
				  
		$result = DatabaseConnector::executeQuery($query);
		return $result;
	}
	

}

?>