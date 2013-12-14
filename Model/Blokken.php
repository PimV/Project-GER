<?php

/**
 * Description of Rubrieken
 *
 * @author Niek Willems
 */
class Blokken {

	public function __construct() {
		include_once($_SERVER['DOCUMENT_ROOT']."/Controller/DatabaseConnector.php");
	}
	
	public function getAllBlocks() {
		$result = DatabaseConnector::executeQuery("SELECT * FROM blok WHERE verwijderd = 0");
		return $result;
	}
	

}

?>