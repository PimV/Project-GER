<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Docenten
 *
 * @author Pim
 */
class Docenten {

    public function __construct() {
        
    }

    public function addTeacher($voornaam, $tussenvoegsel, $achternaam, $mail, $rollen, $rubrieken) {
        $newTeacher = new Docent();
        $newTeacher->setFirstName($voornaam);
        $newTeacher->setInsert($tussenvoegsel);
        $newTeacher->setLastName($achternaam);
        $newTeacher->setMail($mail);
        $newTeacher->setRollen($rollen);
        $newTeacher->setRubrics($rubrieken);
        $newTeacher->save();
    }

    public function getAllTeachers() {
        $query = "SELECT d.id, d.voornaam, d.achternaam, d.tussenvoegsel, d.mail FROM docent d WHERE d.verwijderd = 0";

        $result = DatabaseConnector::executeQuery($query);

        return $result;
    }

    public function getTeacher($docentId) {
        $query = "SELECT d.id, d.voornaam AS voornaam, d.achternaam, d.tussenvoegsel, d.mail FROM docent d WHERE d.verwijderd = 0 AND d.id = '$docentId'";

        $result = DatabaseConnector::executeQuery($query);

        return $result;
    }

    public function getRubricsByTeacher($docentId) {
        $query = "SELECT * FROM rubriek JOIN docent_rubriek ON rubriek.id = docent_rubriek.rubriek_id WHERE docent_id = '$docentId' AND verwijderd = 0";

        $result = DatabaseConnector::executeQuery($query);

        return $result;
    }

    public function getRubricsNotAssignedByTeacher($docentId = null) {
        if (isset($docentId)) {
            $query = "SELECT * FROM rubriek "
                    . "WHERE id NOT IN "
                    . "(SELECT id FROM rubriek JOIN docent_rubriek ON rubriek.id = docent_rubriek.rubriek_id WHERE docent_id = '$docentId') AND verwijderd = 0";
        } else {

            $query = "SELECT * FROM rubriek WHERE verwijderd = 0";
        }

        $result = DatabaseConnector::executeQuery($query);

        return $result;
    }

    public function getRollenByTeacher($docentId) {
        $query = "SELECT * FROM rol JOIN docent_rol ON rol.id = docent_rol.rol_id WHERE docent_id = '$docentId' AND verwijderd = 0";

        $result = DatabaseConnector::executeQuery($query);

        return $result;
    }

    public function getRollenNotAssignedByTeacher($docentId = null) {
        if (isset($docentId)) {
            $parameters = $query = "SELECT * FROM rol WHERE id NOT IN (SELECT id FROM rol JOIN docent_rol ON rol.id = docent_rol.rol_id WHERE docent_id = '$docentId') AND verwijderd = 0";
        } else {
            $query = "SELECT * FROM rol WHERE verwijderd = 0";
        }

        $result = DatabaseConnector::executeQuery($query);

        return $result;
    }

    public function removeTeacher($teacherId) {
        $parameters = array($teacherId);
        $query = "UPDATE docent SET verwijderd = 1 WHERE id = ?";
        DatabaseConnector::executeQuery($query, $parameters);
    }

    public function fetchMailData() {
        $query = "SELECT id, voornaam, tussenvoegsel, achternaam, mail FROM docent WHERE verwijderd = 0";
        $result = DatabaseConnector::executeQuery($query);
        return $result;
    }
    
    public function fetchMailsOnly() {
        $query = "SELECT mail FROM docent WHERE verwijderd = 0";
        $result = DatabaseConnector::executeQuery($query);
        return $result;
    }

}
