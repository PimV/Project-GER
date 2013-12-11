<?php

/**
 * Description of Rubrieken
 *
 * @author Niek Willems
 */
class Rubrieken {

	public function __construct() {

	}
	
	public function addRubric($name, $description) {
		$array = array($name, $description);
		include_once($_SERVER['DOCUMENT_ROOT']."/Controller/DatabaseConnector.php");
		DatabaseConnector::executeQuery("INSERT INTO rubriek(naam, omschrijving) VALUES(?, ?)", $array);
	}

	public function getAllRubrics() {
		include_once($_SERVER['DOCUMENT_ROOT']."/Controller/DatabaseConnector.php");
		$result = DatabaseConnector::executeQuery("SELECT * FROM rubriek");
		return $result;
	}
	
	public function pr() {
		return 'pr called';
	}




}
 
 
 
 
 
 
 ?>