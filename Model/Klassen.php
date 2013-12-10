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
    //    public function getAllClasses_array($currentlyReviewing = false, $noHistory = true, $coachId = null) {
    //                
    //        $query = "SELECT k.id, klascode, b.naam, COUNT(s.id) AS studenten
    //                    FROM klas k 
    //                    LEFT JOIN klas_student s ON s.klas_id = k.id 
    //                    LEFT JOIN blok b ON b.id = k.blok_id
    //                    WHERE k.verwijderd = false ";
    //        
    //        if($currentlyReviewing) {
    //            $query .= "AND beoordeling_deadline IS NOT NULL 
    //                        AND beoordeling_deadline > NOW() ";
    //        }
    //        else {
    //            if($noHistory) {
    //                $query .= "AND (beoordeling_deadline IS NULL 
    //                            OR beoordeling_deadline < NOW()) ";
    //            }
    //        }
    //        
    //        $query .= "GROUP BY k.id";
    //        
    //        $result = DatabaseConnector::executeQuery($query);
    //        return $result;        
    //        
    //    }

    //1 = pak alle klassen (admin) 
    public function getAllClasses_array(){
        $query = "SELECT k.id, k.klascode, b.naam, COUNT(s.id) AS studenten
                    FROM klas k 
                    LEFT JOIN klas_student s ON s.klas_id = k.id 
                    LEFT JOIN blok b ON b.id = k.blok_id
                    WHERE k.verwijderd = false
                    GROUP BY k.id";

        $result = DatabaseConnector::executeQuery($query);
        return $result; 
    }
    
    //2 = Pak alle klassen met een ingevulde deadline die nog NIET voorbij is (docent beoordeling)
    //mag de regel met IS NOT NULL niet gewoon weg?
    public function getAllClassesReviewing_array(){
        $query = "SELECT k.id, k.klascode, b.naam, COUNT(s.id) AS studenten
                    FROM klas k 
                    LEFT JOIN klas_student s ON s.klas_id = k.id 
                    LEFT JOIN blok b ON b.id = k.blok_id
                    WHERE k.verwijderd = false 
                    AND beoordeling_deadline IS NOT NULL
                    AND beoordeling_deadline > NOW()
                    GROUP BY k.id";
        
        $result = DatabaseConnector::executeQuery($query);
        return $result; 
    }
    //3 = pak alle klassen waar docent coach is met een ingevulde deadline die WEL voorbij is (coach)
    //mag de regel met IS NOT NULL niet gewoon weg?
    public function getAllClassesRating_array($coachId){
        $query = "SELECT k.id, k.klascode, b.naam, COUNT(s.id) AS studenten
                    FROM klas k 
                    LEFT JOIN klas_student s ON s.klas_id = k.id 
                    LEFT JOIN blok b ON b.id = k.blok_id
                    WHERE k.verwijderd = false 
                    AND k.coach_id = ?
                    AND beoordeling_deadline IS NOT NULL
                    AND beoordeling_deadline < NOW()
                    GROUP BY k.id";
        
        $result = DatabaseConnector::executeQuery($query, array($coachId));
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
