<?php

/**
 * Description of Klassen
 *
 * @author johan
 */
class Klassen {
    
    public function __construct() {
    }
    
    public function addClass() {
        
    }
    
    public function getAllClasses() {
        
    }
    
    public function getAllClasses_array($noHistory = true) {
        
        $date = date("Y") . "-" . (date("Y") + 1);
        
        $query = "SELECT k.id, klascode, COUNT(s.id) AS studenten
                    FROM klas k 
                    LEFT JOIN klas_student s ON s.klas_id = k.id ";
        
        if($noHistory) {
            $query .= "WHERE schooljaar = '$date' ";
        }
        
        $query .= "GROUP BY k.id";
        
        $result = DatabaseConnector::executeQuery($query);
        return $result;        
        
    }
    
    public function getClass($classID) {
        
    }
    
}

?>