<?php
/**
 * Description of Blok
 *
 * @author Niek Willems
 */
class Blok {
    
    private $id;
    private $name;
    private $description;
    private $schoolYear;
    private $blockNumber;
    
	/**
	 * Constructor voor blok
	 * Haalt de bijbehorende gegevens op als er een id wordt meegegeven
	 */
	public function __construct($id = null) {
		if(!is_null($id)) {
			$this->id = $id;
			$this->loadBlockData($id);
		}
	}
	
	/**
	 * Methodes voor het setten van de klasse variabelen
	 * 
	 */
	public function setId($id) { $this->id = $id; }
    public function setName($name) { $this->name = $name; }
    public function setDescription($description) { $this->description = $description; }
	public function setSchoolYear($schoolYear) { $this->schoolYear = $schoolYear; }
    public function setBlockNumber($blockNumber) { $this->blockNumber = $blockNumber; }
	
	/**
	 * Methodes voor het opvragen van de klasse variabelen
	 * 
	 */
	public function getId() { return $this->id; }
	public function getName() { return $this->name; }
	public function getDescription() { return $this->description; }
    public function getSchoolYear() { return $this->schoolYear; }
	public function getBlockNumber() { return $this->blockNumber; }
	
	/**
	 * Haalt alle gegevens op d.m.v. het id van het blok
	 * 
	 */
	private function loadBlockData() {
		$query = "SELECT * FROM blok WHERE id = ?";
		
		$result = DatabaseConnector::executeQuery($query, array($this->id));
		
		$this->name = $result[0]['naam'];
		$this->description = $result[0]['omschrijving'];
		$this->schoolYear = $result[0]['leerjaar'];
		$this->blockNumber = $result[0]['bloknummer'];
	}
	
	/**
	 * Schrijft alle klasse variabelen weg naar de database
	 *
	 */
    public function saveToDB() {
		$array = array($this->name, 
					   $this->description, 
					   $this->schoolYear, 
					   $this->blockNumber, 
					   $this->id);
		
		DatabaseConnector::executeQuery("UPDATE blok
										 SET naam = ?, 
										 omschrijving = ?,
										 leerjaar = ?,
										 bloknummer = ?
										 WHERE id = ?", $array);
    }
    
}

?>