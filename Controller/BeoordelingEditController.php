<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BeoordelingEditController
 *
 * @author PimGame
 */
class BeoordelingEditController {

    private $studentenModel;
    private $rubriekenModel;
    private $beoordelingenModel;

    public function __construct() {
        include_once('Model' . DIRECTORY_SEPARATOR . 'Studenten.php');
        include_once('Model' . DIRECTORY_SEPARATOR . 'Rubrieken.php');
        include_once('Model' . DIRECTORY_SEPARATOR . 'Beoordelingen.php');
        $this->studentenModel = new Studenten();
        $this->rubriekenModel = new Rubrieken();
        $this->beoordelingenModel = new Beoordelingen();
    }

    public function invoke() {
        $page = "View" . DIRECTORY_SEPARATOR . "BeoordelingEdit.php";
        $rubrieken = $this->rubriekenModel->getAllRubrics();
        $studenten = $this->studentenModel->getStudentsFromClass($_GET["id"]);
        $totaalBeoordelingen = array();
        foreach ($studenten as $student) {
            $beoordelingen = $this->beoordelingenModel->getAllBeoordelingenByClass($student['klas_student_id'], $_SESSION['docentId']);
            if (count($beoordelingen) > 0) {
                $totaalBeoordelingen[$student['klas_student_id']] = $beoordelingen;
            }
        }



        $isBeoordeeld = false;
        if (count($totaalBeoordelingen) <= 0) {
            $isBeoordeeld = false;
        } else {
            $isBeoordeeld = true;
        }


        include_once "View" . DIRECTORY_SEPARATOR . "Template.php";
    }

}
