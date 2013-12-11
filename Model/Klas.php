<?php
/**
 * Description of Klas
 *
 * @author johan
 */
class Klas {
    
    private $classId;
    private $classCode;
    private $coachId;
    private $blockId;
    private $schoolYear;
    private $reviewDeadline;
    private $students = array();
    
    public function __construct($classID = null) {
        if(!is_null($classID))
        {
            $this->classId = $classID;
            loadClassData();
        }
    }
    
    private function loadClassData() {
        $query = "SELECT k.*
                    FROM klas k
                    WHERE k.id = ?";
        
        $result = DatabaseConnector::executeQuery($query, array($this->classId));
   
        $this->classCode = $result[0]["klascode"];
        $this->coachId = $result[0]["coach_id"];
        $this->blockId = $result[0]["blok_id"];
        $this->schoolYear = $result[0]["schooljaar"];
        $this->reviewDeadline = $result[0]["beoordeling_deadline"];
    }
    
    public function setClassCode($classCode) {
        $this->classCode = $classCode;
    }
    
    public function setCoach($coachId) {
        $this->coachId = $coachId;
    }
    
    public function setBlock($blockId) {
        $this->blockId = $blockId;
    }
    
    public function setSchoolYear($schoolYear) {
        $this->schoolYear = $schoolYear;
    }
    
    public function setReviewDeadline($date) {
        $this->reviewDeadline = $date;
    }
    
    //Check if students where already 
    public function setStudents($studentIds = array()) {
        
    }
    
    public function getStudents() {
        $query = "SELECT s.id AS studentid, CONCAT_WS(' ', s.voornaam, s.tussenvoegsel, s.achternaam) AS studentnaam
                    FROM student s
                    LEFT JOIN klas_student ks ON ks.student_id = s.id
                    LEFT JOIN klas k ON ks.klas_id = k.id
                    WHERE k.id = ?";
        
        $result = DatabaseConnector::executeQuery($query, array($this->classId));
        return $result;
    }
    
    public function isChangePossible(){
        
    }
    
    public function saveToDB() {
        
    }
    
}

?>
