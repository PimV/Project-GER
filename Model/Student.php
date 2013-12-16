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
}


?>
