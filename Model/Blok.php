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
	private $deadline;
	
	private $classArray = array();
    private $classReviewingArray = array();
	
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
	public function setDeadline($deadline) { $this->deadline = $deadline; }
	public function setClassArray($classArray) { $this->classArray = $classArray; }
	public function setClassReviewingArray($classReviewingArray) { $this->classReviewingArray = $classReviewingArray; }
	
	/**
	 * Methodes voor het opvragen van de klasse variabelen
	 * 
	 */
	public function getId() { return $this->id; }
	public function getName() { return $this->name; }
	public function getDescription() { return $this->description; }
    public function getSchoolYear() { return $this->schoolYear; }
	public function getBlockNumber() { return $this->blockNumber; }
	public function getDeadline() { return $this->deadline; }
	public function getClassArray() { return $this->classArray; }
	public function getClassReviewingArray() { return $this->classReviewingArray; }
	
	/**
	 * Haalt alle gegevens op d.m.v. het id van het blok
	 * 
	 */
	private function loadBlockData() {
		$query = "SELECT b.naam, b.omschrijving, b.leerjaar, b.bloknummer, (SELECT beoordeling_deadline FROM klas WHERE blok_id = b.id AND beoordeling_deadline > NOW() LIMIT 1) AS beoordeling_deadline
				  FROM blok AS b
				  WHERE b.id = ?
				  GROUP BY b.id";
		
		$result = DatabaseConnector::executeQuery($query, array($this->id));
		
		$this->name = $result[0]['naam'];
		$this->description = $result[0]['omschrijving'];
		$this->schoolYear = $result[0]['leerjaar'];
		$this->blockNumber = $result[0]['bloknummer'];
		// Check of de deadline datum  na vandaag ligt, zo niet dan wordt er geen deadline ingesteld
		if (strtotime($result[0]['beoordeling_deadline']) > time()) {
			$this->deadline = $result[0]['beoordeling_deadline'];
		} else {
			$this->deadline = null;
		}
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

		// Ga alleen verder als de deadline is ingevuld, wanneer er geen deadline is
		// ingevuld probeer eventuele bestaande deadlines te verwijderen
		if(isset($this->deadline)) {
			// Variabele om aan te geven of de deadline is gezet
			$deadlineSet = false;
			// Query voor het zetten van de deadline
			$query = "UPDATE klas SET beoordeling_deadline = ? 
					  WHERE blok_id = ? AND klascode = ?";
			// Loop door classArray heen, als het blok_id van een klas in deze array
			// overeen komt met het id van dit blok update de deadline van die klas
			// het array classArray bevat ALLEEN klassen die nog géén deadline hebben
			foreach($this->classArray as $value) {
				if($value['blokid'] == $this->id) {
					$array = array($this->deadline,
								   $this->id,
								   $value['klascode']);
					DatabaseConnector::executeQuery($query, $array);
					$deadlineSet = true;
				}
			}
			// Als deadlineSet 'false' is, loop door classReviewingArray heen en zoek 
			// door de klassen die al wél een deadline hebben, en update deze
			if($deadlineSet == false) {
				foreach($this->classReviewingArray as $value) {
					var_dump($this->classReviewingArray);
					if($value['blokid'] == $this->id) {
						$array = array($this->deadline,
									   $this->id,
									   $value['klascode']);
						DatabaseConnector::executeQuery($query, $array);
					}
				}
			}
		} else {
			$this->removeDeadline();
		}		
    }
	
	/**
	 * Verwijder een deadline van dit blok voor alle huidige klassen die nu beoordeeld worden
	 *
	 */
	private function removeDeadline() {
		$emptyDeadline = NULL;
		$query = "UPDATE klas SET beoordeling_deadline = ?
				  WHERE blok_id = ? AND klascode = ?";
				  
		foreach($this->classReviewingArray as $value) {
			if($value['blokid'] == $this->id) {
				$array = array($emptyDeadline,
							   $this->id,
							   $value['klascode']);
				DatabaseConnector::executeQuery($query, $array);
			}
		}
	}
	
	/**
	 * Returnt true als dit blok al aan een klas gekoppeld is met geen deadline of een deadline
	 * die nog niet is verstreken. Zo niet, returnt false.
	 *
	 */
	public function hasConnectedClasses() {
		$hasConnectedClasses = false;
		$query = "SELECT k.id
				  FROM klas AS k
				  WHERE k.blok_id = ?
				  AND (k.beoordeling_deadline >= CURDATE()
				  OR k.beoordeling_deadline IS NULL)";
		
		$result = DatabaseConnector::executeQuery($query, array($this->id));
		if(!empty($result[0]['id'])) {
			$hasConnectedClasses = true;
		}
		return $hasConnectedClasses;
	}
    
}

?>