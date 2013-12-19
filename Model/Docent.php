<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Docent
 *
 * @author Pim
 */
class Docent {

    private $firstName;
    private $insert;
    private $lastName;
    private $mail;
    private $rubrics;
    private $rollen;
    private $id;

    public function __construct() {
        
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setInsert($insert) {
        $this->insert = $insert;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function setRollen($rollen) {
        $this->rollen = $rollen;
    }

    public function setRubrics($rubrics) {
        $this->rubrics = $rubrics;
    }

    public function getRollen() {
        return (array) $this->rollen;
    }

    public function getRubrics() {
        return (array) $this->rubrics;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getInsert() {
        return $this->insert;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getId() {
        return $this->id;
    }

    public function save() {
        $query = "INSERT INTO docent (voornaam, tussenvoegsel, achternaam, mail) "
                . "VALUES ('" . $this->getFirstName() . "', '" . $this->getInsert() . "', '" . $this->getLastName() . "', '" . $this->getMail() . "')";

        DatabaseConnector::executeQuery($query);


        $this->setId(DatabaseConnector::getConnectionObject()->insert_id);
        $this->saveRubrics();
        $this->saveRollen();
    }

    public function update() {
        $query = "UPDATE docent SET "
                . "voornaam = '" . $this->getFirstName() . "', "
                . "tussenvoegsel = '" . $this->getInsert() . "', "
                . "achternaam = '" . $this->getLastName() . "', "
                . "mail = '" . $this->getMail() . "' "
                . "WHERE id = '" . $this->getId() . "'";

        DatabaseConnector::executeQuery($query);
        $this->saveRubrics();
        $this->saveRollen();
    }

    public function saveRubrics() {
        include_once "Model" . DIRECTORY_SEPARATOR . "Rubrieken.php";
        $rubriekenModel = new Rubrieken();
        $rubrieken = $rubriekenModel->getAllRubrics();
        foreach ($rubrieken as $rubriek) {
            $query = "DELETE FROM docent_rubriek WHERE docent_id = '" . $this->getId() . "' AND rubriek_id = '" . $rubriek['id'] . "'";
            DatabaseConnector::executeQuery($query);
        }

        foreach ($this->getRubrics() as $rubriek) {
            $query = "INSERT INTO docent_rubriek (rubriek_id, docent_id) VALUES ('" . $rubriek . "', '" . $this->getId() . "')";
            DatabaseConnector::executeQuery($query);
        }
    }

    public function saveRollen() {
        include_once "Model" . DIRECTORY_SEPARATOR . "Groepen.php";
        $rollenModel = new Groepen();
        $rollen = $rollenModel->getAllGroups();
        foreach ($rollen as $rol) {
            $query = "DELETE FROM docent_rol WHERE docent_id = '" . $this->getId() . "' AND rol_id = '" . $rol['id'] . "'";
            DatabaseConnector::executeQuery($query);
        }

        foreach ($this->getRollen() as $rol) {

            $query = "INSERT INTO docent_rol (docent_id, rol_id) VALUES ('" . $this->getId() . "', '" . $rol . "')";
            DatabaseConnector::executeQuery($query);
        }
    }

}
