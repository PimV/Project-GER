<?php

/**
 * Description of Studenten
 *
 * @author James Hay
 */
class Studenten {

    public function __construct() {
        include_once 'Student.php';
    }

    public function addStudent() {
        //
    }

    public function getAllStudents_array() {
        $query = "SELECT * from student";

        $result = DatabaseConnector::executeQuery($query);
        return $result;
    }
    
    public function getStudent($studentId) {
        return new Student($studentId);
    }

    public function removeStudent($studentID) {
        $query = "DELETE FROM student WHERE id = ?";
        DatabaseConnector::executeQuery($query, array($studentId));
    }

    //TODO: studenten die van school af zijn?
    public function getClasslessStudents() {
        $query = "SELECT s.id AS studentid, CONCAT_WS(' ', s.voornaam, s.tussenvoegsel, s.achternaam) AS studentnaam
                    FROM student s
                    WHERE s.id NOT IN (
                        SELECT ks.student_id
                        FROM klas k
                        LEFT JOIN klas_student ks ON ks.klas_id = k.id
                        WHERE k.beoordeling_deadline IS NULL
                    )";

        $result = DatabaseConnector::executeQuery($query);
        return $result;
    }
    
    //TODO: moet verplaatst worden naar 'student' model.
    //Word gebruikt op de result pagina om alle klassen van een student op te halen voor wanneer de admin is ingelogd
    //en coach id kan daar nog bij worden opgegeven wanneer een docent is ingelogd 
    //Schooljaar kan worden megegeven voor de comboboxen op resultaat pagina
    public function getAllClassesOfStudent_array($studentId, $schoolyear = null, $coachId = null) {
        $parameters = array($studentId);

        $query = "SELECT k.id, k.klascode, b.naam, COUNT(s.id) AS studenten
                    FROM klas k 
                    LEFT JOIN klas_student s ON s.klas_id = k.id 
                    LEFT JOIN blok b ON b.id = k.blok_id
                    WHERE k.verwijderd = false
                    AND s.student_id = ? ";

        if (!is_null($coachId)) {
            $query .= "AND k.coach_id = ? ";
            array_push($parameters, $coachId);
        }

        if (!is_null($schoolyear)) {
            $query .= "AND b.leerjaar = ? ";
            array_push($parameters, $schoolyear);
        }

        $query .= "AND beoordeling_deadline IS NOT NULL
                    AND beoordeling_deadline < NOW()
                    GROUP BY k.id";

        $result = DatabaseConnector::executeQuery($query, $parameters);
        return $result;
    }

    //TODO: moet verplaatst worden naar 'student' model.
    public function getAllSchoolYearsOfStudent_array($studentId, $coachId = null) {
        $parameters = array($studentId);

        $query = "SELECT b.leerjaar
                    FROM klas k 
                    LEFT JOIN klas_student s ON s.klas_id = k.id 
                    LEFT JOIN blok b ON b.id = k.blok_id
                    WHERE k.verwijderd = false
                    AND s.student_id = ? ";

        if (!is_null($coachId)) {
            $query .= "AND k.coach_id = ? ";
            array_push($parameters, $coachId);
        }

        $query .= "AND beoordeling_deadline IS NOT NULL
                    AND beoordeling_deadline < NOW()
                    GROUP BY b.leerjaar";

        $result = DatabaseConnector::executeQuery($query, $parameters);
        return $result;
    }

    public function getStudentsFromClass($classId) {
        $query = "  SELECT s.id AS id, s.voornaam AS voornaam, s.achternaam AS achternaam, s.tussenvoegsel AS tussenvoegsel FROM student s
                    JOIN klas_student ks ON ks.student_id = s.id
                    WHERE ks.klas_id = $classId
                    ORDER BY ks.id";
        $result = DatabaseConnector::executeQuery($query);
        return $result;
    }

}

?>
