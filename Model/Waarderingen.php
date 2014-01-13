<?php

/**
 * Description of Klassen
 *
 * @author johan
 */
class Waarderingen {

    public function __construct() {
        
    }

    public function getAllRatings() {
        $query = "SELECT * FROM waardering WHERE verwijderd = 0 ORDER BY waardering";
        $result = DatabaseConnector::executeQuery($query);
        return $result;
    }

    public function getRating($id) {
        $query = "SELECT * FROM waardering WHERE id = '$id'";
        $result = DatabaseConnector::executeQuery($query);
        return $result;
    }

    public function removeRating($id) {
        $query = "UPDATE waardering SET verwijderd = 1 WHERE id = '$id'";
        DatabaseConnector::executeQuery($query);
    }
    
    public function getMaxRating() {
        $query = "  SELECT MAX(waardering) AS max 
                    FROM waardering 
                    WHERE verwijderd = 0";
        $result = DatabaseConnector::executeQuery($query);
        return $result;
    }

}
