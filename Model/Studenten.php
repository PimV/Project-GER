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
    
    public function getAllStudents_array() {
        $query = "SELECT * from student"; 
        
        $result = DatabaseConnector::executeQuery($query);
        return $result;        
        
    }
    
    public function getStudent($studentId) {
        $query = "SELECT * from student WHERE id = ?";
        
        $result = DatabaseConnector::executeQuery($query, array($studentId));
        return $result;
    }

    public function removeStudent($studentID) {
      $query = "DELETE FROM student WHERE id = ?";
      DatabaseConnector::executeQuery($query, array($studentId));
    }
}

?>
