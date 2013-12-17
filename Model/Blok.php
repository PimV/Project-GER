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
    
    public function __construct() {

    }
    
	public function setId($id) { $this->id = $id; }
    public function setName($name) { $this->name = $name; }
    public function setDescription($description) { $this->description = $description; }
    public function setBlockNumber($blockNumber) { $this->blockNumber = $blockNumber; }
    public function setSchoolYear($schoolYear) { $this->schoolYear = $schoolYear; }
    
    public function saveToDB() {
        
    }
    
}

?>