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
class Waardering {

    private $description;
    private $rating;
    private $id;

    public function __construct() {
        
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setRating($rating) {
        $this->rating = $rating;
    }

    public function getId() {
        return $this->id;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getRating() {
        return $this->rating;
    }

    public function save() {
        $query = "INSERT INTO waardering (waardering, omschrijving) "
                . "VALUES ('" . $this->getRating() . "', '" . $this->getDescription() . "')";

        DatabaseConnector::executeQuery($query);


        $this->setId(DatabaseConnector::getConnectionObject()->insert_id);
    }

    public function update() {
        $query = "UPDATE waardering SET "
                . "omschrijving = '" . $this->getDescription() . "', "
                . "waardering = '" . $this->getRating() . "' "
                . "WHERE id = '" . $this->getId() . "'";

        DatabaseConnector::executeQuery($query);
    }

}
