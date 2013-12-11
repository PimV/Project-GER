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

    //1 = pak alle klassen (admin) 
    public function getAllClasses_array($noHistory = true){
        $query = "SELECT k.id, k.klascode, b.naam, COUNT(s.id) AS studenten
                    FROM klas k 
                    LEFT JOIN klas_student s ON s.klas_id = k.id 
                    LEFT JOIN blok b ON b.id = k.blok_id
                    WHERE k.verwijderd = false ";

        if($noHistory) {
            $query .= "AND (beoordeling_deadline IS NULL 
                        OR beoordeling_deadline > NOW()) ";
        }
        $query .= "GROUP BY k.id";
        
        $result = DatabaseConnector::executeQuery($query);
        return $result; 
    }
    
    //2 = Pak alle klassen met een ingevulde deadline die nog NIET voorbij is (docent beoordeling)
    //mag de regel met IS NOT NULL niet gewoon weg?
    public function getAllClassesReviewing_array($studentId = null){
        $query = "SELECT k.id, k.klascode, b.naam, COUNT(s.id) AS studenten
                    FROM klas k 
                    LEFT JOIN klas_student s ON s.klas_id = k.id 
                    LEFT JOIN blok b ON b.id = k.blok_id
                    WHERE k.verwijderd = false ";
        
        if(!is_null($studentId)) {
            $query .= "AND s.student_id = ? ";
        }
        
        $query .= "AND beoordeling_deadline IS NOT NULL
                    AND beoordeling_deadline > NOW()
                    GROUP BY k.id";
        if(!is_null($studentId)) {
            $result = DatabaseConnector::executeQuery($query, array($studentId));
        }
        else{
            $result = DatabaseConnector::executeQuery($query);            
        }
        
        return $result; 
    }
    //3 = pak alle klassen waar docent coach is met een ingevulde deadline die WEL voorbij is (coach)
    //mag de regel met IS NOT NULL niet gewoon weg?
    public function getAllClassesRating_array($coachId, $studentId = null){
        $parameters = array($coachId);
        
        $query = "SELECT k.id, k.klascode, b.naam, COUNT(s.id) AS studenten
                    FROM klas k 
                    LEFT JOIN klas_student s ON s.klas_id = k.id 
                    LEFT JOIN blok b ON b.id = k.blok_id
                    WHERE k.verwijderd = false
                    AND k.coach_id = ? "; 
        
        if(!is_null($studentId)) {
            $query .= "AND s.student_id = ? ";
            array_push($parameters, $studentId);
        }
        
        $query .= "AND beoordeling_deadline IS NOT NULL
                    AND beoordeling_deadline < NOW()
                    GROUP BY k.id";
        
        $result = DatabaseConnector::executeQuery($query, $parameters);
        return $result; 
    }
        
    public function getClass($classID) {
        return new Klas($classID);
    }
    
    public function removeClass($classID) {
        $query = "UPDATE klas SET verwijderd = true WHERE id = ?";
        DatabaseConnector::executeQuery($query, array($classID));
    }
    
}
?>
