<?php

/**
 * Description of Blokken
 *
 * @author Niek Willems
 */
class Blokken {

	public function __construct() {

	}
	
	/**
	 * Voeg een nieuw blok toe
	 *
	 */
	public function addBlock($name, $description, $schoolYear, $blockNumber) {
		$array = array($name, $description, $schoolYear, $blockNumber);
		DatabaseConnector::executeQuery("INSERT INTO blok(naam, omschrijving, 
										 leerjaar, bloknummer) 
										 VALUES(?, ?, ?, ?)", $array);
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
	 * Haal alle blokken op
	 *
	 */
	public function getAllBlocks() {
		$result = DatabaseConnector::executeQuery("SELECT * FROM blok WHERE verwijderd = 0");
		return $result;
	}
	

}

?>