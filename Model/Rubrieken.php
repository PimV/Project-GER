<?php

/**
 * Description of Rubrieken
 *
 * @author Niek Willems
 */
class Rubrieken {

	public function __construct() {
		include_once('Model/Rubriek.php');
	}
	
	/**
	 * Voeg een nieuwe rubriek toe
	 *
	 */
	public function addRubric($name, $description) {
		$array = array($name, $description);
		DatabaseConnector::executeQuery("INSERT INTO rubriek(naam, omschrijving) VALUES(?, ?)", $array);
	}
	
	/**
	 * Verwijder een specifieke rubriek d.m.v. het id
	 *
	 */
	public function removeRubric($id) {
		DatabaseConnector::executeQuery("UPDATE rubriek
										 SET verwijderd = 1
										 WHERE id = ?", array($id));
	}
	
	/**
	 * Haal een specifieke rubriek op d.m.v. het id
	 *
	 */
	public function getRubric($id) {
		return new Rubriek($id);
		//$result = DatabaseConnector::executeQuery("SELECT * FROM rubriek WHERE id = ?", array($id));
		//return $result;
	}

	/**
	 * Haal alle rubrieken op
	 *
	 */
	public function getAllRubrics() {
		$result = DatabaseConnector::executeQuery("SELECT * FROM rubriek WHERE verwijderd = 0");
		return $result;
	}
	

}
 
 
 
 
 
 
 ?>