<?php

/**
 * Description of Studenten
 *
 * @author James Hay
 */
class Studenten {
    
    public function __construct() {
    }
    
    public function addClass() {
        
    }
    
    public function getAllClasses() {
        
    }
    
    public function getAllClasses_array($noHistory = true) {
        $query = "SELECT * from student"; 
        
        $result = DatabaseConnector::executeQuery($query);
        return $result;        
        
    }
    
    public function getClass($classID) {
    }
}

?>
