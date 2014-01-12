<?php

/**
 * Klassen model. Voor algemene acties die betrekking hebben over de hele collectie klassen.
 *
 * @author johan
 */
class Klassen {

    public function __construct() {
        
    }

    public function addClass($classCode, $blockID, $schoolyear, $coachID, $students = array()) {
        $newClass = new Klas();
        $newClass->setClassCode($classCode);
        $newClass->setBlock($blockID);
        $newClass->setSchoolYear($schoolyear);
        $newClass->setCoach($coachID);
        $newClass->setStudents($students);
        $newClass->saveToDB();
    }

    /**
     * Pak alle HUIDIGE klassen. (admin klas overzicht)
     * Klassen uit het verleden (al beoordeeld) en klassen die momenteel beoordeeld worden, worden niet standaard opgehaald.
     * Deze klassen mogen namelijk niet meer bewerkt worden. (wel mogelijk op te halen via de parameters)
     * 
     * @param boolean $showHistory Default op false, wanneer true haalt hij ook klassen uit het verleden op. (en klassen die momenteel beoordeeld worden.)
     * @param boolean $showReviewing Default op false, wanneer true haalt hij ook klassen op die momenteel beoordeeld worden.
     * @return array[][] Bevat alle klassen inclusief student aantallen.
     */
    public function getAllClasses_array($showHistory = false, $showReviewing = false) {
        $query = "SELECT k.*,
                        DATE_FORMAT(k.beoordeling_deadline,'%d-%m-%Y') AS beoordeling_deadline_dmY, 
                        b.naam, 
                        b.bloknummer, 
                        b.id AS blokid, 
                        CONCAT_WS(' ', d.voornaam, d.tussenvoegsel, d.achternaam) AS coach,
                        COUNT(s.id) AS studenten
                    FROM klas k 
                    LEFT JOIN klas_student s ON s.klas_id = k.id 
                    LEFT JOIN blok b ON b.id = k.blok_id
                    LEFT JOIN docent d ON d.id = k.coach_id
                    WHERE k.verwijderd = false ";
        
        if (!$showHistory) {
            $query .= "AND (beoordeling_deadline IS NULL ";
            if($showReviewing) {
                $query .= "OR beoordeling_deadline > NOW() ";
            }
            $query .= ") ";
        }
            
        $query .= "GROUP BY k.id
                    ORDER BY k.beoordeling_deadline ASC, k.schooljaar DESC, b.bloknummer ASC";

        $result = DatabaseConnector::executeQuery($query);
        return $result;
    }

    /**
     * Pak alle klassen die open staan om beoordeeld te worden. (docent beoordeling)
     * 
     * @param int $studentId Optioneel. 
     * @return array[][] Bevat alle klassen inclusief student aantallen.
     */
    public function getAllClassesReviewing_array($studentId = null) {
        $query = "SELECT k.id, k.klascode, b.naam, COUNT(s.id) AS studenten, k.blok_id AS blokid
                    FROM klas k 
                    LEFT JOIN klas_student s ON s.klas_id = k.id 
                    LEFT JOIN blok b ON b.id = k.blok_id
                    WHERE k.verwijderd = false ";

        if (!is_null($studentId)) {
            $query .= "AND s.student_id = ? ";
        }

        $query .= "AND beoordeling_deadline > NOW()
                    GROUP BY k.id
                    ORDER BY k.schooljaar ASC, b.bloknummer ASC";
        if (!is_null($studentId)) {
            $result = DatabaseConnector::executeQuery($query, array($studentId));
        } else {
            $result = DatabaseConnector::executeQuery($query);
        }

        return $result;
    }

    /**
     * Pak alle klassen met een ingevulde deadline die voorbij is. Eventueel met een specifieke coach en/of student. (coach)
     * 
     * @param int $coachId Optioneel. Haal alleen klassen op van deze coach.
     * @param int $studentId Optioneel. Haal alleen klassen op van deze student.
     * @return array[][] Bevat alle klassen inclusief student aantallen.
     */
    public function getAllClassesRating_array($coachId = null, $studentId = null) {
        $parameters = array();

        $query = "SELECT k.id, k.klascode, b.naam, COUNT(s.id) AS studenten
                    FROM klas k 
                    LEFT JOIN klas_student s ON s.klas_id = k.id 
                    LEFT JOIN blok b ON b.id = k.blok_id
                    WHERE k.verwijderd = false ";

        if (!is_null($coachId)) {
            $query .= "AND k.coach_id = ? ";
            array_push($parameters, $coachId);
        }

        if (!is_null($studentId)) {
            $query .= "AND s.student_id = ? ";
            array_push($parameters, $studentId);
        }

        $query .= "AND beoordeling_deadline < NOW()
                    GROUP BY k.id
                    ORDER BY k.schooljaar ASC, b.bloknummer ASC";

        $result = DatabaseConnector::executeQuery($query, $parameters);
        return $result;
    }

    public function getAllClassesNoResult_array() {

        $query = "  SELECT k.id AS id, k.klascode AS klascode, COUNT(s.id) AS studenten
                    FROM klas k 
                    LEFT JOIN klas_student s ON s.klas_id = k.id 
                    WHERE beoordeling_deadline > NOW()
                    GROUP BY k.id";


        // var_dump($query);

        $result = DatabaseConnector::executeQuery($query);
        return $result;
    }

    public function getClassesStudent($studentId, $classId) {
        $query = "SELECT id AS id FROM klas_student WHERE klas_id = $classId AND student_id = $studentId";

        $result = DatabaseConnector::executeQuery($query);

        return $result;
    }

    /**
     * Haal een specifieke klas op.
     * 
     * @param int $classID Het ID van de klas om op te halen.
     * @return Klas
     */
    public function getClass($classID) {
        return new Klas($classID);
    }

    /**
     * Verwijdern een klas.
     * 
     * @param int $classID De klas om te verwijderen.
     */
    public function removeClass($classID) {
        $query = "DELETE FROM klas_student WHERE klas_id = ?";
        $query2 = "DELETE FROM klas WHERE id = ?";
        DatabaseConnector::executeQuery($query, array($classID));
        DatabaseConnector::executeQuery($query2, array($classID));
    }

}

?>
