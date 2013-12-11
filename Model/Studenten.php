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
    
    public function getStudent($studentId) {
        $query = "SELECT * from student WHERE id = {$studentId}";
        
        $result = DatabaseConnector::executeQuery($query);
        return $result;
    }

    public function removeStudent($studentID) {
      $query = "DELETE FROM student WHERE id = ?";
      DatabaseConnector::executeQuery($query, array($studentId));
    }
}

?>
