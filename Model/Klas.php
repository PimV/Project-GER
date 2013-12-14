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
    private $newStudents = array();
    
    public function __construct($classID = null) {
        if(!is_null($classID))
        {
            $this->classId = $classID;
            $this->loadClassData();
        }
    }
    
    private function loadClassData() {
        $classQuery = "SELECT k.*
                    FROM klas k
                    WHERE k.id = ?";
        
        $studentQuery = "SELECT s.id AS studentid, CONCAT_WS(' ', s.voornaam, s.tussenvoegsel, s.achternaam) AS studentnaam
                    FROM student s
                    LEFT JOIN klas_student ks ON ks.student_id = s.id
                    LEFT JOIN klas k ON ks.klas_id = k.id
                    WHERE k.id = ?
                    ORDER BY s.id ASC";
        
        $classQuery = DatabaseConnector::executeQuery($classQuery, array($this->classId));
        $studentQuery = DatabaseConnector::executeQuery($studentQuery, array($this->classId));
   
        $this->classCode = $classQuery[0]["klascode"];
        $this->coachId = $classQuery[0]["coach_id"];
        $this->blockId = $classQuery[0]["blok_id"];
        $this->schoolYear = $classQuery[0]["schooljaar"];
        $this->reviewDeadline = $classQuery[0]["beoordeling_deadline"];
        $this->students = $studentQuery;
    }
    
    //Setters
    public function setClassCode($classCode) { $this->classCode = $classCode; }
    public function setCoach($coachId) { $this->coachId = $coachId; }
    public function setBlock($blockId) { $this->blockId = $blockId; }
    public function setSchoolYear($schoolYear) { $this->schoolYear = $schoolYear; }
    public function setReviewDeadline($date) { $this->reviewDeadline = $date; }
    public function setStudents($studentIds = array()) { $this->newStudents = $studentIds; }

    //Getters
    public function getClassCode() { return $this->classCode; }
    public function getCoachID() { return $this->coachId; }
    public function getBlockID() { return $this->blockId; }
    public function getSchoolYear() { return $this->schoolYear; }
    public function getReviewDeadline() { return $this->reviewDeadline; }
    public function getStudents() { return $this->students; }
    
    public function isChangePossible(){
        if(!empty($this->reviewDeadline)) {
            return true;
        }
        else {
            return false;
        }
    }
    
    //Compare the new student list with the old one. 
    //Records should be deleted, added or left alone depending on which students are removed, added or kept in the class.
    //If new block, create new class record.
    public function saveToDB() {
        
    }
    
}

?>
