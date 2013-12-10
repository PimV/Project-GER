<?php

/**
 * Description of Studenten
 *
 * @author James Hay
 */
class Studenten {
    
    public function __construct() {
    }
    
    public function addStudent() {
        
    }
    
    public function getAllStudents() {
        
    }
    
    public function getAllStudents_array($noHistory = true) {
        $query = "SELECT * from student"; 
        
        $result = DatabaseConnector::executeQuery($query);
        return $result;        
        
    }
    
    public function getStudent($studentID) {
    }
}

?>
