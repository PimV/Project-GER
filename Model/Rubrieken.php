<?php

/**
 * Description of Rubrieken
 *
 * @author Niek Willems
 */
class Rubrieken {

    public function __construct() {
        include_once('Model/Rubriek.php');
    }

    /**
     * Voeg een nieuwe rubriek toe
     *
     */
    public function addRubric($name, $description) {
        $array = array($name, $description);
        DatabaseConnector::executeQuery("INSERT INTO rubriek(naam, omschrijving) VALUES(?, ?)", $array);
    }

    /**
     * Verwijder een specifieke rubriek d.m.v. het id
     *
     */
    public function removeRubric($id) {
        DatabaseConnector::executeQuery("UPDATE rubriek
										 SET verwijderd = 1
										 WHERE id = ?", array($id));
    }

    /**
     * Haal een specifieke rubriek op d.m.v. het id
     *
     */
    public function getRubric($id) {
        return new Rubriek($id);
        //$result = DatabaseConnector::executeQuery("SELECT * FROM rubriek WHERE id = ?", array($id));
        //return $result;
    }

    /**
     * Haal alle rubrieken op
     *
     */
    public function getAllRubrics() {
        $result = DatabaseConnector::executeQuery("SELECT * FROM rubriek WHERE verwijderd = 0");
        return $result;
    }

    public function getAllRubricsInclRole($docentId) {
        $parameters = array($docentId, $docentId);

        $query = "SELECT r.* FROM rubriek r "
                . "WHERE (r.id IN (SELECT rubriek_id FROM rol_rubriek WHERE rol_id IN (SELECT rol_id FROM docent_rol WHERE docent_id = ?)) OR r.id IN (SELECT rubriek_id FROM docent_rubriek WHERE docent_id = ?)) "
                . "AND verwijderd = 0";

        $result = DatabaseConnector::executeQuery($query, $parameters);
        return $result;
    }

}

?>