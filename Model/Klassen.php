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
    
    /**
     * Get a 2d array of all classes containing the class id, name and student amount.
     * 
     * @param boolean $currentlyReviewing If true, only retrieve classes that are currently beïng reviewed. $noHistory will have no effect.
     * @param boolean $noHistory If true, will not retrieve classes from the past. (reviewing deadline has already past)
     * @return array[][]
     */
    public function getAllClasses_array($currentlyReviewing = false, $noHistory = true) {
                
        $query = "SELECT k.id, klascode, b.naam, COUNT(s.id) AS studenten
                    FROM klas k 
                    LEFT JOIN klas_student s ON s.klas_id = k.id 
                    LEFT JOIN blok b ON b.id = k.blok_id
                    WHERE k.verwijderd = false ";
        
        if($currentlyReviewing) {
            $query .= "AND beoordeling_deadline IS NOT NULL 
                        AND beoordeling_deadline > NOW() ";
        }
        else {
            if($noHistory) {
                $query .= "AND (beoordeling_deadline IS NULL 
                            OR beoordeling_deadline < NOW()) ";
            }
        }
        
        $query .= "GROUP BY k.id";
        
        $result = DatabaseConnector::executeQuery($query);
        return $result;        
        
    }
    
    public function getClass($classID) {
        
    }
    
    public function removeClass($classID) {
        $query = "UPDATE klas SET verwijderd = true WHERE id = ?";
        DatabaseConnector::executeQuery($query, array($classID));
    }
    
}
?>
