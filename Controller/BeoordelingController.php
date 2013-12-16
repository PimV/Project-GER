<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BeoordelingController
 *
 * @author PimGame
 */
class BeoordelingController {

    private $klassen;

    public function __construct() {
        include_once('Model' . DIRECTORY_SEPARATOR . 'Klassen.php');
        $this->klassen = new Klassen();
    }

    public function invoke() {

        if (isset($_POST['score'])) {
            include_once('Model' . DIRECTORY_SEPARATOR . 'Beoordeling.php');
            $classId = (int) $_POST['classId'];
            foreach ($_POST['score'] as $studentId => $student_value) {
                $classStudentIdArray = $this->klassen->getClassesStudent($studentId, $classId);
                $classStudentId = $classStudentIdArray[0]['id'];
                foreach ($_POST['score'][$studentId] as $rubric_id => $result_value) {
                    $beoordeling = new Beoordeling();
                    $beoordeling->setRubric($rubric_id);
                    $beoordeling->setDocentId($_SESSION['docentId']);
                    $beoordeling->setDate(date('Y-m-d'));
                    $beoordeling->setRatingId((int) $result_value);
                    $beoordeling->setClassStudentId($classStudentId);
                    $beoordeling->save();
                }
            }
        }

        $page = "View" . DIRECTORY_SEPARATOR . "Beoordeling.php";
        $klassen_view = $this->klassen->getAllClassesNoResult_array();
        include_once "View" . DIRECTORY_SEPARATOR . "Template.php";
    }

}
