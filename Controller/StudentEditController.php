<?php

/**
 * Description of StudentEditController
 *
 * @author James Hay
 */
class StudentEditController {
    
    
    public function __construct() {
        if(!$_SESSION["admin"]) { header("location: index.php?p=home"); }
        include_once 'model'.DIRECTORY_SEPARATOR.'studenten.php';
        $this->studentenModel = new Studenten();

        if(isset($_GET["id"])){
            $this->studentModel = $this->studentenModel->getStudent($_GET["id"]);
        }
    }
    
    public function invoke() {
        if(!empty($_POST)) {
            $this->saveData();
        }

        $studentId = "";
        $voornaam = "";
        $achternaam = "";
        $tussenvoegsel = "";
        $mail = "";

        if (isset($this->studentModel)){
            $studentId = $this->studentModel->getStudentId();
            $voornaam = $this->studentModel->getVoornaam();
            $achternaam = $this->studentModel->getAchternaam();
            $tussenvoegsel = $this->studentModel->getTussenvoegsel();
            $mail = $this->studentModel->getMail();
        }

        $page = 'view'.DIRECTORY_SEPARATOR.'studentEdit.php';
        include_once 'view'.DIRECTORY_SEPARATOR.'template.php';
    }

    private function saveData() {
        if(isset($_GET["id"])) {
            $this->studentModel->setStudentId($_POST["studentId"]);
            $this->studentModel->setVoornaam($_POST["voornaam"]);
            $this->studentModel->setAchternaam($_POST["achternaam"]);
            $this->studentModel->setTussenvoegsel($_POST["tussenvoegsel"]);
            $this->studentModel->setMail($_POST["mail"]);
            $this->studentModel->setOldId($_GET["id"]);
            $this->studentModel->saveToDB();
        } else {
            $this->studentenModel->addStudent($_POST["studentId"], $_POST["voornaam"], $_POST["achternaam"], $_POST["tussenvoegsel"], $_POST["mail"]);
        }
        
        //Redirect naar de overzicht pagina van studenten
        header("location: index.php?p=studentsearch");
    }
}

?>
