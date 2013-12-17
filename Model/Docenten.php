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

    public function getAllTeachers() {
        $query = "SELECT d.id, d.voornaam, d.achternaam, d.tussenvoegsel, d.mail FROM docent d WHERE d.verwijderd = 0";

        $result = DatabaseConnector::executeQuery($query);

        return $result;
    }

    public function getTeacher($docentId) {
        $query = "SELECT d.id, d.voornaam AS voornaam, d.achternaam, d.tussenvoegsel, d.mail FROM docent d WHERE d.verwijderd = 0 AND d.id = $docentId";

        $result = DatabaseConnector::executeQuery($query);

        return $result;
    }

    public function getRubricsByTeacher($docentId) {
        $query = "SELECT * FROM rubriek JOIN docent_rubriek ON rubriek.id = docent_rubriek.rubriek_id WHERE docent_id = $docentId";

        $result = DatabaseConnector::executeQuery($query);

        return $result;
    }

    public function getRollenByTeacher($docentId) {
        $query = "SELECT * FROM rol JOIN docent_rol ON rol.id = docent_rol.rol_id WHERE docent_id = $docentId";

        $result = DatabaseConnector::executeQuery($query);

        return $result;
    }

}
