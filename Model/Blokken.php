<?php

/**
 * Description of Rubrieken
 *
 * @author Niek Willems
 */
class Blokken {

	public function __construct() {

	}
	
	public function getAllBlocks() {
		$result = DatabaseConnector::executeQuery("SELECT * FROM blok WHERE verwijderd = 0");
		return $result;
	}
	

}

?>