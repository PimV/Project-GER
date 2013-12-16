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

   

    /**
     * Pak alle klassen die open staan om beoordeeld te worden. (docent beoordeling)
     * 
     * @param int $studentId Optioneel. 
     * @return array[][] Bevat alle klassen inclusief student aantallen.
     */
    

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
                    WHERE k.verwijderd = false";

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
        $query = "UPDATE klas SET verwijderd = true WHERE id = ?";
        DatabaseConnector::executeQuery($query, array($classID));
    }

}

?>
