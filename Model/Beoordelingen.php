<?php

/**
 * Description of Klassen
 *
 * @author johan
 */
class Beoordelingen {

    public function __construct() {
        
    }

    public function getAllBeoordelingenByClass($classStudentId, $docentId) {
        $query = "SELECT * FROM resultaat WHERE klas_student_id = $classStudentId AND docent_id = $docentId";
        $result = DatabaseConnector::executeQuery($query);

        return $result;
    }
    
    

}

?>
