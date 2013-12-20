<?php

/**
 * Description of Rubriek
 *
 * @author Niek Willems
 */
class Rubriek {

	private $id;
	private $name;
	private $description;

	/**
	 * Constructor voor rubriek
	 * Haalt de bijbehorende gegevens op als er een id wordt meegegeven
	 */
	public function __construct($id = null) {
		if(!is_null($id)) {
			$this->id = $id;
			$this->loadRubricData($id);
		}
	}
	
	/**
	 * Methodes voor het setten van de klasse variabelen
	 * 
	 */
	public function setId($id) { $this->id = $id; }
    public function setName($name) { $this->name = $name; }
	public function setDescription($description) { $this->description = $description; }
	
	/**
	 * Methodes voor het opvragen van de klasse variabelen
	 * 
	 */
	public function getId() { return $this->id; }
	public function getName() { return $this->name; }
	public function getDescription() { return $this->description; }
	
	/**
	 * Haalt alle gegevens op d.m.v. het id van de rubriek
	 * 
	 */
	private function loadRubricData() {
		$query = "SELECT * FROM rubriek WHERE id = ?";
		
		$result = DatabaseConnector::executeQuery($query, array($this->id));
		
		//$this->id = $result[0]['id'];
		$this->name = $result[0]['naam'];
		$this->description = $result[0]['omschrijving'];
	}
	
	public function saveToDB() {
		$array = array($this->name, 
					   $this->description, 
					   $this->id);
		
		DatabaseConnector::executeQuery("UPDATE rubriek
										 SET naam = ?, omschrijving = ?
										 WHERE id = ?", $array);
	}
	
}