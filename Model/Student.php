<?php

/**
 * Description of Student
 *
 * @author James Hay
 */
class Student {

    public function __construct() {
        
    }

    public function getClassesStudent($studentId, $classId) {
        $query = "SELECT * FROM klas_student WHERE klas_id = $classId AND student_id = $studentId";

        $result = DatabaseConnector::executeQuery($query);

        return $result;
    }

}

?>
