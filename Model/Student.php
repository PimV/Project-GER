<?php

/**
 * Description of Student
 *
 * @author James Hay
 */
class Student {
    
    private $studentId;
    private $voornaam;
    private $achternaam;
    private $tussenvoegsel;
    private $mail;

    public function __construct($studentId) {
        $this->studentId = $studentId;
        $this->loadStudentData();
    }

    private function loadStudentData() {
        $query = "SELECT * FROM student WHERE id = ?";
        
        $result = DatabaseConnector::executeQuery($query, array($this->studentId));

        $this->voornaam = $result[0]["voornaam"];
        $this->achternaam = $result[0]["achternaam"];
        $this->tussenvoegsel = $result[0]["tussenvoegsel"];
        $this->mail = $result[0]["mail"];
     }

     // Setters
     public function setVoornaam($voornaam) { $this->voornaam = $voornaam; }
     public function setAchternaam($achternaam) { $this->achternaam = $achternaam; }
     public function setTussenvoegsel($tussenvoegsel) { $this->tussenvoegsel = $tussenvoegsel; }
     public function setMail($mail) { $this->mail = $mail; }

     // Getters
     public function getStudentId() { return $this->studentId; } 
     public function getVoornaam() { return $this->voornaam; } 
     public function getAchternaam() { return $this->achternaam; } 
     public function getTussenvoegsel() { return $this->tussenvoegsel; } 
     public function getMail() { return $this->mail; } 

    // Nog niet getest
    public function saveToDB() {
        $query = "UPDATE student (voornaam, achternaam, tussenvoegsel, mail) 
                    VALUES (?, ?, ?, ?) WHERE id = ?";

        $parameters = array($this->voornaam,
                            $this->achternaam,
                            $this->tussenvoegsel,
                            $this->mail,
                            $this->studentId);
        
        DatabaseConnector::executeQuery($query, $parameters);
    }
    
    //DE METHODES HIER ONDER ZIJN WORK IN PROGRESS!!! WEL VAST GEPUSHT OM GEEN PROBLEMEN MET JAMES TE KRIJGEN
    public function saveFinalResults(){
        
    }
    
    public function getResults(){ // REKING HOUDEN MET EVENTUEEL CHECKEN OP LEERJAAR IPV KLAS ( ALLE KLASSEN UIT DAT LEERJAAR)
        $query = "  SELECT r.rubriek_id AS rubriek, ru.naam, ROUND(AVG(w.waardering),0) AS gemiddelde, MAX(w.waardering) - MIN(w.waardering) AS Spreiding
                    FROM resultaat r
                    LEFT JOIN klas_student ks ON r.klas_student_id = ks.id
                    LEFT JOIN rubriek ru ON r.rubriek_id = ru.id
                    LEFT JOIN waardering w ON r.waardering_id = w.id
                    WHERE ks.student_id = 3 
                    AND ks.klas_id = 5
                    GROUP BY ru.id";

        if ($noHistory) {
            $query .= "AND beoordeling_deadline IS NULL ";
        }
        $query .= "GROUP BY k.id
                    ORDER BY k.schooljaar ASC, b.bloknummer ASC";

        $result = DatabaseConnector::executeQuery($query);
        return $result;
    }
    
    public function getFinalResults(){
        
    }
    
    public function hasFinalResult($blok) {
        $query = "SELECT CASE WHEN EXISTS(
                        SELECT *
                            FROM resultaat_definitief rd
                            LEFT JOIN klas_student ks ON rd.klas_student_id =  ks.id
                            WHERE ks.klas_id = 5
                            AND ks.student_id = 3
                    )
                    THEN TRUE
                    ELSE FALSE END
                    AS hasfinal";
        
        $result = DatabaseConnector::executeQuery($query);// ARRAY MEEGEVEN
        
        return $result[0]["hasfinal"];
    }
}


?>
