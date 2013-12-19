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
class Rechten {

    public function __construct() {
        
    }

    public function getAllLevels() {
        $query = "SELECT * FROM level";

        $result = DatabaseConnector::executeQuery($query);

        return $result;
    }

}
