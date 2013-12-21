<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Beoordeling
 *
 * @author Pim
 */
class Beoordeling {

    private $rubricId;
    private $docentId;
    private $classId;
    private $ratingId;
    private $rateDate;
    private $studentId;

    public function __construct() {
        
    }

    public function setRubric($rubricId) {
        $this->rubricId = $rubricId;
    }

    public function setDocentId($docentId) {
        $this->docentId = $docentId;
    }

    public function setClassStudentId($classId) {
        $this->classId = $classId;
    }

    public function setRatingId($ratingId) {
        $this->ratingId = $ratingId;
    }

    public function setDate($rateDate) {
        $this->rateDate = $rateDate;
    }

    public function getRubric() {
        return (int) $this->rubricId;
    }

    public function getDocentId() {
        return (int) $this->docentId;
    }

    public function getRatingId() {
        return $this->ratingId;
    }

    public function getClassStudentId() {
        return (int) $this->classId;
    }

    public function getDate() {
        $date = date('Y-m-d');
        return $date;
    }

    public function save() {
        $parameters = array($this->getRubric(), $this->getDocentId(), $this->getClassStudentId(), $this->getRatingId(), $this->getDate());

//        $query = 'INSERT INTO resultaat (rubriek_id, docent_id, klas_student_id, waardering_id, datum_beoordeling)
//                 VALUES (\'' .
//                $this->getRubric() .
//                '\', \'' .
//                $this->getDocentId() .
//                '\', \'' .
//                $this->getClassStudentId() .
//                '\', \'' .
//                $this->getRatingId() .
//                '\', \'' .
//                $this->getDate() . '\')';

        $query = 'INSERT INTO resultaat (rubriek_id, docent_id, klas_student_id, waardering_id, datum_beoordeling) VALUES(?,?,?,?,?)';

        // addslashes($query);
        //var_dump($parameters);

        DatabaseConnector::executeQuery($query, $parameters);
    }

}
