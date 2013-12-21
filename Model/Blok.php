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
	private $open;
	private $deadline;
	
	private $classArray = array();
    
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
	public function setOpen($open) { $this->open = $open; }
	public function setDeadline($deadline) { $this->deadline = $deadline; }
	public function setClassArray($classArray) { $this->classArray = $classArray; }

	/**
	 * Methodes voor het opvragen van de klasse variabelen
	 * 
	 */
	public function getId() { return $this->id; }
	public function getName() { return $this->name; }
	public function getDescription() { return $this->description; }
    public function getSchoolYear() { return $this->schoolYear; }
	public function getBlockNumber() { return $this->blockNumber; }
	public function getOpen() { return $this->open; }
	public function getDeadline() { return $this->deadline; }
	public function getClassArray() { return $this->classArray; }
	
	/**
	 * Haalt alle gegevens op d.m.v. het id van het blok
	 * 
	 */
	private function loadBlockData() {
		$query = "SELECT b.naam, b.omschrijving, b.leerjaar, b.bloknummer, k.beoordeling_deadline
				  FROM blok AS b
				  LEFT JOIN klas AS k ON b.id = k.blok_id
				  WHERE b.id = ?
				  GROUP BY b.id";
		
		$result = DatabaseConnector::executeQuery($query, array($this->id));
		
		$this->name = $result[0]['naam'];
		$this->description = $result[0]['omschrijving'];
		$this->schoolYear = $result[0]['leerjaar'];
		$this->blockNumber = $result[0]['bloknummer'];
		$this->deadline = $result[0]['beoordeling_deadline'];
		if(isset($this->deadline)) {
			$this->open = true;
		} else {
			$this->open = false;
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
		
		// Ga alleen verder als de combobox open op 'Ja' is gezet
		// Wanneer een ingevulde deadline wordt gezet op een datum die
		// vóór de huidige datum ligt, dan wordt de deadline op null
		// gezet (verwijderd) uncomment '&& !is_null($this->deadline))'
		// om uit te zetten
		if($this->open == true /*&& !is_null($this->deadline)*/) {
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
					$query = "UPDATE klas SET beoordeling_deadline = ? 
							  WHERE blok_id = ? AND klascode = ?";
					$array = array($this->deadline,
								   $this->id,
								   $value['klascode']);
					$deadlineSet = true;
				}
			}
			// Als deadlineSet 'false' is, loop door classReviewingArray heen en zoek 
			// door de klassen die al wél een deadline hebben, en update deze
			if($deadlineSet == false) {
				foreach($this->classReviewingArray as $value) {
					if($value['blokid'] == $this->id) {
						$array = array($this->deadline,
									   $this->id,
									   $value['klascode']);
						$deadlineSet = true;
					}
				}
			}
			// Set deadline
			if($deadlineSet) {
				DatabaseConnector::executeQuery($query, $array);
			}
		}			
    }
    
}

?>