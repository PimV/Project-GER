<?php

/**
 * Description of Rubrieken
 *
 * @author Niek Willems
 */
class Rubrieken {

	public function __construct() {
		include_once($_SERVER['DOCUMENT_ROOT']."/Controller/DatabaseConnector.php");
	}
	
	public function addRubric($name, $description) {
		$array = array($name, $description);
		DatabaseConnector::executeQuery("INSERT INTO rubriek(naam, omschrijving) VALUES(?, ?)", $array);
	}
	
	public function removeRubric($id) {
		DatabaseConnector::executeQuery("UPDATE rubriek
										 SET verwijderd = 1
										 WHERE id = ?", array($id));
	}
	
	public function updateRubric($name, $omschrijving, $id) {
		$array = array($name, $omschrijving, $id);
		DatabaseConnector::executeQuery("UPDATE rubriek
										 SET naam = ?, omschrijving = ?
										 WHERE id = ?", $array);
	}
	
	public function getRubric($id) {
		$result = DatabaseConnector::executeQuery("SELECT * FROM rubriek WHERE id = ?", array($id));
		return $result;
	}

	public function getAllRubrics() {
		$result = DatabaseConnector::executeQuery("SELECT * FROM rubriek WHERE verwijderd = 0");
		return $result;
	}
	

}
 
 
 
 
 
 
 ?>