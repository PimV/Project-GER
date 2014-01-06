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
    private $mail;    private $oldId;

    public function __construct($studentId = null) {
        if(!is_null($studentId)) {
            $this->studentId = $studentId;
            $this->loadStudentData();
        }
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
    public function setStudentId($studentId) { $this->studentId = $studentId; }
    public function setVoornaam($voornaam) { $this->voornaam = $voornaam; }
    public function setAchternaam($achternaam) { $this->achternaam = $achternaam; }
    public function setTussenvoegsel($tussenvoegsel) { $this->tussenvoegsel = $tussenvoegsel; }
    public function setMail($mail) { $this->mail = $mail; }
    public function setOldId($oldId) { $this->oldId = $oldId; }

    // Getters
    public function getStudentId() { return $this->studentId; } 
    public function getVoornaam() { return $this->voornaam; } 
    public function getAchternaam() { return $this->achternaam; } 
    public function getTussenvoegsel() { return $this->tussenvoegsel; } 
    public function getMail() { return $this->mail; } 
    public function getOldId() { return $this->oldId; }

    public function saveToDB() {
        $query = "SELECT * FROM student WHERE id = ?";
        $result = DatabaseConnector::executeQuery($query, array($this->studentId));

        if (is_null($this->oldId)) {
            // geen ID
            $this->saveNewStudent();
        } else if ($this->oldId == $this->studentId) {
            // ID niet veranderd
            $this->updateStudent();
        } else if ($this->oldId != $this->studentId && is_null($result[0])) {
            // ID veranderd & nieuwe ID bestaat niet
            $this->updateStudentWithDependencies();
        }
    }

    public function saveNewStudent() {
        $query = "INSERT INTO student (id, voornaam, achternaam, tussenvoegsel, mail)
                  VALUES (?, ?, ?, ?, ?)";
                  
        $parameters = array($this->studentId,
                            $this->voornaam,
                            $this->achternaam,
                            $this->tussenvoegsel,
                            $this->mail);
        
        DatabaseConnector::executeQuery($query, $parameters);
    }

    public function updateStudent() {
        $query = "UPDATE student 
                  SET voornaam = ?, achternaam = ?, tussenvoegsel = ?, mail = ? 
                  WHERE id = ?";

        $parameters = array($this->voornaam,
                            $this->achternaam,
                            $this->tussenvoegsel,
                            $this->mail,
                            $this->studentId);

        DatabaseConnector::executeQuery($query, $parameters);
    }  

    public function updateStudentWithDependencies() {
        $this->saveNewStudent();

        // klas_student aanpassen
        $query = "UPDATE klas_student 
                  SET student_id = ? 
                  WHERE student_id = ?";

        $parameters = array($this->studentId,
                            $this->oldId);

        DatabaseConnector::executeQuery($query, $parameters);

        // Verwijder student
        $query = "DELETE FROM student WHERE id = ?";
        DatabaseConnector::executeQuery($query, array($this->oldId));
    }

    
    //Zou moeten werken. Alleen nog maar via workbench getest!
    //Haal de punten voor een student uit een blok op per docent
    public function getResultsClass($klas){
        $query = "  SELECT r.rubriek_id, ru.naam AS rubriek, w.waardering, CONCAT_WS(' ', d.voornaam, d.tussenvoegsel, d.achternaam) AS docent
                    FROM resultaat r
                    LEFT JOIN klas_student ks ON r.klas_student_id = ks.id
                    LEFT JOIN docent d ON r.docent_id = d.id
                    LEFT JOIN rubriek ru ON r.rubriek_id = ru.id
                    LEFT JOIN waardering w ON r.waardering_id = w.id
                    WHERE ks.student_id = ?
                    AND ks.klas_id = ?";
        
        $result = DatabaseConnector::executeQuery($query, array($this->getStudentId(), $klas));
        return $result;
    }
    
    //Zou moeten werken. Alleen nog maar via workbench getest!
    //Haal het gemiddelde voor een student op uit een leerjaar (max 4 blokken) per docent
    public function getResultsYear($leerjaar){
        $query = "  SELECT r.rubriek_id, ru.naam AS rubriek, COALESCE(ROUND(AVG(NULLIF(w.waardering, 0)),0),0) AS waardering, CONCAT_WS(' ', d.voornaam, d.tussenvoegsel, d.achternaam) AS docent
                    FROM resultaat r
                    LEFT JOIN klas_student ks ON r.klas_student_id = ks.id
                    LEFT JOIN docent d ON r.docent_id = d.id
                    LEFT JOIN rubriek ru ON r.rubriek_id = ru.id
                    LEFT JOIN waardering w ON r.waardering_id = w.id
                    LEFT JOIN klas k ON ks.klas_id = k.id
                    LEFT JOIN blok b ON k.blok_id = b.id
                    WHERE ks.student_id = ?
                    AND b.leerjaar = ?
                    AND k.beoordeling_deadline < NOW()
                    GROUP BY d.id, ru.id";
        
        $result = DatabaseConnector::executeQuery($query, array($this->getStudentId(), $leerjaar));
        return $result;
    }
    
    //Zou moeten werken. Alleen nog maar via workbench getest!
    //Haal het gemiddelde voor een student op uit een blok
    public function getAverageResultClass($klas){
        $query = "  SELECT r.rubriek_id, ru.naam AS rubriek, COALESCE(ROUND(AVG(NULLIF(w.waardering, 0)),0),0) AS gemiddelde, MAX(w.waardering) - MIN(w.waardering) AS spreiding, ks.id AS klas_student_id
                    FROM resultaat r
                    LEFT JOIN klas_student ks ON r.klas_student_id = ks.id
                    LEFT JOIN rubriek ru ON r.rubriek_id = ru.id
                    LEFT JOIN waardering w ON r.waardering_id = w.id
                    WHERE ks.student_id = ? 
                    AND ks.klas_id = ?
                    GROUP BY ru.id";

        $result = DatabaseConnector::executeQuery($query, array($this->getStudentId(), $klas));
        return $result;
    }
    
    //Zou moeten werken. Alleen nog maar via workbench getest!
    //Haal het gemiddelde voor een student op uit een leerjaar (max 4 blokken)
    public function getAverageResultYear($leerjaar){
        $query = "  SELECT r.rubriek_id, ru.naam AS rubriek, COALESCE(ROUND(AVG(NULLIF(w.waardering, 0)),0),0) AS gemiddelde
                    FROM resultaat r
                    LEFT JOIN klas_student ks ON r.klas_student_id = ks.id
                    LEFT JOIN rubriek ru ON r.rubriek_id = ru.id
                    LEFT JOIN waardering w ON r.waardering_id = w.id
                    LEFT JOIN klas k ON ks.klas_id = k.id
                    LEFT JOIN blok b ON k.blok_id = b.id
                    WHERE ks.student_id = ?
                    AND b.leerjaar = ?
                    AND k.beoordeling_deadline < NOW()
                    GROUP BY ru.id";

        $result = DatabaseConnector::executeQuery($query, array($this->getStudentId(), $leerjaar));
        return $result;
    }
    
    //Haal de eindrestultaten van een student uit een bepaald blok op    
    public function getFinalResults($klas){
        $query = "  SELECT rd.*, w.waardering, r.naam AS rubriek
                    FROM resultaat_definitief rd
                    LEFT JOIN klas_student ks ON rd.klas_student_id =  ks.id
                    LEFT JOIN waardering w ON rd.waardering_id = w.id
                    LEFT JOIN rubriek r ON rd.rubriek_id = r.id
                    WHERE ks.student_id = ?
                    AND ks.klas_id = ?";

        $result = DatabaseConnector::executeQuery($query, array($this->getStudentId(), $klas));
        return $result;
    }
    
    //Sla de eindresultaten van een student uit een bepaald blok op
    public function saveFinalResults($beoordeling, $klas_student){
        $parameter = array();
        $date = date("Y-m-d");
        
        //Insert in resultaat definitief
        $query = "  INSERT INTO resultaat_definitief
                    (rubriek_id, klas_student_id, datum_beoordeling, waardering_id)
                    values ";
        
        $size = count($beoordeling);
        $i = 0;
        foreach($beoordeling as $key => $waarderingid){
            $query .= "(?, ?, ? , ?)";
            array_push($parameter, $key);
            array_push($parameter, $klas_student);
            array_push($parameter, $date);
            array_push($parameter, $waarderingid);
            
            if($i < $size-1){
                $query .= ", ";
            }
            $i++;
        }
        
        DatabaseConnector::executeQuery($query, $parameter);
    }
    
    //Zou moeten werken. Alleen nog maar via workbench getest!
    //Controleer of die student in een bepaalde klas al een eindbeoordeling heeft.
    public function hasFinalResult($blok) {
        $query = "SELECT CASE WHEN EXISTS(
                        SELECT *
                            FROM resultaat_definitief rd
                            LEFT JOIN klas_student ks ON rd.klas_student_id =  ks.id
                            WHERE ks.student_id = ?
                            AND ks.klas_id = ?
                    )
                    THEN TRUE
                    ELSE FALSE END
                    AS hasfinal";
        
        $result = DatabaseConnector::executeQuery($query, array($this->getStudentId(), $blok));
        
        return $result[0]["hasfinal"];
    }
}


?>
