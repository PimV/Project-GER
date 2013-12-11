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
    
    //Word gebruikt op de result pagina om alle klassen van een student op te halen voor wanneer de admin is ingelogd
    //en coach id kan daar nog bij worden opgegeven wanneer een docent is ingelogd 
    //Schooljaar kan worden megegeven voor de comboboxen op resultaat pagina
    public function getAllClassesOfStudent_array($studentId, $schoolyear = null, $coachId = null){
        $parameters = array($studentId);
        
        $query = "SELECT k.id, k.klascode, b.naam, COUNT(s.id) AS studenten
                    FROM klas k 
                    LEFT JOIN klas_student s ON s.klas_id = k.id 
                    LEFT JOIN blok b ON b.id = k.blok_id
                    WHERE k.verwijderd = false
                    AND s.student_id = ? ";
        
        if(!is_null($coachId)) {
            $query .= "AND k.coach_id = ? ";
            array_push($parameters, $coachId);
        }
        
        if(!is_null($schoolyear)) {
            $query .= "AND b.leerjaar = ? ";
            array_push($parameters, $schoolyear);
        }
        
        $query .= "AND beoordeling_deadline IS NOT NULL
                    AND beoordeling_deadline < NOW()
                    GROUP BY k.id";
        
        $result = DatabaseConnector::executeQuery($query, $parameters);
        return $result;         
    }
    
    public function getAllSchoolYearsOfStudent_array($studentId, $coachId = null){
        $parameters = array($studentId);
        
        $query = "SELECT b.leerjaar
                    FROM klas k 
                    LEFT JOIN klas_student s ON s.klas_id = k.id 
                    LEFT JOIN blok b ON b.id = k.blok_id
                    WHERE k.verwijderd = false
                    AND s.student_id = ? ";
        
        if(!is_null($coachId)) {
            $query .= "AND k.coach_id = ? ";
            array_push($parameters, $coachId);
        }
        
        $query .= "AND beoordeling_deadline IS NOT NULL
                    AND beoordeling_deadline < NOW()
                    GROUP BY b.leerjaar";
                
        $result = DatabaseConnector::executeQuery($query, $parameters);
        return $result; 
    }
}

?>
