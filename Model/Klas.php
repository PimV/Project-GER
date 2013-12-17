<?php
/**
 * Description of Klas
 *
 * @author johan
 */
class Klas {
    
    //Database variables
    private $classId;
    private $classCode;
    private $coachId;
    private $blockId;
    private $schoolYear;
    private $reviewDeadline;
    private $students = array();
    
    //Model variables
    private $newStudents = array();
    private $createNewClass = false;
    
    public function __construct($classID = null) {
        //If a classId has been entered, retrieve class info (for editing). 
        //If not, this will be a new class.
        if(!is_null($classID)) {
            $this->classId = $classID;
            $this->loadClassData();
        }
        else {
            $this->createNewClass = true;
        }
    }
    
    /**
     * Load class data.
     */
    private function loadClassData() {
        $classQuery = "SELECT k.*, DATE_FORMAT(beoordeling_deadline,'%d-%m-%Y') AS beoordeling_deadline_dmY
                        FROM klas k
                        WHERE k.id = ?";
        
        $studentQuery = "SELECT s.id AS studentid, 
                        CONCAT_WS(' ', s.voornaam, s.tussenvoegsel, s.achternaam) AS studentnaam,
                        ks.id AS klas_student
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
        $this->reviewDeadline = $classQuery[0]["beoordeling_deadline_dmY"];
        $this->students = $studentQuery;
    }
    
    //Setters
    public function setClassCode($classCode) { $this->classCode = $classCode; }
    public function setCoach($coachId) { $this->coachId = $coachId; }
    public function setSchoolYear($schoolYear) { $this->schoolYear = $schoolYear; }
    public function setReviewDeadline($date) { $this->reviewDeadline = $date; }
    public function setStudents($studentIds = array()) { $this->newStudents = $studentIds; }
    public function setBlock($blockId) {
        if($blockId != $this->blockId) {
            $this->createNewClass = true;
        }
        $this->blockId = $blockId; 
    }

    //Getters
    public function getClassCode() { return $this->classCode; }
    public function getCoachID() { return $this->coachId; }
    public function getBlockID() { return $this->blockId; }
    public function getSchoolYear() { return $this->schoolYear; }
    public function getReviewDeadline() { return $this->reviewDeadline; }
    public function getStudents() { return $this->students; }
    
    
    public function saveToDB() {
        if($this->createNewClass) {
            
            //Get the id's of the students. Either from the newStudents array or students array.
            $saveStudents = array();
            if(empty($this->newStudents)) {
                foreach ($this->students as $student) {
                    array_push($saveStudents, $student["id"]);
                }
            }
            else {
                $saveStudents = $this->newStudents;
            }
            
            //Nieuwe klas maken.
            $query = "INSERT INTO klas (klascode, coach_id, blok_id, schooljaar)
                        VALUES (?, ?, ?, ?)";
            $parameters = array($this->classCode, 
                                $this->coachId,
                                $this->blockId,
                                $this->schoolYear);
            
            DatabaseConnector::executeQuery($query, $parameters);
            $this->classId = DatabaseConnector::getLastInsertID();
            
            //Studenten aan klas koppelen.
            if(!empty($saveStudents)){
                $query = "INSERT INTO klas_student (klas_id, student_id) VALUES ";
                $parameters = array();
                $studentSize = count($saveStudents);
                foreach ($saveStudents as $key => $id) {
                    $query .= "($this->classId, ?)";
                    if($key < $studentSize-1){$query .= ", ";}
                    array_push($parameters, $id);
                }
                DatabaseConnector::executeQuery($query, $parameters);
            }

        }
        else {
            $query = "UPDATE klas SET klascode = ?, coach_id = ?, blok_id = ?, schooljaar = ? ";
            $parameters = array($this->classCode, 
                                $this->coachId,
                                $this->blockId,
                                $this->schoolYear);
            
            if(!empty($this->reviewDeadline)){
                $query .= ", beoordeling_deadline = STR_TO_DATE($this->reviewDeadline, '%d-%m-%Y') ";
                array_push($parameters, $this->reviewDeadline);
            }
            $query .= "WHERE id = $this->classId ";
            
            //Compare the new student list with the old one. 
            //Records should be deleted, added or left alone depending on which students are removed, added or kept in the class.
            if(!empty($this->newStudents)) {
                
            }
            DatabaseConnector::executeQuery($query, $parameters);
        }
    }
    
    public function removeClass(){
        $query = "DELETE FROM klas_student WHERE klas_id = $this->classId";
        $query2 = "DELETE FROM klas WHERE id = $this->classId";
        DatabaseConnector::executeQuery($query);
        DatabaseConnector::executeQuery($query2);
    }
}

?>
